@extends('admin.layouts.master')

@section('title', 'pizza create page')

@section('content')

    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-3 offset-7">
                        <a href="{{ route('products#productListPage') }}"><button class="btn bg-dark text-white my-3">Products
                                List</button></a>
                    </div>
                </div>
                <div class="col-lg-6 offset-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Products Form</h3>
                            </div>
                            <hr>
                            <form action="{{ route('products#productCreate') }}" method="post" novalidate="novalidate"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label class="control-label mb-1">Name</label>
                                    <input name="productName" type="text"
                                        class="form-control @error('productName') is-invalid

                                @enderror"
                                        aria-required="true" aria-invalid="false" value="{{ old('productName') }}"
                                        placeholder="Enter Product Name...">
                                    @error('productName')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="control-label mb-1">Category</label>
                                    <select name="productCategory" id=""
                                        class="form-control  @error('productCategory') is-invalid

                                    @enderror">
                                        <option value="">Choose your Category</option>
                                        @foreach ($categories as $c)
                                            <option value="{{ $c->id }}">{{ $c->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('productCategory')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="control-label mb-1">Description</label>
                                    <textarea name="productDescription" type="text"
                                        class="form-control @error('productDescription') is-invalid

                            @enderror"
                                        aria-required="true" aria-invalid="false" value="{{ old('productDescription') }}"
                                        placeholder="Enter Your Description..." cols="30" rows="3"></textarea>
                                    @error('productDescription')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="control-label mb-1">Image</label>
                                    <input type="file" name="productImage"
                                        class="form-control p-0 @error('productImage') is-invalid
                                    @enderror"
                                        id="">
                                    @error('productImage')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="control-label mb-1">Waiting Time</label>
                                    <input type="number" name="waitingTime"
                                        class="form-control @error('waitingTime') is-invalid

                                    @enderror"
                                        placeholder="Enter waiting time" value="old('waitingTime')">
                                    @error('waitingTime')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="control-label mb-1">Price</label>
                                    <input type="number" name="productPrice"
                                        class="form-control @error('productPrice') is-invalid

                                    @enderror" value="old('productPrice')"
                                        placeholder="Enter price">
                                    @error('productPrice')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div>
                                    <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block ">

                                        <span id="payment-button-amount">Create</span>
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
