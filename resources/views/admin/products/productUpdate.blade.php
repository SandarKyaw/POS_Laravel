@extends('admin.layouts.master')

@section('title', 'product update page')

@section('content')

    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-3 offset-1">
                       <a href="{{route('products#productListPage')}}"> <button class="btn bg-dark text-white my-3">Cancel</button></a>
                    </div>

                    <div class="col-3 offset-5">
                        <a href="{{ route('products#productListPage') }}"><button class="btn bg-dark text-white my-3">Products
                                List</button></a>
                    </div>
                </div>
                <div class="col-lg-10 offset-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2 text-danger">Edit Your Product</h3>
                            </div>
                            <hr>
                            <form action="{{route('products#Update')}}" method="post" novalidate="novalidate"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="row">
                                    <div class="col-4 offset-1">
                                        <input type="hidden" value="{{$products->id}}" name="id" class="form-control">

                                        <div class="form-group ">
                                            <img src="{{asset('storage/'.$products->image)}}" class="shadow-sm img-fluid img-thumbnail">
                                            <input type="file" name="productImage"
                                                class="form-control p-0 @error('productImage') is-invalid
                                            @enderror "
                                                id="">
                                            @error('productImage')
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
                                        <input name="productName" type="text"
                                            class="form-control @error('productName') is-invalid

                                    @enderror"
                                            aria-required="true" aria-invalid="false" value="{{ old('productName',$products->name) }}"
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
                                                <option value="{{ $c->id }}" @if ($products->category_id ==  $c->id )
                                                    selected
                                                @endif>{{ $c->name }}</option>
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
                                            aria-required="true" aria-invalid="false"
                                            placeholder="Enter Your Description..." cols="30" rows="3">{{old('productDescription',$products->description)}}</textarea>
                                        @error('productDescription')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>


                                <div class="form-group">
                                    <label class="control-label mb-1">Waiting Time</label>
                                    <input type="number" name="waitingTime"
                                        class="form-control @error('waitingTime') is-invalid

                                    @enderror" value="{{ old('waitingTime',$products->waiting_time) }}"
                                        placeholder="Enter waiting time">
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

                                    @enderror"
                                        placeholder="Enter price" value="{{ old('productPrice',$products->price) }}">
                                    @error('productPrice')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label >View Count</label>
                                    <input name="viewCount" class="form-control" value="{{$products->view_count}}" disabled>
                                </div>

                                <div class="form-group">
                                    <label >Created Date</label>
                                    <input name="createdDate" class="form-control" value="{{$products->created_at->format('j-F-Y')}}" disabled>
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
