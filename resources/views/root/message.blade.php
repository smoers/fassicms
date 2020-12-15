<!-- message -->
<div style="position: relative; margin: 20px; z-index: 999999">
    @if ($message = Session::get('success'))
        <!-- je conserve
            <div id="success" class="alert alert-success alert-block" style="position: absolute; top: 0; right: 0;">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ __($message) }}</strong>
            </div>
            -->
            <div class="position-absolute w-100 d-flex flex-column p-4">
                <div class="toast ml-auto" role="alert" data-delay="700" data-autohide="false">
                    <div class="toast-header">
                        <i class="fa fa-thumbs-up moco-color-success"></i>
                        <strong class="mr-auto ml-1 moco-color-success">{{__('Success')}}</strong>
                        <small class="text-muted"></small>
                        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                            <span aria-hidden="true"><i class="fa fa-times-circle light-blue-darker-hover"></i></span>
                        </button>
                    </div>
                    <div class="toast-body green lighten-4 moco-color-success font-weight-bold"> {{ __($message) }}</div>
                </div>
            </div>
    @endif

    @if ($message = Session::get('error'))
    <!-- Je conserve
        <div id="error" class="alert alert-danger alert-block" style="position: absolute; top: 0; right: 0;">
            <button type="button" class="close" data-dismiss="alert"> <i class="fa fa-times-circle"></i> </button>
            <strong>{{ __($message) }}</strong>
        </div>
        -->
        <div class="position-absolute w-100 d-flex flex-column p-4">
            <div class="toast ml-auto" role="alert" data-delay="700" data-autohide="false">
                <div class="toast-header">
                    <i class="fa fa-exclamation-triangle moco-color-error"></i>
                    <strong class="mr-auto ml-1 moco-color-error">{{__('Error')}}</strong>
                    <small class="text-muted"></small>
                    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                        <span aria-hidden="true"><i class="fa fa-times-circle light-blue-darker-hover"></i></span>
                    </button>
                </div>
                <div class="toast-body red lighten-4 moco-color-error font-weight-bold"> {{ __($message) }}</div>
            </div>
        </div>
    @endif

    @if ($message = Session::get('warning'))
        <div id="warning" class="alert alert-warning alert-block" style="position: absolute; top: 0; right: 0;">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ __($message) }}</strong>
        </div>
    @endif

    @if ($message = Session::get('info'))
    <!-- je conserve
        <div id="info" class="alert alert-info alert-block" style="position: absolute; top: 0; right: 0;">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ __($message) }}</strong>
        </div>
        -->
        <div class="position-absolute w-100 d-flex flex-column p-4">
            <div class="toast ml-auto" role="alert" data-delay="700" data-autohide="false">
                <div class="toast-header">
                    <i class="fa fa-exclamation-triangle moco-color-info"></i>
                    <strong class="mr-auto ml-1 moco-color-info">{{__('Error')}}</strong>
                    <small class="text-muted"></small>
                    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                        <span aria-hidden="true"><i class="fa fa-times-circle light-blue-darker-hover"></i></span>
                    </button>
                </div>
                <div class="toast-body blue lighten-4 moco-color-info font-weight-bold"> {{ __($message) }}</div>
            </div>
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
    <script type="text/javascript">
        $(function () {
            $('.toast').toast('show');
        })
    </script>
</div>
