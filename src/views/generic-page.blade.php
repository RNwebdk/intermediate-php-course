@extends('base-page')

@section('browser-title')
    {!! $title or 'Untitled Page' !!}
@stop


@section('page-title')
    {!! $title or 'Untitled Page' !!}
@stop

@section('page-content')
    {!! $content or 'No content for this page' !!}
@stop