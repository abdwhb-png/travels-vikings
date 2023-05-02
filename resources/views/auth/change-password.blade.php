@extends('layouts.auth.app')

@section('content')
<div class="page-body-wrapper full-page-wrapper">
    <div class="row w-100 m-0">
        @if(isset ($errors) && count($errors) > 0)
        <div class="alert alert-danger alert-dismissible fade show form-group--error col-lg-6 col-sm-8 mx-auto my-2 mx-3"
            role="alert"
            data-tor="show:rotateX.from(90deg) show:@--tor-translateZ(-5rem;0rem) show:pull.down(half) perspective-self(3000px) slow">
            <div class="center-v"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-exclamation-triangle-fill me-2" viewBox="0 0 16 16">
                    <path
                        d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z">
                    </path>
                </svg> Oooops!! Something is wrong.</div>
            <hr>
            @foreach($errors->all() as $error)
            <p class="mb-0 small opacity-70">{{ $error }}</p>
            @endforeach
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">
            <div class="card w-75 mx-auto bg-dark text-white-50" style="max-width: 350px">
                <a href="/" class="btn btn-info"> <i class="mdi mdi-home-variant"></i>Travels Vikings</a>
                <div class="card-body py-5">
                    <h3 class="card-title text-gray text-left mb-3">Change Password</h3>
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    <a href="/" class="btn btn-primary">Dashboard</a>
                    @elseif (session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                    </div>
                    @endif
                    @if (!session('status'))
                    <form method="POST" action="{{ route('change.password') }}">
                        @csrf
                        <div class="form-group">
                            <label>{{ __('Old Password *') }}</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text py-0" id="basic-addon1"><i class="mdi mdi-lock"></i></span>
                                <input type="password" class="form-control p_input @error('old_password') is-invalid @enderror" name="old_password"
                                    required autocomplete="current-password" />
                            </div>
                            @error('old_password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>{{ __('New Password *') }}</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text py-0" id="basic-addon1"><i
                                        class="mdi mdi-lock"></i></span>
                                <input type="password"
                                    class="form-control p_input @error('new_password') is-invalid @enderror" name="new_password"
                                    required autocomplete="off" />
                            </div>
                            @error('new_password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>{{ __('Confirm Password *') }}</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text py-0" id="basic-addon1"><i class="mdi mdi-lock"></i></span>
                                <input type="password" class="form-control p_input @error('new_password_confirmation') is-invalid @enderror"
                                    name="new_password_confirmation" required />
                            </div>
                            @error('new_password_confirmation')
                            <code class="text-danger">
                                                                                    <strong>{{ $message }}</strong>
                                                                                </code>
                            @enderror
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn px-4 btn-primary btn-block enter-btn">
                                Reset Password
                            </button>
                        </div>
                    </form>
                    @endif
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
    </div>
    <!-- row ends -->
</div>
@endsection