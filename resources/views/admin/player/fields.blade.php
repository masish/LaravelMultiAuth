<div class="form-group">
    {!! Form::label('name', '名前:', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('number', '背番号:', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::text('number', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('club_id', '所属クラブ:', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::select('club_id', $clubs) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('position', 'ポジション:', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::select('position', $positions) !!}
    </div>
</div>

<div class="form-group">
    <div class="col-sm-10 col-sm-offset-2">
        {!! Form::submit('保存', ['class' => 'btn btn-primary']) !!}
        {!! link_to('admin/player', '一覧へ戻る', ['class' => 'btn btn-default']) !!}
    </div>
</div>