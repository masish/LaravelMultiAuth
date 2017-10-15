<div class="form-group">
    {!! Form::label('name', '開催日:', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::date('game_date', null, ['class' => 'form-control']) !!}
    </div>
    <div class="col-sm-10">
        {!! Form::time('game_time', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('stadium_id', 'スタジアム:', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::select('stadium_id', $stadiums) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('home_club_id', 'ホーム:', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::select('home_club_id', $clubs) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('away_club_id', 'アウェイ:', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::select('away_club_id', $clubs) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('first_scored_player_id', '最初の得点者:', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::select('first_scored_player_id', $players) !!}
    </div>
</div>

<div class="form-group">
    <div class="col-sm-10 col-sm-offset-2">
        {!! Form::submit('保存', ['class' => 'btn btn-primary']) !!}
        {!! link_to('admin/player', '一覧へ戻る', ['class' => 'btn btn-default']) !!}
    </div>
</div>