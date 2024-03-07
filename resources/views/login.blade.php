@extends('layouts.master')

@section('title','Login Page')

@section('content')

<div class="pwChangeSuccess">
    @if (session('pwChangeSuccess'))
<div class="row">
  <div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong> <i class="fa-solid fa-check"></i> {{session('pwChangeSuccess')}}</strong>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
 </div>
@endif
</div>

<div class="login-form">
    <form action="{{ route('login')}}" method="post">
        @csrf
        @error('terms')
        <small class="text-danger">{{$message}}</small>
        @enderror
        <div class="form-group">
            <label>Email Address</label>
            <input class="au-input au-input--full" type="email" name="email" placeholder="Email">
        </div>
        @error('address')
        <small class="text-danger">{{$message}}</small>
        @enderror
        <div class="form-group">
            <label>Password</label>
            <input class="au-input au-input--full" type="password" name="password" placeholder="Password">
        </div>
        @error('password')
        <small class="text-danger">{{$message}}</small>
        @enderror

        <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">sign in</button>

    </form>
    <div class="register-link">
        <p>
            Don't you have account?
            <a href="{{ route('auth#registerPage')}}">Sign Up Here</a>
        </p>
    </div>
</div>

@endsection


