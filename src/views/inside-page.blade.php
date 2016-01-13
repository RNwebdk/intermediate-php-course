@extends('base-page')

@section('browser-title')
    {!! $browser_title or 'Untitled Page' !!}
@stop


@section('page-title')
    {!! $page_title or 'Untitled Page' !!}
@stop

@section('page-content')
    {!! $page_content or 'No content for this page' !!}
@stop