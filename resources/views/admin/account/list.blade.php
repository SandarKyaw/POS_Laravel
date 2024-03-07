@extends('admin.layouts.master')

@section('title', 'admin list page')

@section('content')

    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">

                    {{-- Category alert box --}}

                    @if (session('deleteSuccess'))
                        <div class="col-4 offset-8 my-2">
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong> <i class="fa-solid fa-check"></i> {{ session('deleteSuccess') }}</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    @endif

                    {{-- search box --}}

                    <div class="row">

                        <div class="col-6">
                            <form action="{{route('account#listSearch')}}" method="get">
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
                                    <input type="text" name="searchKey" id="" class="col-7 form-control serachKey" value="{{request('searchKey')}}" placeholder="Search Something...">
                                    <div class="input-group-append">
                                        <button type="submit" class=" btn-sm btn-dark">Search</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="col-4 offset-2">
                            <h4 class="bg-white p-2 text-center text-secondary">Total : <span class="text-success"> {{$admin->total()}}</span>
                            </h4>
                        </div>


                    </div>

                    {{-- table data --}}

                    <div class="table-responsive table-responsive-data2 mt-2">
                        @if (count($admin) != 0)

                            <table class="table table-data2 text-center">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Gender</th>
                                        <th>Phone</th>
                                        <th>Address</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($admin as $a)
                                        <tr class="tr-shadow">

                                            <input type="hidden" value="{{ $a->id }}" id="userId">

                                            <td class="col-2">
                                                @if ($a->image == null)
                                                    @if ($a->gender == 'male')
                                                        <img src="{{ asset('image/defaultImage.jpg') }}" alt=""
                                                            class="img-thumbnail img-fluid">
                                                    @else
                                                        <img src="{{ asset('image/female_default.png') }}" alt=""
                                                            class="img-thumbnail img-fluid">
                                                    @endif
                                                @else
                                                    <img src="{{ asset('storage/' . $a->image) }}" alt=""
                                                        class="img-thumbnail img-fluid">
                                                @endif
                                            </td>
                                            <td>{{ $a->name }}</td>
                                            <td>{{ $a->email }}</td>
                                            <td>{{ $a->gender }}</td>
                                            <td>{{ $a->phone }}</td>
                                            <td>{{ $a->address }}</td>

                                            <td>
                                                <div class="table-data-feature">
                                                    @if (Auth::user()->id == $a->id)
                                                        <button class="item" data-toggle="tooltip" data-placement="top"
                                                            title="U can't delete urself">
                                                            <i class="fa-solid fa-exclamation"></i>
                                                        </button>
                                                    @else
                                                        {{-- <a href="{{route('account#changeRole',$a->id)}}" class="mr-2">
                                    <button class="item mr-2" data-toggle="tooltip" data-placement="top" title="Change Admin Role">
                                       <i class="fa-solid fa-pencil"></i>
                                    </button></a> --}}

                                                        <select name="" id=""
                                                            class="form-control roleChange mr-3">
                                                            <option value="user"
                                                                @if ($a->role == 'user') selected @endif>User
                                                            </option>
                                                            <option value="admin"
                                                                @if ($a->role == 'admin') selected @endif>Admin
                                                            </option>
                                                        </select>

                                                        <a href="{{ route('account#delete', $a->id) }}">
                                                            <button class="item" data-toggle="tooltip"
                                                                data-placement="top" title="Delete">
                                                                <i class="fa-solid fa-trash-can"></i>
                                                            </button></a>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                    </div>

                    <div class="mt-3">
                        {{ $admin->appends(request()->query())->links() }}
                    </div>
                @else
                    <div class="text-center text-danger mt-5">This data is not included in admin list...</div>
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
            $('.roleChange').change(function() {
                $currentRole = $(this).val();

                $parentNode = $(this).parents('tr');
                $userId = $parentNode.find('#userId').val();

                $.ajax({
                    type: 'get',
                    url: '/ajax/admin/roleChange',
                    data: {
                        'userId': $userId,
                        'currentRole': $currentRole
                    },
                    dataType: 'json',
                });
                location.reload();
            });

            // $('.custom-select').change(function(){
            //     $searchStatus = $(this).val();
            //     $searchKey = $(this).val();

            //       $.ajax({
            //         type: 'get',
            //         url: '/ajax/list/search',
            //         data: {
            //             'searchStatus': $searchStatus,
            //             'searchKey': $searchKey
            //         },
            //         dataType: 'json',
            //     });

            //     console.log($searchStatus);
            // })

        });
    </script>
@endsection
