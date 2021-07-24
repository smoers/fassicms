<?php

namespace App\Models;

use App\Moco\Common\MocoModelCreatedUpdatedAt;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

class CustomerContact extends Model
{
    use HasFactory, MocoModelCreatedUpdatedAt;

    protected $fillable=[
        'firstname',
        'lastname',
        'function',
        'phone',
        'mobile',
    ];

    /**
     * Retourne l'objet User lié à l'objet CustomerContact
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Retourne l'objet Customer lié à l'objet CustomerContact
     *
     * @return BelongsTo
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Hydrate des objets CustomerContact au départ d'une collection
     * Doit-être exécuté avec un objet Customer disposant d'un ID
     *
     * @param array $contacts
     * @param Customer $customer
     * @return void
     */
    public static function hydratedAndSave(array $contacts, Customer $customer): void
    {
        for ($index = 0; $index < count($contacts['lastname']); $index++){
            if (!is_null($contacts['id'][$index])){
                $contact = CustomerContact::find($contacts['id'][$index]);
            } else {
                $contact = new CustomerContact();
            }
            $contact->firstname = $contacts['firstname'][$index];
            $contact->lastname = $contacts['lastname'][$index];
            $contact->function = $contacts['function'][$index];
            $contact->phone = $contacts['phone'][$index];
            $contact->mobile = $contacts['mobile'][$index];
            $contact->user()->associate(Auth::user());
            $contact->customer()->associate($customer);
            $contact->save();
        }
    }

    /**
     * Supprime les contacts
     *
     * @param array $contacts
     * @param Customer $customer
     */
    public static function remove(array $contacts, Customer $customer): void
    {
        $currentContacts = CustomerContact::where('customer_id','=',$customer->id)->get();
        foreach ($currentContacts as $currentContact){
            if (!in_array($currentContact->id, $contacts['id']))
                $currentContact->delete();
        }
    }
}
