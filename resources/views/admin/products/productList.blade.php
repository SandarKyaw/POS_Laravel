@extends('admin.layouts.master')

@section('title', 'product list page')

@section('content')

<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <div class="overview-wrap">
                            <h2 class="title-1">Products List</h2>

                        </div>
                    </div>
                    <div class="table-data__tool-right">
                        <a href="{{route('products#productCreatePage')}}">
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                <i class="zmdi zmdi-plus"></i>add product
                            </button>
                        </a>
                        <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                            CSV download
                        </button>
                    </div>
                </div>

                {{-- product alert box --}}

              @if (session('productSuccess'))
              <div class="col-5 offset-7">
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong> <i class="fa-solid fa-check"></i> {{session('productSuccess')}}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
               </div>
              @endif

              {{-- search box --}}

             <div class="row">
                <div class="col-3">
                    <h4 class="text-secondary bg-white p-2 text-center">Search Key : <span class="text-danger">{{request('searchKey')}}</span></h4>
                </div>

                <div class="col-3 offset-1"><h4 class="bg-white p-2 text-center text-secondary">Total : <span class="text-success"> {{$products->total()}} </span></h4></div>

                <div class="col-4 offset-1">
                    <form action="{{route('products#productListPage')}}" method="GET">
                        <div class="d-flex">
                            <input type="text" name="searchKey" id="" class="form-control" value="{{request('searchKey')}}" placeholder="Search...">
                            <button type="submit" class="btn btn-dark text-white"><i class="fa-solid fa-magnifying-glass"></i></button>
                        </div>
                    </form>
                  </div>
             </div>


        {{-- Products Data Table --}}
            <div class="table-responsive table-responsive-data2 mt-2">
                @if (count($products) != 0)

                <table class="table table-data2 text-center">
                    <thead>
                        <tr>
                            <th class="col-2">Image</th>
                            <th class="col-3">Name</th>
                            <th class="col-2">Price</th>
                            <th class="col-2">Category</th>
                            <th class="col-2">View Count</th>
                            <th class="col-2"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $p)

                        <tr class="tr-shadow">
                            <td><img src="{{asset('storage/'.$p->image)}}" class="img-thumbnail img-fluid w-100" style="height: 80px"></td>
                            <td>{{$p->name}}</td>
                            <td>{{$p->price}}</td>
                            <td>{{$p->category_name}}</td>
                            <td>{{$p->view_count}}</td>

                            <td>
                                <div class="table-data-feature">
                                    <a href="{{route('products#View',$p->id)}}" class="mr-2"><button class="item" data-toggle="tooltip" data-placement="top" title="View">
                                        <i class="fa-solid fa-eye fa-4x"></i>
                                    </button></a>

                                   <a href="{{route('products#UpdatePage',$p->id)}}" class="mr-2"> <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                </button></a>
                                    <a href="{{route('products#Delete',$p->id)}}">
                                        <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button></a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>

                <div class="mt-3">
                    {{$products->links()}}
                </div>
                @else
                <div class="text-secondary text-center mt-5"><h4>There is no Category Here..</h4></div>
                  @endif

                </div>
                <!-- END DATA TABLE -->

        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->
<!-- END PAGE CONTAINER-->

@endsection
