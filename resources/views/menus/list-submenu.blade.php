<div class="container-fluid">
    @if($whatIs == 'crane')
    <div class="d-flex justify-content-md-end justify-content-sm-end justify-content-lg-end">
        <div class="ml-2"><a href="{{ route('crane.edit',$crane->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit" style="color: white !important;"></i> {{trans('Modify')}}</a></div>
        <div class="ml-2"><a href="" class="btn btn-info btn-sm"><i class="fas fa-eye" style="color: white !important;"></i> {{trans('Show')}}</a></div>
        <div class="ml-2">
            <a class="nav-link dropdown-toggle btn btn-secondary btn-sm" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Plus</a>
            <div class="dropdown-menu">
                <a class="dropdown-item moco-color-error moco-error-small" href=""><i class="fas fa-trash-alt"></i> {{trans('Remove')}} </a>
                <a class="dropdown-item moco-color-info moco-error-small" href=""><i class="fas fa-print"></i> {{trans('Print')}} </a>
            </div>
        </div>
    </div>
    @endif
</div>
