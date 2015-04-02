@extends('blog')

@section('browser-title')
	News: {{ $post->title }}
@endsection

@section('meta_description')
	{{ $post->meta_description }}
@endsection

@section('meta_keywords')
	{{ $post->meta_keywords }}
@endsection


@section('content')

	@include('blog.partials.details')

@stop
