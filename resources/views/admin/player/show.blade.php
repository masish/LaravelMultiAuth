@extends('layouts.admin')
@section('content')
 
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">選手詳細</div>
                <div class="panel-body">
                    <div>
                        <h1>{{ $player->name }}</h1>
                        <p>{{ $player->club->name }}</p>
                        <p>{{ $player->number }}</p>
                        <p>{{ $positions[$player->position] }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection