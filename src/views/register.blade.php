@extends('base-page')

@section('browser-title')
    Register
@stop


@section('page-title')

@stop

@section('page-content')
    <div class="row">
        <div class="col-md-1"></div>

        <div class="col-md-10">

            <h1>Register</h1>
            <hr>

            <form class="form" role="form" method="post" action="/register">

                <div class="form-group">
                    <label for="first_name">First Name</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-font fa-fw"></i></span>
                        <input class="form-control" type="text" name="first_name" id="first_name">
                    </div>
                </div>

                <div class="form-group">
                    <label for="last_name">Last Name</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-font fa-fw"></i></span>
                        <input class="form-control" type="text" name="last_name" id="last_name">
                    </div>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-envelope fa-fw"></i></span>
                        <input class="form-control" type="email" name="email" id="email">
                    </div>
                </div>

                <div class="form-group">
                    <label for="confirm-email">Confirm Email</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-envelope fa-fw"></i></span>
                        <input class="form-control" type="confirm-email" name="confirm-email" id="email">
                    </div>
                </div>

                <hr>

                <div class="form-group">
                    <div class="input-group">
                        <input type="submit" class="btn btn-primary" value="Register">
                    </div>
                </div>


            </form>

        </div>
    </div>

@stop