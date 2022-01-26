<?php

namespace App\Http\Livewire\Clocking;

use App\Moco\Common\MocoLivewireSearchSession;
use App\Models\ViewClockingsDetailsCorrect;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\TableComponent;
use Rappasoft\LaravelLivewireTables\Traits\HtmlComponents;
use Rappasoft\LaravelLivewireTables\Views\Column;

class ClockingsDetailsCorrectList extends TableComponent
{
    use HtmlComponents, MocoLivewireSearchSession;

    private $action = null;
    private $actionCurrent = null;
    private $status = null;
    private $statusCurrent = null;
    protected $listeners = ['reload' => '$refresh'];

    /**
     * CraneList constructor.
     * @param null $id
     */
    public function __construct($id = null)
    {
        $this->action = config('moco.clocking.actions');
        $this->status = config('moco.clocking.status');
        $this->actionCurrent = $this->action['start'];
        $this->statusCurrent = $this->status['activated'];
        $this->perPage = config('moco.table.perPage');
        $this->perPageOptions = config('moco.table.perPageOptions');
        $this->rowClass =  config('moco.table.rowClass');
        $this->loadingIndicator =true;
        $this->sortField = 'date';
        $this->sortDefaultIcon = '<i class="fas fa-sort-alpha-down"></i>';
        $this->ascSortIcon = '<i class="fas fa-sort-alpha-up"></i>';
        $this->descSortIcon = '<i class="fas fa-sort-alpha-down"></i>';
        $this->loadSearchSessionValue();
        parent::__construct($id);
    }

    public function query(): Builder
    {
        return ViewClockingsDetailsCorrect::select()->where('status','=',$this->statusCurrent)->where('action','=',$this->actionCurrent);;
    }

    public function columns(): array
    {
        return [
            Column::make(trans('Worksheet'),'w_number')
                ->searchable()
                ->sortable(),
            Column::make(trans('Technician'), 'technician')
                ->searchable()
                ->sortable(),
            Column::make(trans('Action'),'action'),
            Column::make(trans('Status'), 'status'),
            Column::make(trans('Date'), 'date')
                ->searchable()
                ->sortable()
                ->format(function (ViewClockingsDetailsCorrect $model) {
                    return $model->getDate();
                }),
            Column::make(trans('Time'), 'time')
                ->searchable()
                ->sortable()
                ->format(function (ViewClockingsDetailsCorrect $model) {
                    return $model->getTime();
                }),
            Column::make(trans('Actions'),'actions')
                ->format(function (ViewClockingsDetailsCorrect $model){
                    return view('worksheet.clocking-correct-action',[
                        'model' => $model,
                    ]);
                })
        ];
    }

    /**
     * @param $attribute
     * @return string|null
     */
    public function setTableHeadClass($attribute): ?string
    {
        $extend = ' ';
        switch ($attribute) {
            case 'actions':
                $extend .=  'moco-size-column-table-400';
                break;
            case 'date':
            case 'worksheet':
                $extend .= 'moco-size-column-table-150';
                break;
            case 'technicien':
                $extend .= 'moco-size-column-table-100';
                break;
        }
        return 'moco-title-table'.$extend;
    }

    /**
     * @param $attribute
     * @param $value
     * @return string|null
     */
    public function setTableDataClass($attribute, $value): ?string
    {
        return $this->rowClass;
    }

}
