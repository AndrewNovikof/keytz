@extends('layouts.app')

@section('content')

    <div class="uk-container uk-container-small uk-padding">
        <div class="uk-margin-xlarge uk-grid uk-grid-stack" uk-grid="">
            <div class="uk-width-1-1@m uk-first-column">
                <router-view></router-view>
                <router-view name="books"></router-view>
                <router-view name="catalogs"></router-view>
                <notifications></notifications>
            </div>
        </div>
    </div>
@endsection
