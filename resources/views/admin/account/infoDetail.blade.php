@extends('admin.layouts.master')

@section('title', 'info detail page')

@section('content')

    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">

                <div class="col-lg-10 offset-1">

                    <div class="row">
                            @if (session('updateSuccess'))
                                <div class="col-7 offset-5">
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <strong> <i class="fa-solid fa-check"></i> {{ session('updateSuccess') }}</strong>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                </div>
                            @endif
                    </div>

                    <div class="card">

                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Profile Infomation</h3>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-4 offset-1">
                                    <div class="image">
                                        <a href="#">
                                            @if (Auth::user()->image == null)
                                            @if (Auth::user()->gender == 'male')
                                            <img src="{{asset('image/defaultImage.jpg')}}" alt="" class="shadow-sm img-thumbnail">
                                            @else
                                            <img src="{{asset('image/female_default.png')}}" alt="" class="shadow-sm img-thumbnail">
                                            @endif
                                            @else
                                                <img src="{{ asset('storage/'.Auth::user()->image) }}" alt=""
                                                    class="shadow-sm img-thumbnail" />
                                            @endif
                                        </a>
                                    </div>
                                </div>
                                <div class="col-5">
                                    <h4 class="my-3"> <i class="fa-solid fa-user "></i> <span
                                            class="ml-2">{{ Auth::user()->name }}</span></h4>
                                    <h4 class="my-3"> <i class="fa-solid fa-envelope "></i> <span
                                            class="ml-2">{{ Auth::user()->email }} </span></h4>
                                    <h4 class="my-3"> <i class="fa-solid fa-phone "></i> <span
                                            class="ml-2">{{ Auth::user()->phone }}</span></h4>
                                    <h4 class="my-3"> <i class="fa-solid fa-venus-mars"></i> <span
                                            class="ml-2">{{ Auth::user()->gender }}</span></h4>
                                    <h4 class="my-3"> <i class="fa-solid fa-location-dot "></i> <span
                                            class="ml-2">{{ Auth::user()->address }}</span></h4>
                                    <h4 class="my-3"> <i class="fa-solid fa-user-clock"></i> <span
                                            class="ml-2">{{ Auth::user()->created_at->format('j-F-Y') }}</span></h4>
                                    <a href="{{ route('account#editPage') }}" class="my-3"> <button class="btn btn-dark"
                                            type="submit"> <i class="fa-solid fa-user-pen mr-2"></i> Edit
                                            Profile</button></a>

                                </div>
                            </div>

                            {{-- <div class="row my-3 ">
                                <div class="col-4 offset-1"></div>
                              </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
    <!-- END PAGE CONTAINER-->

@endsection
