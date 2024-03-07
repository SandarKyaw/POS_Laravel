@extends('admin.layouts.master')

@section('title', 'product view page')

@section('content')

    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-3 offset-1">
                        <button class="btn bg-dark text-white my-3" onclick="history.back()"><i class="fa-solid fa-caret-left mr-2"></i>back</button>
                    </div>

                    <div class="col-3 offset-5">
                        <a href="{{ route('products#productListPage') }}"><button class="btn bg-dark text-white my-3">Products List</button></a>
                    </div>
                </div>
                <div class="col-lg-10 offset-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2 text-danger">{{ $products->name }} Details</h3>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-4 offset-1">
                                    <div class="image">
                                        <a href="#">
                                            <img src="{{ asset('storage/' . $products->image) }}"
                                                class="shadow-sm img-fluid img-thumbnail">
                                        </a>
                                    </div>
                                    <div class="my-3">
                                        <h4 class="d-inline"> <i class="fa-solid fa-money-bill-1-wave mr-2"></i> {{ $products->price }} Ks</h4>
                                    </div>
                                    <div class="">
                                        <h4 class="d-inline mr-2"> <i class="fa-solid fa-clock mr-2"></i>{{ $products->waiting_time }} mins</h4>
                                        <h4 class="d-inline"> <i class="fa-solid fa-eye mr-2"></i>{{ $products->view_count }}</h4>
                                    </div>
                                    </div>

                                <div class="col-6 offset-1">

                                     <h4 class="d-inline mr-2"> <i class="fa-regular fa-note-sticky mr-2"></i> {{$products->category_name}}</h4>

                                    <h4 class="my-3"> <i class="fa-solid fa-user-clock"></i>
                                        <span class="ml-2">{{ $products->created_at->format('j-F-Y') }}</span>
                                    </h4>

                                    <h4 class="my-3"> <i class="fa-solid fa-rectangle-list"></i> <span
                                            class="ml-2">Description</span></h4>
                                    <div class="text-muted">
                                        {{ $products->description }}
                                    </div>

                                </div>
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
