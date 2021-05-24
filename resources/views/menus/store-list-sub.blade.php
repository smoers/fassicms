<div class="container-fluid">
    <div class="d-flex justify-content-md-end justify-content-sm-end justify-content-lg-end" style="height: auto">
        @if(strpos(url()->current(),'store'))
            @can('edit catalog')<div class="ml-2"><a class="btn btn-primary moco-btn-sm" href="{{route('store.edit',[$partmetadata->id,$partmetadata->cat_id])}}"><i class="fas fa-edit" style="color: white !important;"></i> {{__('Modify')}}</a></div>@endcan
            @can('consult catalog')<div class="ml-2"><a href="{{ route('store.show',[$partmetadata->id]) }}" class="btn btn-success moco-btn-sm"><i class="fas fa-eye" style="color: white !important;"></i> {{trans('Show')}}</a></div>@endcan
        @elseif(strpos(url()->current(),'reassort'))
            @can('reassort stock')<div class="ml-2"><a class="btn btn-info moco-btn-sm" href="{{route('reassort.edit',$partmetadata->store_id)}}"><i class="fas fa-sign-in-alt" style="color: white !important;"></i></a></div>@endcan
            @can('out stock')<div class="ml-2"><a class="btn btn-danger moco-btn-sm" href="{{route('out.edit',$partmetadata->store_id)}}"><i class="fas fa-sign-out-alt" style="color: white !important;"></i></a></div>@endcan
        @endif
        @can('print stock')<div class="ml-2"><a class="btn btn-info moco-btn-sm" href="{{route('store.barcode_sticker',[$partmetadata->id])}}"><i class="fas fa-qrcode" style="color: white !important;"></i> {{__('Print')}}</a></div>@endcan

            <!--
        <div class="ml-2">
            <a class="nav-link dropdown-toggle btn btn-secondary moco-btn-sm" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Plus</a>
            <div class="dropdown-menu">
                <a class="dropdown-item moco-color-error moco-error-small" href=""><i class="fas fa-trash-alt"></i> {{trans('Remove')}} </a>
                <a class="dropdown-item moco-color-info moco-error-small" href=""><i class="fas fa-print"></i> {{trans('Print')}} </a>
            </div>
        </div>
            -->
    </div>
</div>
