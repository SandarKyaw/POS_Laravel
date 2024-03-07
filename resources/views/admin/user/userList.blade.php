@extends('admin.layouts.master')

@section('title', 'user list page')

@section('content')

<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">

                {{-- //message alert box --}}
                 @if (session('message'))
                        <div class="col-4 offset-8 my-2">
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong> <i class="fa-solid fa-check"></i> {{ session('message') }}</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                </button>
                            </div>
                        </div>
                    @endif

                {{-- search box --}}

                    <div class="row">

                        <div class="col-6">
                            <form action="{{route('user#listSearch')}}" method="get">
                                @csrf
                                <div class="row input-group">
                                    <select name="status" class="col-3 custom-select" id="inputGroupSelect04">

                                        <option value="name" @if (request('status')=='name')
                                        selected
                                        @endif>Name</option>
                                        <option value="gender" @if (request('status')=='gender')
                                        selected
                                        @endif>Gender</option>
                                        <option value="email" @if (request('status')=='email')
                                        selected
                                        @endif>Email
                                        </option>
                                        <option value="address" @if (request('status')=='address')
                                        selected
                                        @endif>Address
                                        </option>
                                        <option value="phone" @if (request('status')=='phone')
                                        selected
                                        @endif>Phone
                                        </option>
                                    </select>
                                    <input type="text" name="searchKey" id="" class="col-7 form-control" value="{{request('searchKey')}}" placeholder="Search Something...">
                                    <div class="input-group-append">
                                        <button type="submit" class=" btn-sm btn-dark">Search</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="col-4 offset-2">
                            <h4 class="bg-white p-2 text-center text-secondary">Total : <span class="text-success">{{$users->total()}}</span>
                            </h4>
                        </div>

                    </div>

             <div class="table-responsive table-responsive-data2 mt-2">
                @if (count($users) != 0)

                <table class="table table-data2 text-center">
                  <thead>
                      <tr>
                          <th>Image</th>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Gender</th>
                          <th>Phone</th>
                          <th>Address</th>
                          <th>Role</th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach ($users as $u)
                      <tr class="tr-shadow">

                        <input type="hidden" id="userId" value="{{$u->id}}">

                        <td >@if ($u->image == null)
                           @if ($u->gender == 'male')
                           <img src="{{asset('image/defaultImage.jpg')}}" alt="" class="img-thumbnail img-shadow">
                           @else
                           <img src="{{asset('image/female_default.png')}}" alt="" class="img-thumbnail img-shadow">
                           @endif
                            @else
                            <img src="{{asset('storage/'.$u->image)}}" alt="" class="img-thumbnail img-shadow">
                        @endif</td>
                          <td >{{$u->name}}</td>
                          <td >{{$u->email}}</td>
                          <td >{{$u->gender}}</td>
                          <td >{{$u->phone}}</td>
                          <td >{{$u->address}}</td>
                          <td >
                            <select name="" class="form-control statusChange">
                                <option value="user"  @if ($u->role == 'user' )
                                    selected
                                @endif>User</option>
                                <option value="admin" @if ($u->role == 'admin' )
                                    selected
                                @endif>Admin</option>
                            </select>
                          </td>
                          <td>
                            <div class="table-data-feature">

                                    <a href="{{route('admin#userUpdate',$u->id)}}" class="mr-3">
                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button></a>

                                  <a href="{{route('admin#userDelete',$u->id)}}">
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
                  {{$users->appends(request()->query())->links()}}
              </div>
              @else
              <div class="text-center text-danger mt-5">This data is not included in user list...</div>
              @endif

              </div>
              <!-- END DATA TABLE -->

      </div>
  </div>
</div>
<!-- END MAIN CONTENT-->
<!-- END PAGE CONTAINER-->

@endsection

@section('scriptSource')
        <script>
            $(document).ready(function() {

                $('.statusChange').change(function() {

                    $currentStatus = $(this).val();

                    $parentNode = $(this).parents('tr');
                    $userId = $parentNode.find('#userId').val();

                    $data = {
                        'userId': $userId,
                        'role': $currentStatus
                    };

                    $.ajax({
                        type: 'get',
                        url: '/ajax/user/roleChange',
                        data: $data,
                        dataType: 'json',
                    });

                    location.reload();
                });
            });
        </script>
    @endsection

