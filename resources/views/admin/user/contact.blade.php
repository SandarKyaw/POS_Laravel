@extends('admin.layouts.master')

@section('content')

    <!-- MAIN CONTENT-->
    <div class="main-content">

        <div class="container-fluid">
            <div class="col-md-10 offset-1">
                <!-- DATA TABLE -->
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <div class="row overview-wrap">
                            <h2 class="title-1">Message List</h2>

                        </div>

                    </div>
                     <div class="table-data__tool-right">
                         <h4 class="title-2 text-danger" >{{count($unreadMessage)}} - Unread Messages</h4>
                     </div>

                </div>

                <div class="row" id="messageList">
                    @if (count($contactData) != 0)
                        @foreach ($contactData as $d)
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="product-item mb-4">
                                    <div class="mbox  bg-light" style="width:100%; height:300px">
                                        <div class="d-flex flex-row-reverse">

                                            <div class="product-action px-1">
                                                <input type="hidden" name="contactId" id="contactId"
                                                    value="{{ $d->id }}">
                                                {{-- Mark as Read Button --}}
                                                <button
                                                    class="btn btn-outline-dark btn-square position-relative mr-3 mt-2 readBtn"
                                                    title="Mark as read"><i class="fa-solid fa-envelope-circle-check"></i>
                                                    <span
                                                        class="position-absolute top-0 start-100 translate-middle badge rounded-pill p-0 mt-1 @if ($d->status == 1) d-none
                                                        @endif " >
                                                        <i class="fa-solid fa-circle text-danger redDot"></i>
                                                    </span>
                                                </button>

                                                <button class="btn btn-outline-dark btn-square mr-1 mt-2 deleteBtn"
                                                    name="messageDelete" title="delete"><i
                                                        class="fa-solid fa-trash"></i></button>
                                            </div>

                                        </div>
                                        <div class="pl-4 py-4">
                                            <h4>Name: <span class="text-primary"> {{ $d->name }}</span></h4>
                                            <h4 class="mt-1">Email : <span class="text-primary">{{ $d->email }}</span>
                                            </h4>
                                            <div class="mt-2">
                                                <p>{{ $d->message }}</p>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="noDataBox text-center text-danger mt-5 p-auto">

                               There is no message now..
                            </div>
                        </div>
                    @endif


                </div>
                <div class="">
                    {{ $contactData->links() }}
                </div>

                <!-- END DATA TABLE -->

            </div>
        </div>

    </div>

@endsection

@section('scriptSource')
    <script>
        $(document).ready(function() {

            $('.deleteBtn').click(function() {

                $parentNode = $(this).parents('.product-item');
                $contactId = $parentNode.find('#contactId').val();
                $parentNode.find('.mbox').remove();
                console.log($contactId);

                $.ajax({
                    type: 'get',
                    url: '/ajax/message/delete',
                    data: {
                        'contactId': $contactId
                    },
                    dataType: 'json',

                })
                window.location.href = "http://127.0.0.1:8000/contactList";
            });

            //message mark as read btn
            $('.readBtn').click(function() {

                $parentNode = $(this).parents('.product-item');
                $contactId = $parentNode.find('#contactId').val();

                $redDot = $(this).find('.redDot').remove();
                $data = {'status' : 1,
                         'contactId' : $contactId} ;
                //   $greenDot = `
                // <i class="fa-solid fa-circle text-success" ></i>
                // `;
                // $greenDot = $(this).find('.redDot').css('color','green');
                //   $redDot.html($greenDot);

                $.ajax({
                    type: 'get',
                    url: '/ajax/message/read',
                    data: $data,
                    dataType: 'json',
                //     success: function(response) {

                // }
            });
            location.reload();
            console.log($data);
        })
    })
    </script>
@endsection
