@extends('layouts.auth.app')

@section('content')
<div class="page-body-wrapper full-page-wrapper">
    <div class="row w-100 m-0">
        <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">
            <div class="card w-75 mx-auto bg-dark text-white-50" style="max-width: 350px">
                <a href="/" class="btn btn-info"> <i class="mdi mdi-home-variant"></i>Travels Vikings</a>
                <div class="card-body py-5">
                    <h3 class="card-title text-gray text-left mb-3">Sign Up</h3>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-group">
                            <label>{{ __('Email Address *') }}</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text py-0" id="basic-addon1"><i
                                        class="mdi mdi-email"></i></span>
                                <input type="email" class="form-control p_input @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required />
                            </div>
                            @error('email')
                            <code class="text-danger">
                                <strong>{{ $message }}</strong>
                            </code>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>{{ __('Username *') }}</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text py-0" id="basic-addon1"><i
                                        class="mdi mdi-account"></i></span>
                                <input type="text" class="form-control p_input @error('username') is-invalid @enderror"
                                    name="username" value="{{ old('username') }}" required autocomplete=off />
                            </div>
                            @error('username')
                            <code class="text-danger">
                                                            <strong>{{ $message }}</strong>
                                                        </code>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>{{ __('Phone Number *') }}</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text py-0" id="basic-addon1"><i
                                        class="mdi mdi-phone"></i></span>
                                <input type="text"
                                    class="form-control p_input @error('phone_number') is-invalid @enderror"
                                    name="phone_number" value="{{ old('phone_number') }}" required />
                            </div>
                            @error('phone_number')
                            <code class="text-danger">
                                                            <strong>{{ $message }}</strong>
                                                        </code>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>{{ __('Invitation Code *') }}</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text py-0" id="basic-addon1"><i
                                        class="mdi mdi-barcode"></i></span>
                                <input type="text"
                                    class="form-control p_input @error('invitation_code') is-invalid @enderror"
                                    name="invitation_code" value="{{ old('invitation_code') }}" required />
                            </div>
                            @error('invitation_code')
                            <code class="text-danger">
                                                            <strong>{{ $message }}</strong>
                                                        </code>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>{{ __('Password *') }}</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text py-0" id="basic-addon1"><i
                                        class="mdi mdi-lock"></i></span>
                                <input type="password"
                                    class="form-control p_input @error('password') is-invalid @enderror" name="password"
                                    required />
                            </div>
                            @error('password')
                            <code class="text-danger">
                                                            <strong>{{ $message }}</strong>
                                                        </code>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>{{ __('Confirm Password *') }}</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text py-0" id="basic-addon1"><i
                                        class="mdi mdi-lock"></i></span>
                                <input type="password"
                                    class="form-control p_input @error('password_confirmation') is-invalid @enderror"
                                    name="password_confirmation" required />
                            </div>
                            @error('password_confirmation')
                            <code class="text-danger">
                                                            <strong>{{ $message }}</strong>
                                                        </code>
                            @enderror
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn px-4 btn-primary btn-block enter-btn">
                                Register
                            </button>
                        </div>
                        <p class="sign-up">
                            Already Registred?<a href="{{ route('login') }}" class="mx-1">Login Now</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
    </div>
    <!-- row ends -->
</div>
@endsection