@extends('admin.layouts.master')

@section('title', 'role change page')

@section('content')

    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">

                <div class="col-lg-10 offset-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Change Role</h3>
                            </div>
                            <hr>
                            <form action="{{ route('account#change', $account->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="image col-4 offset-1">
                                        <a href="#">
                                            @if ($account->image == null)
                                            @if ($account->gender == 'male')
                                            <img src="{{asset('image/defaultImage.jpg')}}" alt="" class="shadow-sm img-thumbnail">
                                            @else
                                            <img src="{{asset('image/female_default.png')}}" alt="" class="shadow-sm img-thumbnail">
                                            @endif
                                            @else
                                                <img src="{{ asset('storage/' . $account->image) }}" alt="John Doe"
                                                    class="shadow-sm img-thumbnail" />
                                            @endif
                                        </a>

                                        <div class="row"> <button type="submit"
                                                class="btn btn-dark col-10 offset-1 mt-4"> <i
                                                    class="fa-solid fa-pen-to-square mr-2"></i> Change</button></div>
                                    </div>

                                    <div class="col-6">

                                        <div class="form-group">
                                            <label class="control-label mb-2">Role : </label>
                                            <select name="role" class="form-control">
                                                <option value="admin" @if ($account->role == 'admin' )
                                                    selected
                                                @endif >Admin</option>
                                                <option value="user" @if ($account->role == 'user' )
                                                    selected
                                                @endif >User</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label mb-2">Name</label>
                                            <input name="name" disabled type="text"
                                                class="form-control @error('name') is-invalid
                                        @enderror"
                                                aria-required="true" aria-invalid="false"
                                                value="{{ old('name', $account->name) }}"
                                                placeholder="Enter Your Name...">
                                            @error('name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label mb-2">Email</label>
                                            <input name="email" disabled type="email"
                                                class="form-control @error('email') is-invalid

                                        @enderror"
                                                aria-required="true" aria-invalid="false"
                                                value="{{ old('email', $account->email) }}"
                                                placeholder="Enter Email...">
                                            @error('email')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label mb-2">Phone</label>
                                            <input name="phone" disabled type="number"
                                                class="form-control @error('phone') is-invalid

                                        @enderror"
                                                aria-required="true" aria-invalid="false"
                                                value="{{ old('phone', $account->phone) }}"
                                                placeholder="Enter Phone...">
                                            @error('phone')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label mb-2">Gender</label>
                                            <select name="gender" disabled id=""
                                                class="form-control @error('gender')
                                            is-invalid
                                            @enderror">
                                                <option value="">Choose Gender</option>
                                                <option value="male" @if ($account->gender == 'male') selected @endif()>
                                                    Male</option>
                                                <option value="female" @if ($account->gender == 'female') selected @endif>
                                                    Female</option>
                                            </select>

                                        </div>

                                        <div class="form-group">
                                            <label class="control-label mb-2">Address</label>
                                            <textarea name="address" cols="30" disabled rows="4"
                                                class="form-control"
                                                placeholder="Enter Your Address">{{ old('address', $account->address) }}</textarea>

                                        </div>


                                    </div>


                            </form>

                        </div>


                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- END MAIN CONTENT-->
    <!-- END PAGE CONTAINER-->

@endsection
