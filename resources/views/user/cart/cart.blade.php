@extends('user.layout.master')

@section('content')

    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0" id="dataTable">
                    <thead class="thead-dark">
                        <tr>
                            <th></th>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                       @foreach ($cartList as $c)
                        <tr>
                            <input type="hidden" value="{{$c->id}}" class="orderId">
                            <input type="hidden" value="{{$c->user_id}}" class="userId" >
                            <input type="hidden" value="{{$c->product_id}}" class="productId" >
                            <input type="hidden" name=""  id="price" value="{{$c->price}}">
                            <td><img src="{{asset('storage/'.$c->image)}}" class="img-thumbnail shadow-sm" alt="" style="width: 100px;"></td>
                            <td class="align-middle"> {{$c->name}}</td>
                            <td class="align-middle">{{$c->price}} Ks</td>
                            <td class="align-middle">
                                <div class="input-group quantity mx-auto" style="width: 100px;">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-primary btn-minus" >
                                        <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    <input type="text" class="form-control form-control-sm border-0 text-center" id="qty" value="{{$c->qty}}">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-primary btn-plus">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </td>
                            <td class="align-middle col-2" id="total">{{$c->price*$c->qty}} Ks</td>
                            <td class="align-middle"><button class="btn btn-sm btn-danger btnRemove"><i class="fa fa-times"></i></button></td>
                        </tr>
                       @endforeach

                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart Summary</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <h6 id="subTotalPrice">{{$totalPrice}} Ks</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Delivery</h6>
                            <h6 class="font-weight-medium">3000 Ks</h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5 id="finalTotal">{{$totalPrice + 3000}}</h5>
                        </div>
                        <button class="btn btn-block btn-primary font-weight-bold my-3 py-3" id="orderBtn">Proceed To Checkout</button>
                        <button class="btn btn-block btn-danger font-weight-bold my-3 py-3" id="clearBtn">Clear Cart</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->
@endsection

@section('scriptSource')
<script>
    $(document).ready(function(){
        //plus btn click
        $('.btn-plus').click(function(){
            $parentNode = $(this).parents("tbody tr");
            $price = $parentNode.find('#price').val();
              $qty = Number($parentNode.find('#qty').val());

              $total = $price*$qty;

              $parentNode.find('#total').html($total + " Ks");
              summaryCalculation();
            // console.log($qty);

        })
        //minus btn click
         $('.btn-minus').click(function(){
             $parentNode = $(this).parents("tbody tr");
            $price = $parentNode.find('#price').val();
              $qty = Number($parentNode.find('#qty').val());

              $total = $price*$qty;

              $parentNode.find('#total').html($total + " Ks");
              summaryCalculation();

        })
        //cross btn click
        $('.btnRemove').click(function(){
              $parentNode = $(this).parents("tr");
              $productId = $('.productId').val();
              $orderId = $('.orderId').val();
              $parentNode.remove();
              summaryCalculation();

               $.ajax({
                        type: 'get',
                        url: 'http://127.0.0.1:8000/user/ajax/currentProduct/clear',
                        data: {'productId': $productId, 'orderId': $orderId},
                        dataType: 'json',

                      })

        })

        function summaryCalculation(){
                 //plus & minus btn click total price change
            $totalPrice = 0;
            $('#dataTable tr').each(function(index,row){
                $totalPrice += Number($(row).find('#total').text().replace(' Ks',''));
            });

            $('#subTotalPrice').html(`${$totalPrice} Ks`);
            $('#finalTotal').html(`${$totalPrice+3000} Ks`);
        }

        //btn order process
        $('#orderBtn').click(function(){
            // console.log('order..')
            $random = Math.floor(Math.random()*1000001);
            // console.log($random);
            $orderList = [];
            $('#dataTable tbody tr').each(function(index,row){
                $orderList.push({
                    'userId' : $(row).find('.userId').val(),
                    'productId' : $(row).find('.productId').val(),
                    'qty' : $(row).find('#qty').val(),
                    'total' : $(row).find('#total').text().replace(' Ks','')*1,
                    'orderCode' : 'POS'+ $random,
                });
            })

            // console.log($orderList);

              $.ajax({
                        type: 'get',
                        url: 'http://127.0.0.1:8000/user/ajax/order/list',
                        data: Object.assign({}, $orderList),
                        dataType: 'json',
                        success: function(response) {

                            if(response.status == 'true'){
                                 window.location.href = "http://127.0.0.1:8000/user/home";
                            }
                            }
                            // console.log($list);

                      })
        })

        //clear button click
        $('#clearBtn').click(function(){
           $('#dataTable tbody tr').remove();
           $('#subTotalPrice').html('0 Ks');
           $('#finalTotal').html('3000 Ks');

            $.ajax({
                        type: 'get',
                        url: 'http://127.0.0.1:8000/user/ajax/cart/clear',
                        dataType: 'json',

                      })
        })

    })
</script>
@endsection



