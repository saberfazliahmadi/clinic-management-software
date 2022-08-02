@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <center>
                <div class="col-md-6 col-sm-12 col-xs-12" style="float:none;">
                    <div for="email" class="col-md-12 col-sm-12 col-xs-12" style="font-size: 22px;text-align: left;" >
                        {{ __('E-Mail Address') }}
                    </div>

                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus style="float:none;">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6 col-sm-12 col-xs-12" style="float:none;">
                    <div for="password" class="col-md-12 col-sm-12 col-xs-12" style="font-size: 22px;text-align: left;" >
                        {{ __('Password') }}
                    </div>

                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" style="float:none;">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6 col-sm-12 col-xs-12" style="float:none;" >
                    <div class="col-md-12 col-sm-12 col-xs-12 offset-md-4" >
                        <div class="form-check" style="float:left;padding-bottom:15px;padding-top:15px;" >
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" style="float:none;" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember" style="float:none;" >
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-sm-12 col-xs-12" style="float:none;" >

                    <div class="col-md-12 col-sm-12 col-xs-12" >
                        <button type="submit" class="col-md-12 col-sm-12 col-xs-12 btn btn-primary" style="float:none;font-size: 26px;">
                            {{ __('Login') }}
                        </button>
                    </div>

                    <div class="col-md-12 col-sm-12 col-xs-12" >
                        @if (Route::has('password.request'))
                            <a class="col-md-12 col-sm-12 col-xs-12 btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    </div>

                </div>
                </center>

            </form>

        </div>
    </div>
</div>
@endsection

<?php
if($errors->any())
{
    foreach($errors->all() as $error)
    {
        echo '
        <div class="col-md-12 col-sm-12 col-xs-12 alert alert-danger" role="alert" style="float:right;" > <button type="button" class="close" data-dismiss="alert" aria-label="Close"  ><span aria-hidden="true">&times;</span></button> <h4 style="font-size:25px;text-align:center!important;overflow-wrap: break-word; word-wrap: break-word; hyphens: auto;" >'.$error.'</h4></div>' ;
    }
}

if( Session::get('success_message') !== '' && session()->has('success_message') )
{
    echo '<div class="col-md-12 col-sm-12 col-xs-12" style="float:right!important;" ><div class="col-md-12 col-sm-12 col-xs-12 alert alert-success" role="alert" style="text-align:center!important;overflow-wrap: break-word; word-wrap: break-word; hyphens: auto;float:right!important;" > <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="font-size:50px;margin-left:15px!important;" ><span aria-hidden="true">&times;</span></button><h3>'.Session::get('success_message').'</h3></div></div>' ;
    session()->pull('success_message') ;
}
?>