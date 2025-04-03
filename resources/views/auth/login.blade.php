@extends('layouts.app')

@section('content')
<div class="container my-5 py-5">
    <div class="row">
        <div class="col-lg-4 col-md-8 col-12 mx-auto">
            <div class="card z-index-0 fadeIn3 fadeInBottom">
              <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-dark shadow-dark border-radius-lg py-3 pe-1">
                  <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">Sign in</h4>
                  <div class="row mt-3">
                    <div class="col-2 text-center ms-auto">
                      <a class="btn btn-link px-3" href="javascript:;">
                        <i class="fa fa-facebook text-white text-lg"></i>
                      </a>
                    </div>
                    <div class="col-2 text-center px-1">
                      <a class="btn btn-link px-3" href="javascript:;">
                        <i class="fa fa-github text-white text-lg"></i>
                      </a>
                    </div>
                    <div class="col-2 text-center me-auto">
                      <a class="btn btn-link px-3" href="javascript:;">
                        <i class="fa fa-google text-white text-lg"></i>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <form role="form" class="text-start" method="POST" action="{{ route('login') }}">
                  @csrf
                  
                  <div class="input-group input-group-outline my-3 @error('email') is-invalid @enderror">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                  </div>
                  @error('email')
                    <div class="text-danger text-xs mt-n2 mb-2">{{ $message }}</div>
                  @enderror
                  
                  <div class="input-group input-group-outline mb-3 @error('password') is-invalid @enderror">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" required autocomplete="current-password">
                  </div>
                  @error('password')
                    <div class="text-danger text-xs mt-n2 mb-2">{{ $message }}</div>
                  @enderror
                  
                  <div class="form-check form-switch d-flex align-items-center mb-3">
                    <input class="form-check-input" type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label mb-0 ms-3" for="remember">Remember me</label>
                  </div>
                  
                  <div class="text-center">
                    <button type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2">Sign in</button>
                  </div>
                  
                  @if (Route::has('password.request'))
                  <div class="text-center">
                    <a class="text-sm text-primary" href="{{ route('password.request') }}">
                      Forgot Your Password?
                    </a>
                  </div>
                  @endif
                  
                </form>
              </div>
            </div>
        </div>
    </div>
</div>
@endsection
