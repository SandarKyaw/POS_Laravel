@extends('admin.layouts.master')

@section('title', 'user update page')

@section('content')

    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">

                <div class="col-lg-11 offset-1">
                    <div class="row">
                        <div class="col-2">
                            <a href="{{ route('user#list') }}"> <button
                                    class="btn bg-dark text-white my-3">Back</button></a>
                        </div>

                        <div class="col-3 offset-7">
                            <a href="{{ route('user#list') }}"><button
                                    class="btn bg-dark text-white my-3">User
                                    List</button></a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-10 offset-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2 text-danger">User : {{ $data->name }}</h3>
                            </div>
                            <hr>

                            <form action="{{ route('admin#userUpdateBtn') }}" method="post" novalidate="novalidate"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="row">
                                    <div class="col-4 offset-1">
                                        <input type="hidden" value="{{ $data->id }}" name="id"
                                            class="form-control">

                                        <div class="form-group ">
                                            <img src="@if ($data->image == null) @if ($data->gender == 'male')
                                            {{ asset('image/defaultImage.jpg') }}
                                            @else
                                            {{ asset('image/female_default.png') }} @endif
@else
{{ asset('storage/' . $data->image) }}
                                            @endif"
                                                class="shadow-sm img-fluid img-thumbnail">

                                            <input type="file" name="userImage"
                                                class="form-control p-0 @error('userImage') is-invalid
                                            @enderror "
                                                id="">
                                            @error('userImage')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="mt-3">
                                            <button id="payment-button" type="submit" class="btn bg-dark text-white w-100">

                                                <span id="payment-button-amount">Update</span>
                                                <i class="fa-solid fa-circle-right"></i>
                                            </button>
                                        </div>

                                    </div>
                                    <div class="col-6 offset-1">
                                        <div class="form-group">
                                            <label class="control-label mb-1">Name</label>
                                            <input type="text"
                                                class="form-control @error('name') is-invalid
                                            @enderror "
                                                value="{{ old('name', $data->name) }}" name="name">

                                            @error('name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror

                                        </div>

                                        <div class="form-group">
                                            <label class="control-label mb-1">Email</label>
                                            <input type="text" name="email" class="form-control @error('email') is-invalid
                                            @enderror"
                                                value="{{ old('email', $data->email) }}">
                                            @error('email')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label mb-1">Phone</label>
                                            <input
                                                class="form-control @error('phone') is-invalid
                                            @enderror "
                                                type="number" name="phone" value="{{ old('phone', $data->phone) }}"
                                                placeholder="09xxxxxx">
                                            @error('phone')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label mb-1">Address</label>
                                            <textarea class="form-control @error('address') is-invalid
                                            @enderror "
                                                name="address" id="" cols="30" rows="10">{{ old('address', $data->address) }}</textarea>
                                            @error('address')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label>Created Date</label>
                                            <input name="createdDate" class="form-control"
                                                value="{{ $data->created_at->format('j-F-Y') }}" disabled>
                                        </div>

                                    </div>

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
