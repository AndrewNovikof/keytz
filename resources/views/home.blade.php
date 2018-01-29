@extends('layouts.app')

@section('content')
<div class="uk-container uk-container-large">
    <div class="row">
        @for($i = 1; $i < 100; $i++)
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">

                    You are logged in!
                </div>
            </div>
        </div>
        @endfor
    </div>
</div>
@endsection
