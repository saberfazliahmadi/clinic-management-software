@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <center>
                        <div class="col-md-6 col-sm-12 col-xs-12" style="float:none;">
                            <div for="name" class="col-md-12 col-sm-12 col-xs-12" style="font-size: 22px;text-align: left;" >
                                {{ __('Name') }}
                            </div>

                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-12 col-xs-12" style="float:none;">
                            <div for="email" class="col-md-12 col-sm-12 col-xs-12" style="font-size: 22px;text-align: left;" >
                                {{ __('E-Mail Address') }}
                            </div>

                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

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
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-12 col-xs-12" style="float:none;">
                            <div for="password-confirm" class="col-md-12 col-sm-12 col-xs-12" style="font-size: 22px;text-align: left;" >
                                {{ __('Confirm Password') }}
                            </div>

                            <div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 30px;">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-12 col-xs-12" style="float:none;">
                            <div class="col-md-12 col-sm-12 col-xs-12" style="font-size: 22px;text-align: left;" >
                                <div class="col-md-6 col-sm-6 col-xs-12 form-radio col-sm">
                                    <div class="col-md-12 col-sm-12 col-xs-12" style="font-size: 22px;text-align: left;" >
                                        <input type="radio" autofocus class="form-control @error('gender') is-invalid @enderror" name="gender" value="Male" checked> Female
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12 form-radio col-sm">
                                    <div class="col-md-12 col-sm-12 col-xs-12" style="font-size: 22px;text-align: left;" >
                                        <input type="radio" autofocus class="form-control @error('gender') is-invalid @enderror" name="gender" value="Female"> Male
                                    </div>
                                </div>
                                @error('gender')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-12 col-xs-12" style="float:none;">
                            <div class="col-md-12 col-sm-12 col-xs-12" style="font-size: 22px;text-align: left;margin-top:30px;" >
                                <input id="datepicker" type="text"
                                       class="date form-control @error('dob') is-invalid @enderror" name="dob"
                                       value="{{ old('dob') }}" required autofocus
                                       placeholder="Date of Birth">
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <i class="mdi mdi-check-circle-outline"></i>
                                    </span>
                                </div>
                                @error('dob')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-12 col-xs-12" style="float:none;">
                            <div class="col-md-12 col-sm-12 col-xs-12" style="font-size: 22px;text-align: left;margin-top:30px;" >
                                <input id="phone" type="text"
                                       class="form-control @error('phone') is-invalid @enderror" name="phone"
                                       value="{{ old('phone') }}" required autocomplete="phone" autofocus
                                       placeholder="Phone Number">
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <i class="mdi mdi-check-circle-outline"></i>
                                    </span>
                                </div>
                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-12 col-xs-12" style="float:none;">
                            <div class="col-md-12 col-sm-12 col-xs-12" style="font-size: 22px;text-align: left;" >
                                <button type="submit" class="col-md-12 col-sm-12 col-xs-12 btn btn-primary" style="float:none;font-size: 26px;margin-top:30px;">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                        </center>

                    </form>

            </div>
        </div>
    </div>
@endsection
