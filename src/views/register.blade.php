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

            <div id="error" class="hidden"></div>

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
                    <label for="password">Choose a Password</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-lock fa-fw"></i></span>
                        <input class="form-control" type="password" name="password" id="password">
                    </div>
                </div>

                <div class="form-group">
                    <label for="confirm-password">Confirm Password</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-lock fa-fw"></i></span>
                        <input class="form-control" type="password" name="confirm-password" id="confirm-password">
                    </div>
                </div>

                <div class="form-group">
                    <label for="colour">Favourite Colour?</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-info-circle fa-fw"></i></span>
                        <select name="colour" class="form-control">
                            <option value="red">Red</option>
                            <option value="blue">Blue</option>
                            <option value="green">Green</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="colour">Tell us something interesting</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-question fa-fw"></i></span>
                        <textarea name="comments" class="form-control"></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label>Join our mailing list?</label>
                    <div class="input-group">
                        <div class="radio">
                            <label>
                                <input type="radio" name="join_mailing_list" value="1" id="join_list">
                                Yes
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="join_mailing_list" value="0" id="subscribe-no">
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