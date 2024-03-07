@extends('admin.layouts.master')

@section('title', 'product list page')

@section('content')

<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <a href="{{route('order#orderListPage')}}" class="mr-2 mb-2"><button class="btn btn-dark"><i class="fa-solid fa-caret-left mr-2"></i>Back</button></a>
                <!-- DATA TABLE -->

                    <div class="row col-10 mt-2">
                        <div class="card col-7">
                            <div class="card-title mt-3 ">
                                <h3 class="ml-3"><i class="fa-solid fa-clipboard mr-2"></i>Code Info</h3>
                                <small class="text-warning ml-3"><i class="fa-solid fa-triangle-exclamation mr-2"></i>Include Delivery Fees</small>
                            </div>
                            <div class="card-body">
                                <div class="row mb-2">
                                    <div class="col"><i class="fa-solid fa-user mr-1"></i>User Name :</div>
                                    <div class="col">{{$orderList[0]->username}}</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col"><i class="fa-solid fa-barcode mr-1"></i>Order Code :</div>
                                    <div class="col">{{$orderList[0]->order_code}}</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col"><i class="fa-solid fa-clock mr-1"></i>Order Date :</div>
                                    <div class="col">{{$orderList[0]->created_at->format('j-F-Y')}}</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col"><i class="fa-solid fa-money-bill-1-wave mr-1"></i>Total Price :</div>
                                    <div class="col">{{$orderPrice->total_price}} Ks</div>
                                </div>
                            </div>
                        </div>
                    </div>



        {{-- Products Data Table --}}
            <div class="table-responsive table-responsive-data2 mt-2">
                {{-- @if (count($products) != 0) --}}

                <table class="table table-data2 text-center">
                    <thead>
                        <tr>
                            <th></th>
                            <th >User ID</th>
                            <th >Product Image</th>
                            <th >Product Name</th>
                            <th >Qty</th>
                            <th >Amount</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orderList as $ol)

                        <tr class="tr-shadow">
                           <td ></td>
                           <td >{{$ol->user_id}}</td>

                           <td >{{$ol->pname}}</td>
                           <td ><img src="{{asset('storage/'.$ol->pimage)}}" alt="productImage" class="img-thumbnail shadow-sm" style="height: 80px"></td>

                            <td >{{$ol->qty}}</td>
                             <td >{{$ol->total}} Ks</td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
{{--
                <div class="mt-3">
                    {{$products->links()}}
                </div>
                @else
                <div class="text-secondary text-center mt-5"><h4>There is no Category Here..</h4></div>
                  @endif --}}

                </div>
                <!-- END DATA TABLE -->

        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->
<!-- END PAGE CONTAINER-->

@endsection
