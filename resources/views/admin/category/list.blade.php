@extends('admin.layouts.master')

@section('title', 'category list page')

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
                            <h2 class="title-1">Category List</h2>

                        </div>
                    </div>
                    <div class="table-data__tool-right">
                        <a href="{{route('category#createPage')}}">
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                <i class="zmdi zmdi-plus"></i>add category
                            </button>
                        </a>
                        <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                            CSV download
                        </button>
                    </div>
                </div>

                {{-- Category alert box --}}

              @if (session('categorySuccess'))
              <div class="col-4 offset-8">
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong> <i class="fa-solid fa-check"></i> {{session('categorySuccess')}}</strong>
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

                <div class="col-3 offset-1"><h4 class="bg-white p-2 text-center text-secondary">Total : <span class="text-success">  {{$categories->total()}} </span></h4></div>

                <div class="col-4 offset-1">
                    <form action="{{route('category#listPage')}}" method="GET">
                        <div class="d-flex">
                            <input type="text" name="searchKey" id="" class="form-control" value="{{request('searchKey')}}" placeholder="Search...">
                            <button type="submit" class="btn btn-dark text-white"><i class="fa-solid fa-magnifying-glass"></i></button>
                        </div>
                    </form>
                  </div>
             </div>



                <div class="table-responsive table-responsive-data2">
                  @if (count($categories) != 0)
                  <table class="table table-data2 text-center">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Category Name</th>
                            <th>Created Date</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category_item)
                        <tr class="tr-shadow">
                            <td>{{$category_item->id}}</td>
                            <td class="col-6">{{$category_item->name}}</td>
                            <td>{{$category_item->created_at->format('j-F-Y')}}</td>

                            <td>
                                <div class="table-data-feature">
                                    {{-- <button class="item" data-toggle="tooltip" data-placement="top" title="View">
                                        <i class="fa-solid fa-eye fa-4x"></i>
                                    </button> --}}
                                   <a href="{{route('category#editPage',$category_item->id)}}" class="mr-2"> <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                </button></a>
                                    <a href="{{route('category#delete',$category_item->id)}}">
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
                    {{$categories->appends(request()->query())->links()}}
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
