@extends('base-page')

@section('browser-title')
    Login
@stop


@section('page-title')

@stop

@section('page-content')

    <div class="row">
        <div class="col-md-1"></div>

        <div class="col-md-10">

            <h1>Log In</h1>
            <hr>

            <div id="error" class="hidden"></div>

            <form class="form" role="form" method="post" action="/login" novalidate="novalidate">

                <div class="form-group">
                    <label for="email">Email</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-envelope fa-fw"></i></span>
                        <input class="form-control" type="email" name="email" id="email">
                    </div>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-lock fa-fw"></i></span>
                        <input class="form-control" type="password" name="password" id="password">
                    </div>
                </div>

                <hr>

                <div class="form-group">
                    <div class="input-group">
                        <input type="submit" class="btn btn-primary" value="Log In">
                    </div>
                </div>

            </form>
        </div>
    </div>
@stop