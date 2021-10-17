<div class="card mr-3 mb-3 moco-widget" style="width: {{$config['width']}};height: {{$config['height']}}">
    <div class="card-body">
        <div class="card-title moco-title-table">{{$config['title']}}</div>
        <div class="card-body">
            @yield('body')
        </div>
    </div>
</div>
