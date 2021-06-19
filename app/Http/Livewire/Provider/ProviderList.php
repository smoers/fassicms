<?php

namespace App\Http\Livewire\Provider;

use App\Models\Provider;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\True_;
use Rappasoft\LaravelLivewireTables\TableComponent;
use Rappasoft\LaravelLivewireTables\Traits\HtmlComponents;
use Rappasoft\LaravelLivewireTables\Views\Column;

class ProviderList extends TableComponent
{
    use HtmlComponents;
    public $edit = [];
    public $name = [];
    public $enabled = [];
    public $tst;

    protected $rowClass ='';

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
                        'edit' => (array_key_exists($model->id, $this->edit) && $this->edit[$model->id]),
                        ]);
                })
        ];
    }

    private function nameColumn(Provider $provider)
    {
        $html = $provider->name;
        if (array_key_exists($provider->id, $this->edit) && $this->edit[$provider->id]) {
            if (!array_key_exists($provider->id,$this->name))
                $this->name[$provider->id] = $provider->name;
            $html = '<input wire:model.lazy="name.'.$provider->id.'" class="form-control form-control-sm" value="' . $provider->name . '"/>';
        }
        return $this->html($html);
    }

    /**
     * Retourne la chaine de caractère correspondant à un select
     *
     * @param $value
     * @return string
     */
    function enabledColumn(Provider $provider)
    {
        /**
         * contenu par dféaut sans le mode édite
         */
        $html = $provider->enabled ? trans('Yes') : trans('No');
        if (array_key_exists($provider->id, $this->edit) && $this->edit[$provider->id]) {
            if (!array_key_exists($provider->id,$this->enabled))
                $this->enabled[$provider->id] = $provider->enabled;
            $html = '<select wire:model.lazy="enabled.'.$provider->id.'" class="form-control form-control-sm"><option value="1"' . ($provider->enabled ? 'selected' : '') . '>' . trans('Yes') . '</option><option value="0" ' . (!$provider->enabled ? 'selected' : '') . '>' . trans('No') . '</option></select>';
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


    public function edit($id)
    {
        /**
         * Si la clé existe on change le status
         */
        if(array_key_exists($id, $this->edit))
            $this->edit[$id] = !$this->edit[$id];
        else
            /**
             * la clé n'existe pas on la crée et attribue la valeur True
             */
            $this->edit[$id] = true;
    }

    public function submit(Request $request,$id)
    {
        unset($this->name[$id]);
        unset($this->enabled[$id],$this->edit[$id]);
        //dd($this->name,$this->enabled);
    }

}
