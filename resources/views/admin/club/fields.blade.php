<div class="form-group">
    {!! Form::label('name', 'クラブ名:', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group">
    <div class="col-sm-10 col-sm-offset-2">
        {!! Form::submit('保存', ['class' => 'btn btn-primary']) !!}
        {!! link_to('admin/club', '一覧へ戻る', ['class' => 'btn btn-default']) !!}
    </div>
</div>