    <div class="d-flex justify-content-start">
        <div class="ml-2"><a href="#" class="btn btn-danger moco-btn-sm closed_id" id="closed_{{$model->id}}" object="{{json_encode($model, true)}}">{{__('Closed')}}</a></div>
        <div class="ml-2"><a href="#" class="btn btn-primary moco-btn-sm removed_id" id="removed_{{$model->id}}">{{__('Removed')}}</a></div>
    </div>
