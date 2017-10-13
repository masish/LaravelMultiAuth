@extends('layouts.admin')
@section('content')
 
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">ゲーム一覧</div>
                <div class="panel-body">
                    @if (Session::has('flash_message'))
                        <div class="alert alert-success">{{ Session::get('flash_message') }}</div>
                    @endif
                   <div class="mb10">
                        {!! link_to('admin/game/create', '新規作成', ['class' => 'btn btn-primary']) !!}
                    </div>
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>ゲーム開催時刻</th>
                            <th>スタジアム</th>
                            <th>ホーム</th>
                            <th>アウェイ</th>
                            <th>作成日</th>
                            <th>編集</th>
                        </tr>
                        </thead>
                        @foreach($games as $game)
                            <tr>
                                <td>{{ $game->id }}</td>
                                <td>{{ $game->game_time }}</td>
                                <td>{{ $stadiums[$game->stadium_id] }}</td>
                                <td>{{ $game->home_club }}</td>
                                <td>{{ $game->away_club }}</td>
                                <td>{{ $game->created_at->format('Y年m月d日') }}</td>
                                <td>
                                    {!! link_to_action('Admin\GameController@show', '表示', [$game->id]) !!}
                                    {!! link_to_action('Admin\GameController@edit', '編集', [$game->id]) !!}
                                    {!! Form::model($game, ['url' => ['admin/game', $game->id],'method' => 'delete','class' => 'delete-from']) !!}
                                    {!! Form::submit('削除', ['onclick' => "return confirm('本当に削除しますか?')",'class' => 'text-link']) !!}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection