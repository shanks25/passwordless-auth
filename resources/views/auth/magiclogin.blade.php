@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">{{ __('Login') }}</div>

        <div class="card-body">
         @if (session('success'))
         <div class="alert alert-success">
          {{session('success')}}
        </div>
        @endif
        @if (session('error'))
        <div class="alert alert-danger">
          {{session('error')}}
        </div>
        @endif
        <form method="POST" action="{{ route('login.magic') }}">
          @csrf 
          <div class="form-group row">
            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label> 
            <div class="col-md-6">
              <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

              @error('email')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
          </div>


          <div class="form-group row">
            <div class="col-md-6 offset-md-4">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                <label class="form-check-label" for="remember">
                  {{ __('Remember Me') }}
                </label>
              </div>
            </div>
          </div>

          <div class="form-group row mb-0">
            <div class="col-md-8 offset-md-4">
              <button type="submit" class="btn btn-primary">
               Send Magic Link
             </button>
             <a href="{{ route('login') }}" class="btn btn-link">Login With Password</a>
           </div>
         </div>

       </form>
     </div>
   </div>
 </div>
</div>
</div>
@endsection
