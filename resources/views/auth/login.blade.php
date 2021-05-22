<!--
Company : Fassi Belgium
Developed : MO-Consult
Authority : Moers Serge
Date : 27-10-20
-->
@extends('layouts.layout')

@section('content')

    <div id="loginmodal" class="modal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="container-fluid w-100">
                        <div class="d-flex justify-content-between">
                            <div class="p-2"><img src="./images/logo.png"></div>
                            <div class="p-2">
                                <select id="lang" class="form-control-sm">
                                    <option value="en" @if($cookie == 'en') selected @endif>EN</option>
                                    <option value="fr" @if($cookie == 'fr') selected @endif>FR</option>
                                    <option value="nl" @if($cookie == 'nl') selected @endif>NL</option>
                                </select>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <div class="p-2 blue-darker-hover" style="font-size: 34px; font-weight: bold; font-style: italic">Stock Management System</div>
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <!--
                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        -->
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>
                                <!--
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                                -->
                            </div>
                        </div>
                    </form>

                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <div>Developed by MO Consult <i class="fas fa-copyright"></i> {{ date('yy') }}</div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="{{ asset('js/moco.redirect.js') }}"></script>
    <script>
        $(document).ready(function(){
            /** Ouverture du formulaire de connexion en mode modal **/
            $('#loginmodal').modal('show');
            /** cookie pour la langue **/
            $('#lang').on('change',function(){
                let data = [];
                data['_token'] = $('meta[name="csrf-token"]').attr('content');
                data['lg'] = $('#lang').val();
                $.redirect({
                    url: '{{ route('login.setcookie') }}',
                    method: 'post',
                    data: data,
                });
            });
        });
    </script>
@endsection
