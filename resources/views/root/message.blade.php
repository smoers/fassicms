<!-- message -->

@if ($message = Session::get('success'))
    <script type="text/javascript">
        iziToast.success({
            title: '{{__('Success')}}',
            message: '{{__($message)}}',
            timeout: 10000,
        });
    </script>
@endif

@if ($message = Session::get('error'))
    <script type="text/javascript">
        iziToast.error({
            title: '{{__('Error')}}',
            message: '{{__($message)}}',
            timeout: 10000,
        });
    </script>
@endif

@if ($message = Session::get('warning'))
    <script type="text/javascript">
        iziToast.warning({
            title: '{{__('Warning')}}',
            message: '{{__($message)}}',
            timeout: 10000,
        });
    </script>
@endif

@if ($message = Session::get('info'))
    <script type="text/javascript">
        iziToast.info({
            title: '{{__('Info')}}',
            message: '{{__($message)}}',
            timeout: 10000,
        });
    </script>
@endif

@if ($errors->any())
        @foreach($errors->all() as $error)
            <script type="text/javascript">
                iziToast.error({
                    title: '{{__('Error')}}',
                    message: '{{__($error)}}',
                    timeout: 10000,
                });
            </script>
        @endforeach
@endif

