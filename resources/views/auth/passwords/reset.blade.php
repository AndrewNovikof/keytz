@extends('layouts.app')

@section('content')

    <div class="uk-container uk-margin-large">
        <div class="uk-grid uk-grid-large uk-grid-divider uk-grid-stack" uk-grid="">
            <div class="uk-width-1-4"></div>
            <div class="uk-width-1-2">
                <div class="uk-margin-medium" property="text">
                    <div class="woocommerce uk-align-center">
                        <h2>Reset Password</h2>
                        <form class="login" method="post"
                              action="{{ route('password.request') }}">
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
                                        <li><strong>Error:</strong> {{ $errors->first('password') }}</li>
                                    </ul>
                                @endif
                            </div>

                            <div class="uk-margin">
                                <label for="password-confirm">Confirm Password <span class="required">*</span></label>
                                <input class="input-text" type="password"
                                       name="password_confirmation"
                                       id="password-confirm" {{ $errors->has('password_confirmation') ? ' has-error' : '' }}>
                                @if ($errors->has('password_confirmation'))
                                    <ul class="woocommerce-error">
                                        <li><strong>Error:</strong> {{ $errors->first('password_confirmation') }}</li>
                                    </ul>
                                @endif
                            </div>


                            <div class="uk-margin">
                                <input type="submit" class="button" name="login" value="Reset Password">
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="uk-width-1-4"></div>
        </div>
    </div>s
@endsection
