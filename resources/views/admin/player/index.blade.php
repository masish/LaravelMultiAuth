@extends('layouts.admin')
@section('content')
 
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">選手一覧</div>
                <div class="panel-body">
                    @if (Session::has('flash_message'))
                        <div class="alert alert-success">{{ Session::get('flash_message') }}</div>
                    @endif
                   <div class="mb10">
                        {!! link_to('admin/player/create', '新規作成', ['class' => 'btn btn-primary']) !!}
                    </div>
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>名前</th>
                            <th>背番号</th>
                            <th>ポジション</th>
                            <th>作成日</th>
                            <th>編集</th>
                        </tr>
                        </thead>
                        @foreach($players as $player)
                            <tr>
                                <td>{{ $player->id }}</td>
                                <td>{{ $player->name }}</td>
                                <td>{{ $player->number }}</td>
                                <td>{{ $player->position }}</td>
                                <td>{{ $player->created_at->format('Y年m月d日') }}</td>
                                <td>
                                    {!! link_to_action('Admin\PlayerController@show', '表示', [$player->id]) !!}
                                    {!! link_to_action('Admin\PlayerController@edit', '編集', [$player->id]) !!}
                                    {!! Form::model($player, ['url' => ['admin/player', $player->id],'method' => 'delete','class' => 'delete-from']) !!}
                                    {!! Form::submit('削除', ['onclick' => "return confirm('本当に削除しますか?')",'class' => 'text-link']) !!}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    {!! $players->render() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection