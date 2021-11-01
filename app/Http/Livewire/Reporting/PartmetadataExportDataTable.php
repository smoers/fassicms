<?php

namespace App\Http\Livewire\Reporting;

use App\Moco\Datatables\Column;
use App\Moco\Datatables\DataTableComponent;
use App\Moco\Datatables\Filters\NumberFilter;
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
                ->setFilter(new TextFilter('part_number')),

            /** description **/
            Column::make(trans('Description'),'description')
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
                ->setFilter(new TextFilter('bar_code')),

            /** reassort_level **/
            Column::make(trans('Reassort Level'), 'reassort_level')
                ->format(function (Partmetadata $model){
                    return number_format($model->reassort_level,0,',','.');
                })
                ->setFilter(new NumberFilter('reassort_level')),

            /** price **/
            Column::make(trans('Price'),'price')
                ->format(function(Partmetadata $model){
                    return number_format($model->price,2,',','.');
                }),

            /** year **/
            Column::make(trans('Year'),'year'),

            Column::make(trans('Enabled'),'providers_enabled')
                ->format(function(Partmetadata $model){
                    return $model->providers_enabled == 1 ? trans('Yes') : trans('No');
                }),
            Column::make(trans('Provider'), 'name'),
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
            case 'price':
            case 'year':
            case 'enabled':
                $class = 'moco-size-column-table-100';
                break;
            case 'reassort_level':
            case 'barcode':
                $class = 'moco-size-column-table-150';
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
