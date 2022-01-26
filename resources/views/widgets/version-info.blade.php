<div class="d-flex flex-sm-row">
    <div class="d-flex flex-sm-column mr-2">
        <img src="{{asset('images/version-48.png')}}">
    </div>
    <div class="d-flex flex-sm-column">
        <div class="text text-warning">{{$config['version']}}</div>
        <div class="text text-info" style="font-style: italic;font-weight: bold;font-size: 10px">Release note :</div>
        @foreach($config['release'] as $release)
            <div class="text text-info" style="font-style: italic; font-size: 10px">{!!$release!!}</div>
        @endforeach
    </div>
</div>
