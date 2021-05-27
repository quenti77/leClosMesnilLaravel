@extends('layouts.app')
@section('title', '| Edit Post')
<h1>Show experience {{ $post->id }}{{ $post->title }}</h1>
@section('content')
{!! Form::model($post, ['route' => ['admin.post.update', $post->id], "method" => "PUT" ]) !!}
<div class="form-group">
    {{ Form::label('title', 'title :', ["class" => "form-spaceing-top, font-weight-bold" ]) }}
    {{ Form::text('title', null, ["class" => 'form-control']) }}

    {{ Form::label('content', 'content :', ["class" => "form-spaceing-top, font-weight-bold" ]) }}
    {{ Form::text('content', null, ["class" => 'form-control']) }}
</div>
{{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
{!! Form::close() !!}
@endsection
