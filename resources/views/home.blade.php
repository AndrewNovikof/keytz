@extends('layouts.app')

@section('content')
    <router-view></router-view>
    <router-view name="books"></router-view>
    <router-view name="catalogs"></router-view>
    <notifications></notifications>
@endsection
