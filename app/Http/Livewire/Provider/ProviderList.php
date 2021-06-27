<?php

namespace App\Http\Livewire\Provider;

use App\Models\Provider;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\HtmlString;
use Rappasoft\LaravelLivewireTables\TableComponent;
use Rappasoft\LaravelLivewireTables\Traits\HtmlComponents;
use Rappasoft\LaravelLivewireTables\Views\Column;

class ProviderList extends TableComponent
{
    use HtmlComponents;
    public $edit = null;
    public Provider $provider;

    protected string $rowClass ='';

    protected array $rules = [
        'provider.name' => 'required',
        'provider.enabled' => 'required',
    ];


    /**
     * CustomerList constructor.
     * @param null $id
     */
    public function __construct($id = null)
    {
        $this->perPage = config('moco.table.perPage');
        $this->perPageOptions = config('moco.table.perPageOptions');
        $this->loadingIndicator =true;
        $this->sortField = 'name';
        $this->sortDefaultIcon = '<i class="fas fa-sort-alpha-down"></i>';
        $this->ascSortIcon = '<i class="fas fa-sort-alpha-up"></i>';
        $this->descSortIcon = '<i class="fas fa-sort-alpha-down"></i>';
        $this->rowClass = 'moco-row-table-height-small';
        parent::__construct($id);
    }

    /**
     * Query
     *
     * @return Builder
     */
    public function query(): Builder
    {
        return Provider::query();
    }

    /**
     * Colonnes
     *
     * @return array
     */
    public function columns(): array
    {
        return  [
            Column::make(trans('Provider name'),'name')
                ->sortable()
                ->searchable()
                ->format(function (Provider $model){ return $this->nameColumn($model); }),
            Column::make(trans('Enabled'),'enabled')
                ->sortable()
                ->searchable()
                ->format(function (Provider $model){ return $this->enabledColumn($model); }),
            Column::make(trans('Actions'),'actions')
                ->format(function (Provider $model){
                    return view('provider.provider-action',[
                        'model' => $model,
                        'edit' => $this->edit == $model->id,
                        ]);
                })
        ];
    }



    /**
     * Retourne la chaine de caractère pour editer le nom du fournisseur
     *
     * @param Provider $provider
     * @return HtmlString
     */
    private function nameColumn(Provider $provider): HtmlString
    {
        $html = $provider->name;
        if ($this->edit == $provider->id) {
            $html = '<input wire:model.lazy="provider.name" class="form-control form-control-sm" type="text"/>';
        }
        return $this->html($html);
    }

    /**
     * Retourne la chaine de caractère correspondant à un select
     *
     * @param $value
     * @return HtmlString
     */
    function enabledColumn(Provider $provider): HtmlString
    {
        /**
         * contenu par dféaut sans le mode édite
         */
        $html = $provider->enabled ? trans('Yes') : trans('No');
        if ($this->edit == $provider->id) {
            //$html = '<select wire:model.lazy="provider.enabled" class="form-control form-control-sm"><option value="1"' . ($provider->enabled ? 'selected' : '') . '>' . trans('Yes') . '</option><option value="0" ' . (!$provider->enabled ? 'selected' : '') . '>' . trans('No') . '</option></select>';
            $html = '<select wire:model.lazy="provider.enabled" class="form-control form-control-sm"><option value="1">' . trans('Yes') . '</option><option value="0">' . trans('No') . '</option></select>';
        }
        return $this->html($html);

    }

    /**
     * @param $attribute
     * @return string|null
     */
    public function setTableHeadClass($attribute): ?string
    {
        $extend = ' ';
        switch ($attribute) {
            case 'enabled':
                $extend .= 'moco-size-column-table-100';
                break;
            case 'actions':
                $extend .= 'moco-size-column-table-200';
                break;
        }
        return 'moco-title-table'.$extend;
    }

    public function setTableRowClass($model): ?string
    {
        return $this->rowClass;
    }

    /**
     * On place la ligne en mode édite ou on retire le mode édite
     *
     * @param $id
     */
    public function edit($id)
    {
         /**
         * Si la clé existe ou est différente on l'enregistre
         */
        if($this->edit != $id){
            $this->edit = $id;
            $this->provider = Provider::find($id);
        }
        else {
            /**
             * la clé n'existe pas on la crée et attribue la valeur True
             */
            $this->edit = null;
            $this->provider = new Provider();
        }
    }

    /**
     * On sauvegarde les changements
     *
     * @param $id
     */
    public function save($id)
    {
        /**
         * On valide
         */
        $this->validate();
        /**
         * s'il n'y a pas déjà un fournisseur avec le même nom on sauvegarde
         */
         $this->provider->user()->associate(Auth::user());
         $this->provider->save();
         session()->flash('success',trans('The provider has been saved'));
        /**
         * Initialisation de l'edition
         */
        $this->edit = null;
        $this->provider = new Provider();
    }

}
