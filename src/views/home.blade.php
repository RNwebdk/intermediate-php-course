@extends('base-page')

@section('browser-title')
    {!! $browser_title or 'Untitled Page' !!}
@stop

@section('slider')

    <div id="carousel-slider" class="carousel slide carousel-fade hidden-xs" data-pause="hover" data-ride="carousel"
         data-interval="4500">

        <ol class="carousel-indicators">
            <li data-target="#carousel-slider" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-slider" data-slide-to="1"></li>
        </ol>

        <div class="carousel-inner" role="listbox">
            <div class="item active">
                <img src="/images/home-page/river.png" alt="Slide1">
                <div class="container">

                </div>
            </div>
            <div class="item">
                <img src="/images/home-page/desert.png" alt="Slide2">
                <div class="container">

                </div>
            </div>
        </div>
    </div>

@stop

@section('page-title')
    {!! $page_title or 'Untitled Page' !!}
@stop

@section('page-content')
    {!! $page_content or 'No content for this page' !!}
@stop