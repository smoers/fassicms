<?php

namespace App\Http\Livewire\Reporting;

use App\Models\Partmetadata;
use \Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class ReportingWorksheetsClockings extends Component
{

    use WithPagination;

    protected $pageBy = 10;
    protected $paginationTheme = 'bootstrap';

    public function query()
    {
        return DB::table('partmetadatas')->leftJoin('catalogs','partmetadatas.id','=','catalogs.partmetadata_id');

    }

    public function render()
    {
        return view('livewire.reporting.reporting-worksheets-clockings',[
            'worksheets' => $this->query()->paginate($this->pageBy),
            'heads' => $this->getHead(),
        ]);
    }

    public function getHead(): array
    {
        return [
            'partmetadatas' => config('moco.consult.fields.partmetadatas.name'),
            'catalogs' =>  config('moco.consult.fields.catalogs.name')
        ];
    }

    protected function getData()
    {

    }
}
