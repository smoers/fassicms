<div class="container-fluid">
    <div class="row">
        @if(strpos(url()->current(),'store'))
            <div class="col-4"><a href="{{route('store.edit',[$store->id,$store->cat_id])}}"><i class="fas fa-edit" style="color: dodgerblue !important;"></i></a></div>
        @elseif(strpos(url()->current(),'reassort'))
            <div class="col-4"><a href="{{route('reassort.edit',$store->id)}}"><i class="fas fa-cart-plus" style="color: dodgerblue !important;"></i></a></div>
        @endif
        <div class="col-4"><a href=""><i class="fas fa-qrcode" style="color: dodgerblue !important;"></i></a> </div>
        <div class="col-4"><a href=""><i class="fas fa-trash-alt" style="color: red !important;"></i></a></div>
    </div>
</div>
