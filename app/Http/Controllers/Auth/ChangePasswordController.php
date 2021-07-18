<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    protected array $rules;
    protected string $success = '<div class="text-success"><i class="fas fa-check"></i> {{text}}</div>';
    protected string $error = '<div class="text-danger"><i class="fas fa-times"></i> {{text}}</div>';

    /**
     * ChangePasswordController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->rules = config('moco.password');
    }

    /**
     * Contrôle le password actuel
     *
     * @param string|null $password
     * @return bool
     */
    protected function checkCurrentPassword(?string $password): bool
    {
        return Hash::check($password,auth()->user()->getAuthPassword());
    }

    /**
     * Contrôle le password actuel par une requête Ajax
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajaxCheckCurrentPassword(Request $request)
    {
        $result = [];
        if ($this->checkCurrentPassword($request->password)){
            $result['checked'] = true;
            $result['msg'] = null;
        } else {
            $result['checked'] = false;
            $result['msg'] = trans('Your password is not correct');
        }
        return response()->json($result);
    }

    /**
     * Contrôle le format du mot de passe par une requête Ajax
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajaxCheckFormatPassword(Request $request)
    {
        $result = [];
        foreach ($this->rules as $rule){
            array_push($result,$this->applyRuleWithMessage($rule,$request->password));
        }
        return response()->json($result);
    }


    public function ajaxStorePassword(Request $request)
    {
        $result = [];
        /**
         * mot de passe actuel
         */
        $current = $this->checkCurrentPassword($request->current_password);
        /**
         * format mot de passe
         */
        $password = $this->applyRules($request->new_password);
        /**
         * confirme password
         */
        $confirm = $request->new_password == $request->confirm_password;
        if ($current && $password && $confirm){
            User::find(auth()->user()->id)->update(['password' => bcrypt($request->new_password)]);
            $result['checked'] = true;
            $result['msg'] = trans('Your password has been changed successfully');
        } else {
            $result['current'] = $current;
            $result['password'] = $password;
            $result['confirm'] = $confirm;
            $result['checked'] = false;
            $result['msg'] = trans('Your password has not been changed');
        }
        return response()->json($result);
    }

    /**
     * Retourne la chaine HTML correspondant au résultat
     *
     * @param bool $check
     * @param string $value
     * @return array|string|string[]
     */
    protected function htmlBuilder(bool $check, string $value): array
    {
        if ($check)
            $msg = str_replace('{{text}}',$value,$this->success);
        else
            $msg = str_replace('{{text}}',$value,$this->error);
        return ['checked' => $check, 'msg' => $msg];
    }

    /**
     * Check la règle et retourne le message en capsulé dans les Tag HTML
     *
     * @param array $rule
     * @param string|null $password
     * @return string[]
     */
    protected function applyRuleWithMessage(array $rule, ?string $password): array
    {
        return $this->htmlBuilder($this->applyRule($rule['regex'],$password),trans($rule['msg']));
    }

    /**
     * Check la règle Regex
     *
     * @param array $regex
     * @param string|null $password
     * @return bool
     */
    protected function applyRule(string $regex, ?string $password): bool
    {
        return preg_match('/'.$regex.'/',$password) == 1;
    }

    /**
     * Check l'ensemble des régles
     *
     * @param string|null $password
     * @return bool
     */
    protected function applyRules(?string $password): bool
    {
        $result = true;
        foreach ($this->rules as $rule){
            $result = ($result == $this->applyRule($rule['regex'],$password) && $result);
        }
        return $result;
    }

}
