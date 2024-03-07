@extends('user.layout.master')

@section('title', 'user edit info page')

@section('content')

    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">

                  {{-- Info change alert box --}}

                     @if (session('updateSuccess'))
                     <div class="col-7 offset-4 my-2">
                       <div class="alert alert-warning alert-dismissible fade show" role="alert">
                           <strong> <i class="fa-solid fa-check"></i> {{session('updateSuccess')}}</strong>
                           <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                             <span aria-hidden="true">&times;</span>
                           </button>
                         </div>
                      </div>
                     @endif

                <div class="col-lg-10 offset-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Profile Infomation</h3>
                            </div>
                            <hr>
                            <form action="{{ route('user#update', Auth::user()->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="image col-4 offset-1">
                                        <a href="#">
                                            @if (Auth::user()->image == null)
                                            @if (Auth::user()->gender == 'male')
                                            <img src="{{asset('image/defaultImage.jpg')}}" alt="" class="shadow-sm img-thumbnail">
                                            @else
                                            <img src="{{asset('image/female_default.png')}}" alt="" class="shadow-sm img-thumbnail">
                                            @endif
                                            @else
                                                <img src="{{ asset('storage/' . Auth::user()->image) }}" alt="John Doe"
                                                    class="shadow-sm img-thumbnail" />
                                            @endif
                                        </a>
                                        <div class="mt-3"><input type="file" name="image" id=""
                                                class="form-control p-0 @error('image')
                                            is-invalid
                                        @enderror">
                                            @error('image')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="row"> <button type="submit"
                                                class="btn btn-dark col-10 offset-1 mt-4"> <i
                                                    class="fa-solid fa-pen-to-square mr-2"></i> Update</button></div>
                                    </div>

                                    <div class="col-6">

                                        <div class="form-group">
                                            <label class="control-label mb-2">Name</label>
                                            <input name="name" type="text"
                                                class="form-control @error('name') is-invalid
                                        @enderror"
                                                aria-required="true" aria-invalid="false"
                                                value="{{ old('name', Auth::user()->name) }}"
                                                placeholder="Enter Your Name...">
                                            @error('name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label mb-2">Email</label>
                                            <input name="email" type="email"
                                                class="form-control @error('email') is-invalid

                                        @enderror"
                                                aria-required="true" aria-invalid="false"
                                                value="{{ old('email', Auth::user()->email) }}"
                                                placeholder="Enter Email...">
                                            @error('email')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label mb-2">Phone</label>
                                            <input name="phone" type="number"
                                                class="form-control @error('phone') is-invalid

                                        @enderror"
                                                aria-required="true" aria-invalid="false"
                                                value="{{ old('phone', Auth::user()->phone) }}"
                                                placeholder="Enter Phone...">
                                            @error('phone')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label mb-2">Gender</label>
                                            <select name="gender" id=""
                                                class="form-control @error('gender')
                                            is-invalid
                                            @enderror">
                                                <option value="">Choose Gender</option>
                                                <option value="male" @if (Auth::user()->gender == 'male') selected @endif()>
                                                    Male</option>
                                                <option value="female" @if (Auth::user()->gender == 'female') selected @endif>
                                                    Female</option>
                                            </select>
                                            @error('gender')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label mb-2">Address</label>
                                            <textarea name="address" cols="30" rows="4"
                                                class="form-control @error('address')
                                       is-invaid
                                       @enderror"
                                                placeholder="Enter Your Address">{{ old('address', Auth::user()->address) }}</textarea>
                                            @error('address')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label mb-2">Role : </label>
                                            <input type="text" name="role" id=""
                                                value="{{ old('role', Auth::user()->role) }}" class="form-control"
                                                disabled>
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
