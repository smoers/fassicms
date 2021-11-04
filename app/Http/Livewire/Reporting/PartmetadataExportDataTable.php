<?php

namespace App\Http\Livewire\Reporting;

use App\Moco\Datatables\Column;
use App\Moco\Datatables\DataTableComponent;
use App\Moco\Datatables\Filters\FloatNumberFilter;
use App\Moco\Datatables\Filters\IntNumberFilter;
use App\Moco\Datatables\Filters\SelectBooleanFilter;
use App\Moco\Datatables\Filters\TextFilter;
use App\Models\Partmetadata;
use Illuminate\Database\Eloquent\Builder;

class PartmetadataExportDataTable extends DataTableComponent
{

    /**
     * Chemin du fichier blade
     * @var string|null
     */
    protected ?string $renderViewPath = 'livewire.reporting.partmetadata-export-data-table';
    /**
     * Tableau avec un filtre
     * @var bool
     */
    public bool $tableIsFiltered = true;
    /**
     * sort field part défaut
     * @var string
     */
    public string $sortField = 'part_number';

    public function query(): Builder
    {
        return Partmetadata::query()->select()->addSelect('providers.enabled AS providers_enabled')
            ->leftJoin('catalogs','partmetadatas.id','=','catalogs.partmetadata_id')
            ->leftJoin('providers','providers.id','=','catalogs.provider_id');
    }

    public function columns(): array
    {
        return [
            /** part_number**/
            Column::make(trans('Part Number'),'part_number')
                ->setSortable()
                ->setFilter(new TextFilter('part_number')),

            /** description **/
            Column::make(trans('Description'),'description')
                ->setSortable()
                ->setFilter(new TextFilter('description')),

            /** partmetadatas.enabled **/
            Column::make(trans('Enabled'),'enabled')
                ->format(function(Partmetadata $model){
                    return $model->enabled == 1 ? trans('Yes') : trans('No');
                })
                ->setFilter(new SelectBooleanFilter('partmetadatas.enabled', 2)),

            /** electrical_part **/
            Column::make(trans('Electrical Part'),'electrical_part')
                ->format(function(Partmetadata $model){
                return $model->electrical_part == 1 ? trans('Yes') : trans('No');
                })
                ->setFilter(new selectBooleanFilter('electrical_part')),

            /** bar_code **/
            Column::make(trans('BarCode'),'bar_code')
                ->setSortable()
                ->setFilter(new TextFilter('bar_code')),

            /** reassort_level **/
            Column::make(trans('Reassort Level'), 'reassort_level')
                ->setSortable()
                ->format(function (Partmetadata $model){
                    return number_format($model->reassort_level,0,',','.');
                })
                ->setFilter(new IntNumberFilter('reassort_level')),

            /** price **/
            Column::make(trans('Price'),'price')
                ->setSortable()
                ->format(function(Partmetadata $model){
                    return number_format($model->price,2,',','.');
                })
                ->setFilter(new FloatNumberFilter('price')),

            /** year **/
            Column::make(trans('Year'),'year')
                ->setSortable()
                ->setFilter(new IntNumberFilter('year')),

            Column::make(trans('Enabled'),'providers_enabled')
                ->format(function(Partmetadata $model){
                    return $model->providers_enabled == 1 ? trans('Yes') : trans('No');
                })
                ->setFilter(new SelectBooleanFilter('providers_enabled')),
            Column::make(trans('Provider'), 'name')
                ->setSortable()
                ->setFilter(new TextFilter('name')),
        ];
    }

    /**
     * @param Column $column
     * @return string|null
     */
    public function setTableHeadColumnClass(Column $column): ?string
    {
        $class = '';
        switch ($column->getAttribute()){
            case 'part_number' :
                $class = 'moco-size-column-table-250';
                break;
            case 'name':
            case 'description':
                $class = 'moco-size-column-table-300';
                break;
            case 'electrical_part':
            case 'enabled':
                $class = 'moco-size-column-table-100';
                break;
            case 'year':
            case 'price':
            case 'barcode':
                $class = 'moco-size-column-table-150';
                break;
            case 'reassort_level':
                $class = 'moco-size-column-table-200';
                break;
        }

        return $class;
    }

    /**
     * @param Column $column
     * @return string|null
     */
    public function setTableDataColumnClass(Column $column): ?string
    {
        $class = '';
        switch ($column->getAttribute()){
            case 'reassort_level':
            case 'year':
            case 'price' :
                $class = 'text-right';
                break;
        }

        return $class;
    }
}
