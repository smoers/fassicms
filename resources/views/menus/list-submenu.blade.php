<div class="container-fluid">
    @if($whatIs == 'crane')
        @var $_modify = route('crane.edit',$crane->id)
        @var $_show = ''
        @var $_remove = ''
        @var $_print = ''
        @var $_print_id = ''
        @var $_r_modify = true
    @elseif($whatIs == 'customer')
        @var $_modify = route('customer.edit',$customer->id)
        @var $_show = ''
        @var $_remove = ''
        @var $_print = ''
        @var $_print_id = ''
        @var $_r_modify = true
    @elseif($whatIs == 'technician')
        @var $_modify = route('technician.edit',$technician->id)
        @var $_show = ''
        @var $_remove = ''
        @var $_print = ''
        @var $_print_id = ''
        @var $_r_modify = true
    @elseif($whatIs == 'worksheet')
        @var $_modify = route('worksheet.edit',$worksheet->id)
        @var $_show = ''
        @var $_remove = ''
        @var $_hour = route('clocking.edit',$worksheet->id)
        @var $_part = route('worksheet.part',$worksheet->id)
        @var $_print = route('worksheet.print')
        @var $_print_id = $worksheet->id
        @var $_r_modify = !$worksheet->validated
    @endif
    <div class="d-flex justify-content-md-end justify-content-sm-end justify-content-lg-end" style="height: auto">
        @if($_r_modify)
            <div class="ml-2"><a href="{{ $_modify }}" class="btn btn-primary moco-btn-sm"><i class="fas fa-edit" style="color: white !important;"></i> {{trans('Modify')}}</a></div>
        @endif
        @if($whatIs == 'worksheet')
            <div class="ml-2"><a href="{{ $_hour }}" class="btn btn-info moco-btn-sm"><i class="fas fa-clock" style="color: white !important;"></i> {{trans('Hours')}}</a></div>
            <div class="ml-2"><a href="{{ $_part }}" class="btn btn-info moco-btn-sm"><i class="fas fa-clock" style="color: white !important;"></i> {{trans('Parts')}}</a></div>
        @else
            <div class="ml-2"><a href="{{ $_show }}" class="btn btn-info moco-btn-sm"><i class="fas fa-eye" style="color: white !important;"></i> {{trans('Show')}}</a></div>
        @endif
        <div class="ml-2">
            <a class="nav-link dropdown-toggle btn btn-secondary moco-btn-sm" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Plus</a>
            <div class="dropdown-menu">
                @if($whatIs == 'worksheet')
                    <a class="dropdown-item moco-color-info moco-error-small" href="{{ $_show }}"><i class="fas fa-eye"></i> {{trans('Show')}} </a>
                @endif
                <a class="dropdown-item moco-color-error moco-error-small" href="{{ $_remove }}"><i class="fas fa-trash-alt"></i> {{trans('Remove')}} </a>
                <a class="dropdown-item moco-color-info moco-error-small" href="{{ $_print }}" id="print_{{$_print_id}}"><i class="fas fa-print"></i> {{trans('Print')}} </a>
            </div>
        </div>
    </div>
</div>


