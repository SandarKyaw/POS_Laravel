@extends('admin.layouts.master')

@section('title', 'password change page')

@section('content')

    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">

                <div class="col-lg-6 offset-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Change Password</h3>
                            </div>
                            <hr>

                            <form action="{{route('account#pwChange')}}" method="post" novalidate="novalidate">
                                @csrf

                                <div class="form-group">
                                    <label class="control-label mb-2">Old Password</label>
                                    <input name="oldPassword" type="password"
                                        class="form-control @error('oldPassword') is-invalid

                                @enderror    @if (session('incorrectPassword')) is-invalid @endif"
                                        aria-required="true" aria-invalid="false" placeholder="Enter Old Password...">
                                    @error('oldPassword')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                    @if (session('incorrectPassword'))
                                    <div class="invalid-feedback">
                                        {{session('incorrectPassword')}}
                                    </div>
                                    @endif

                                </div>



                                <div class="form-group">
                                    <label class="control-label mb-2">New Password</label>
                                    <input name="newPassword" type="password"
                                        class="form-control @error('newPassword') is-invalid

                                @enderror"
                                        aria-required="true" aria-invalid="false" placeholder="Enter New Password...">
                                    @error('newPassword')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="control-label mb-2">Confirm Password</label>
                                    <input name="confirmPassword" type="password"
                                        class="form-control @error('confirmPassword') is-invalid

                                @enderror"
                                        aria-required="true" aria-invalid="false" placeholder="Enter Confirm Password...">
                                    @error('confirmPassword')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div>
                                    <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block ">

                                        <span id="payment-button-amount">Change Pasword</span>

                                        <i class="fa-solid fa-circle-right"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
    <!-- END PAGE CONTAINER-->

@endsection


