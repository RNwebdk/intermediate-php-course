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

            <form class="form" role="form" method="post" action="/register" novalidate="novalidate">

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
                        <input class="form-control" type="email" name="confirm-email" id="confirm-email">
                    </div>
                </div>

                <div class="form-group">
                    <label>Join our mailing list?</label>
                    <div class="input-group">
                        <div class="radio">
                            <label>
                                <input type="radio" name="join_list" value="1" checked>
                                Yes
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="join_list" value="0">
                                No
                            </label>
                        </div>
                    </div>
                </div>


                <div class="form-group">
                    <div class="input-group">
                        <div class="checkbox">
                            <label>
                                <input name="agree" type="checkbox" value="1">
                                I agree to abide by the site's terms and conditions
                            </label>
                        </div>
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