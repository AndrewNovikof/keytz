@extends('layouts.app')

@section('content')
    <div class="uk-container uk-margin-large">
        <div class="uk-grid uk-grid-large uk-grid-divider uk-grid-stack" uk-grid="">
            <div class="uk-width-1-4"></div>
            <div class="uk-width-1-2">
                <div class="uk-margin-medium" property="text">
                    <div class="woocommerce uk-align-center">
                        <h2>Reset Password</h2>
                        <form class="woocommerce-form woocommerce-form-login login" method="post"
                              action="{{ route('password.email') }}">
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
                                <input type="submit" class="button" name="login" value="Send Password Reset Link">
                            </div>


                            @if (session('status'))
                                <div class="uk-alert-success" uk-alert>
                                    {{ session('status') }}
                                    <a class="uk-alert-close" uk-close></a>
                                </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>

            <dib class="uk-width-1-4"></dib>
        </div>
    </div>
@endsection
