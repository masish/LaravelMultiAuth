@extends('layouts.admin')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">メニュー</div>
        <div class="panel-body">
          <table class="table table-striped table-bordered table-hover">
            <tr><td>{!! link_to_action('Admin\ClubController@index', 'クラブ') !!}</td></tr>
            <tr><td>{!! link_to_action('Admin\GameController@index', 'ゲーム') !!}</td></tr>
            <tr><td>{!! link_to_action('Admin\PlayerController@index', '選手') !!}</td></tr>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection