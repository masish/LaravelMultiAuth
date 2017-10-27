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
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>ゲーム開催時刻</th>
                            <th>スタジアム</th>
                            <th>ホーム</th>
                            <th>アウェイ</th>
                        </tr>
                        </thead>
                        @foreach($games as $game)
                            <tr>
                                <td>{!! link_to_action('Admin\GameController@show', $game->id, [$game->id]) !!}</td>
                                <td>{{ $game->game_time }}</td>
                                <td>{{ $stadiums[$game->stadium_id] }}</td>
                                <td>{{ $game->home_club }}</td>
                                <td>{{ $game->away_club }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection