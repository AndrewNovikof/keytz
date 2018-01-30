@extends('layouts.app')

@section('content')
    <div class="uk-container uk-margin-large">
        <div class="uk-grid uk-grid-large uk-grid-divider uk-grid-stack" uk-grid="">
            <div class="uk-width-1-4"></div>
            <div class="uk-width-1-2">
                <div class="uk-margin-medium" property="text">
                    <div class="woocommerce uk-align-center">
                        <h2>Login</h2>
                        <form class="woocommerce-form woocommerce-form-login login" method="post"
                              action="{{ route('login') }}">
                            {{ csrf_field() }}
                            <div class="uk-margin">
                                <label for="email">E-Mail Address <span class="required">*</span></label>
                                <input type="text" class="input-text"
                                       name="email" id="email" value="{{ old('email') }}">
                                @if ($errors->has('email'))
                                    <ul class="woocommerce-error">
                                        <li><strong>Error:</strong> {{ $errors->first('email') }}</li>
                                    </ul>
                                @endif
                            </div>

                            <div class="uk-margin">
                                <label for="password">Password <span class="required">*</span></label>
                                <input class="input-text" type="password"
                                       name="password"
                                       id="password" {{ $errors->has('password') ? ' has-error' : '' }}>
                                @if ($errors->has('password'))
                                    <ul class="woocommerce-error">
                                        <li><strong>Error:</strong> {{ $errors->first('email') }}</li>
                                    </ul>
                                @endif
                            </div>


                            <div class="uk-margin">
                                <input type="submit" class="button" name="login" value="Login">
                                <label for="rememberme">
                                    <input class="uk-checkbox"
                                           name="rememberme" type="checkbox"
                                           id="rememberme" {{ old('remember') ? 'checked' : '' }}>
                                    <span>Remember me</span>
                                </label>
                            </div>

                            <div class="uk-margin">
                                <a href="{{ route('password.request') }}">Lost
                                    your password?</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="uk-width-1-4"></div>
        </div>
    </div>
@endsection
