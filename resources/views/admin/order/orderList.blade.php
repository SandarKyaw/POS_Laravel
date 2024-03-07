@extends('admin.layouts.master')

@section('title', 'order list page')

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
                                <h2 class="title-1">Order List</h2>

                            </div>
                        </div>

                    </div>

                    {{-- product alert box --}}

                    @if (session('productSuccess'))
                        <div class="col-5 offset-7">
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong> <i class="fa-solid fa-check"></i> {{ session('productSuccess') }}</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    @endif

                    {{-- search box --}}

                    <div class="row">

                        <div class="col-6">
                            <form action="{{ route('order#orderStatusSearch') }}" method="GET">
                                @csrf
                                <div class="input-group">
                                    <select name="status" id="orderStatus" class="custom-select" id="inputGroupSelect04">
                                        <option value="">All</option>
                                        <option value="0" @if (request('status') == '0') selected @endif>Pending
                                        </option>
                                        <option value="1" @if (request('status') == '1') selected @endif>Success
                                        </option>
                                        <option value="2" @if (request('status') == '2') selected @endif>Reject
                                        </option>
                                    </select>
                                    <div class="input-group-append">
                                        <button type="submit" class="btn-sm btn-dark">Search</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="col-4 offset-2">
                            <h4 class="bg-white p-2 text-center text-secondary">Total : <span
                                    class="text-success">{{ count($order) }}</span></h4>
                        </div>


                    </div>


                    {{-- Products Data Table --}}
                    <div class="table-responsive table-responsive-data2 mt-2">
                        {{-- @if (count($order) != 0) --}}

                        <table class="table table-data2 text-center">
                            <thead>
                                <tr>
                                    <th class="col-2">User Id</th>
                                    <th class="col-3">User Name</th>
                                    <th class="col-2">Date</th>
                                    <th class="col-2">Order Code</th>
                                    <th class="col-2">Amount</th>
                                    <th class="col-2">Status</th>
                                </tr>
                            </thead>
                            <tbody id="orderList">
                                @foreach ($order as $o)
                                    <tr class="tr-shadow">
                                        <input type="hidden" class="orderId" value="{{ $o->id }}">
                                        <td>{{ $o->user_id }}</td>
                                        <td>{{ $o->user_name }}</td>
                                        <td>{{ $o->created_at->format('j-F-Y') }}</td>
                                        <td>
                                            <a href="{{route('order#codeInfo',$o->order_code)}}">{{ $o->order_code }}</a>
                                        </td>
                                        <td>{{ $o->total_price }} Ks</td>
                                        <td>
                                            <select name="status" class="statusChange">
                                                <option value="0" @if ($o->status == 0) selected @endif>
                                                    Pending</option>
                                                <option value="1" @if ($o->status == 1) selected @endif>
                                                    Success</option>
                                                <option value="2" @if ($o->status == 2) selected @endif>
                                                    Reject</option>
                                            </select>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>

                    {{-- <div class="mt-3">
                        {{ $order->links() }}
                    </div> --}}


                    <!-- END DATA TABLE -->

                </div>
            </div>
        </div>
    </div>
        <!-- END MAIN CONTENT-->
        <!-- END PAGE CONTAINER-->

    @endsection

    @section('scriptSource')
        <script>
            $(document).ready(function() {
                // $('#orderStatus').change(function() {
                //     $status = $('#orderStatus').val();
                //     // if($status == 0)
                //     $.ajax({
                //         type: 'get',
                //         url: 'http://127.0.0.1:8000/ajax/order/status',
                //         data: {
                //             'status': $status,
                //         },
                //         dataType: 'json',
                //         success: function(response) {
                //             //  console.log($status);
                //             //  console.log(response);

                //             $list = '';
                //             for ($i = 0; $i < response.length; $i++) {
                //                 $months = ['Janurary', 'Feburary', 'March', 'April', 'May', 'June',
                //                     'July', 'August', 'September', 'October', 'November',
                //                     'December'
                //                 ];
                //                 $dbDate = new Date(response[$i].created_at);
                //                 $finalDate = $months[$dbDate.getMonth()] + '-' + $dbDate.getDate() +
                //                     '-' + $dbDate.getFullYear();

                //                 if (response[$i].status == 0) {
                //                     $statusMessage = `
        //                          <select name="status" class="statusChange">
        //                                 <option value="0" selected>
        //                                     Pending</option>
        //                                 <option value="1" >
        //                                     Success</option>
        //                                 <option value="2" >
        //                                     Reject</option>
        //                             </select>
        //                          `;
                //                 } else if (response[$i].status == 1) {
                //                     $statusMessage = `
        //                          <select name="status" class="statusChange">
        //                                 <option value="0" >
        //                                     Pending</option>
        //                                 <option value="1" selected>
        //                                     Success</option>
        //                                 <option value="2" >
        //                                     Reject</option>
        //                             </select>
        //                          `;
                //                 } else if (response[$i].status == 2) {
                //                     $statusMessage = `
        //                          <select name="status" class="statusChange">
        //                                 <option value="0" >
        //                                     Pending</option>
        //                                 <option value="1" >
        //                                     Success</option>
        //                                 <option value="2" selected>
        //                                     Reject</option>
        //                             </select>
        //                          `;
                //                 }



                //                 $list += `
        //                   <tr class="tr-shadow" >
        //                         <td>${response[$i].user_id}</td>
        //                         <td>${response[$i].user_name}</td>
        //                         <td>${$finalDate}</td>
        //                         <td>${response[$i].order_code}</td>
        //                         <td>${response[$i].total_price} Ks</td>
        //                         <td>
        //                             ${$statusMessage}
        //                         </td>
        //                     </tr>
        //                 `;

                //                 //  console.log($statusMessage.find('#statusChange'));
                //             }
                //             //  console.log($list);
                //             $('#orderList').html($list);
                //         }
                //     })

                // })

                $('.statusChange').change(function() {

                    $currentStatus = $(this).val();
                    $parentNode = $(this).parents('tr');
                    $orderId = $parentNode.find('.orderId').val();

                    $data = {
                        'status': $currentStatus,
                        'orderId': $orderId
                    };

                    $.ajax({
                        type: 'get',
                        url: 'http://127.0.0.1:8000/ajax/order/statusChange',
                        data: $data,
                        dataType: 'json',
                    });
                });
            });
        </script>
    @endsection
