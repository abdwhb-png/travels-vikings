@extends('layouts.auth.app')

@section('content')
<div class="page-body-wrapper full-page-wrapper">
    <div class="row w-100 m-0">
        <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">
            <div class="card w-75 mx-auto bg-dark text-white-50" style="max-width: 350px">
                <a href="/" class="btn btn-info btn-arrow-left">Back To Home</a>
                <div class="card-body py-5">
                    <h3 class="card-title text-gray text-left mb-3">Reset password</h3>
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus id="floatingInput">
                            <label for="floatingInput" class="text-black">Email address</label>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn px-4 btn-primary btn-block enter-btn">
                                Send password reset link
                            </button>
                        </div>
                        <p class="sign-up">
                           Or <a href="{{ route('login') }}" class="mx-1">Login</a>
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