@extends('layouts.admin')
@section('content')
 
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">クラブ詳細</div>
                <div class="panel-body">
                    <div>
                        <h1>{{ $club->name }}</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection