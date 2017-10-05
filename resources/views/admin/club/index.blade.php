@extends('layouts.admin')
@section('content')
 
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">クラブ一覧</div>
                <div class="panel-body">
                    @if (Session::has('flash_message2'))
                        <div class="alert alert-success">{{ Session::get('flash_message2') }}</div>
                    @endif
                   <div class="mb10">
                        {!! link_to('admin/club/create', '新規作成', ['class' => 'btn btn-primary']) !!}
                    </div>
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>チーム名</th>
                            <th>作成日</th>
                            <th>編集</th>
                        </tr>
                        </thead>
                        @foreach($clubs as $club)
                            <tr>
                                <td>{{ $club->id }}</td>
                                <td>{{ $club->name }}</td>
                                <td>{{ $club->created_at->format('Y年m月d日') }}</td>
                                <td>
                                    {!! link_to_action('Admin\ClubController@show', '表示', [$club->id]) !!}
                                    {!! link_to_action('Admin\ClubController@edit', '編集', [$club->id]) !!}
                                    {!! Form::model($club, ['url' => ['admin/club', $club->id],'method' => 'delete','class' => 'delete-from']) !!}
                                    {!! Form::submit('削除', ['onclick' => "return confirm('本当に削除しますか?')",'class' => 'text-link']) !!}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    {!! $clubs->render() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection