@extends('layouts-admin.main-login')
@section('title','Sign Up')

    
@section('container')
<section class="">
  <!-- Jumbotron -->
  <div class="px-4 py-4 px-md-5 text-center text-lg-start" style="background-color: hsl(0, 0%, 96%)">
    <div class="container">
      <div class="row">
          <h1 class="my-2 display-3 fw-bold ls-tight">
            Explore Your Future<br />
            <span class="text-danger">at Hogwarts University</span>
          </h1>

        <div class="row">
          <div class="card">
            <div class="card-body py-5 px-md-5">
              <form action="{{ route('register') }}" method="POST">
                
                @csrf
                <!-- 2 column grid layout with text inputs for the first and last names -->
                <div class="form-outline mb-4">
                        <label class="form-label" for="name">{{ __('Nama Lengkap') }}</label>
                      <input type="text" id="name" class="form-control @error('name') is-invalid @enderror" name="name" required value="{{old('name')}}"  />
                      @error('name')
                      <div  class="invalid-feedback">
                        {{ $message }}
                      </div>
                      @enderror
                    </div>
                  

                  <div class="form-outline mb-4">
                    <label class="form-label" for="email">{{ __('Email Address') }}</label>
                      <input type="email" id="email" class="form-control @error('email') is-invalid @enderror" name ="email" required value="{{old('email')}}"  />
                      @error('email')
                      <div  class="invalid-feedback">
                        {{ $message }}
                      </div>
                      @enderror
                    </div>
                    
                <div class="form-outline mb-4">
                    <label class="form-label" for="password">{{ __('Password') }}</label>
                  <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" required />
                  @error('password')
                      <div  class="invalid-feedback">
                        {{ $message }}
                      </div>
                      @enderror
                </div>

                <div class="form-outline mb-4">
                <label for="password-confirm">{{ __('Confirm Password') }}</label>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                </div>   
                
                <div>
                <button type="submit" class="btn btn-danger btn-block mb-4" style="width:100%;" >
                {{ __('Register') }}
                </button>
                </div>
                

                <!-- Register buttons -->
                <div class="text-center">
                  <p>Sudah punya akun? <a href="{{ route('login') }}">Sign In!</a></p>
                  
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


@endsection