@extends('layouts.admin')
@section('content')
 
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">新規作成</div>
                <div class="panel-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    {!! Form::open(['url' => 'admin/game',
                                'class' => 'form-horizontal',
                                'id' => 'post-input']) !!}                    @include('admin.game.fields')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection