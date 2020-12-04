<!-- message -->
<div style="position: relative; margin: 20px; z-index: 999999">
    @if ($message = Session::get('success'))
    <div class="alert alert-success alert-block" style="position: absolute; top: 0; right: 0;">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ __($message) }}</strong>
    </div>
@endif

@if ($message = Session::get('error'))
    <div class="alert alert-danger alert-block" style="position: absolute; top: 0; right: 0;">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ __($message) }}</strong>
    </div>
@endif

@if ($message = Session::get('warning'))
    <div class="alert alert-warning alert-block" style="position: absolute; top: 0; right: 0;">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ __($message) }}</strong>
    </div>
@endif

@if ($message = Session::get('info'))
    <div class="alert alert-info alert-block" style="position: absolute; top: 0; right: 0;">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ __($message) }}</strong>
    </div>
@endif

@if ($errors->any())

        <div class="alert alert-danger" style="position: absolute; top: 0; right: 0;">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ __($error) }}</li>
                @endforeach
            </ul>
        </div>

@endif
</div>
