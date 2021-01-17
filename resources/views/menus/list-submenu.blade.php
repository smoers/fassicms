<div class="container-fluid">
    @if($whatIs == 'crane')
        @var $_modify = route('crane.edit',$crane->id)
        @var $_show = ''
        @var $_remove = ''
        @var $_print = ''
        @var $_r_modify = true
    @elseif($whatIs == 'customer')
        @var $_modify = route('customer.edit',$customer->id)
        @var $_show = ''
        @var $_remove = ''
        @var $_print = ''
        @var $_r_modify = true
    @elseif($whatIs == 'worksheet')
        @var $_modify = route('worksheet.edit',$worksheet->id)
        @var $_show = ''
        @var $_remove = ''
        @var $_print = route('worksheet.print',$worksheet->id)
        @var $_r_modify = !$worksheet->validated
    @endif
    <div class="d-flex justify-content-md-end justify-content-sm-end justify-content-lg-end" style="height: auto">
        @if($_r_modify)<div class="ml-2"><a href="{{ $_modify }}" class="btn btn-primary moco-btn-sm"><i class="fas fa-edit" style="color: white !important;"></i> {{trans('Modify')}}</a></div>@endif
        <div class="ml-2"><a href="{{ $_show }}" class="btn btn-info moco-btn-sm"><i class="fas fa-eye" style="color: white !important;"></i> {{trans('Show')}}</a></div>
        <div class="ml-2">
            <a class="nav-link dropdown-toggle btn btn-secondary moco-btn-sm" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Plus</a>
            <div class="dropdown-menu">
                <a class="dropdown-item moco-color-error moco-error-small" href="{{ $_remove }}"><i class="fas fa-trash-alt"></i> {{trans('Remove')}} </a>
                <a class="dropdown-item moco-color-info moco-error-small" href="{{ $_print }}"><i class="fas fa-print"></i> {{trans('Print')}} </a>
            </div>
        </div>
    </div>
</div>
