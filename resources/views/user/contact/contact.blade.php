@extends('user.layout.master')

@section('content')
    <!-- Contact Start -->
    <div class="container-fluid">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Contact
                Us</span></h2>
        <div class="row px-xl-5">
            <div class="col-lg-7 mb-5">
                <div class="contact-form bg-light p-30">
                    <div id="success">
                           {{-- contact alert box --}}

              @if (session('success'))
              <div class="col-7 offset-5">
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong> <i class="fa-solid fa-check"></i> {{session('success')}}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
               </div>
              @endif
                    </div>

                    <form action="{{route('user#contactSend')}}" method="post" name="sentMessage" novalidate="novalidate">
                        @csrf
                        <div class="control-group mb-2">
                            <input type="text" class="form-control @error ('name') is-invalid

                            @endif" name="name" value="{{old('name')}}" placeholder="Your Name">
                             @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror

                        </div>
                        <div class="control-group mb-2">
                            <input type="email" class="form-control @error('email') is-invalid

                            @enderror" name="email" placeholder="Your Email" value="{{old('email')}}">
                             @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                        </div>

                        <div class="control-group mb-2">
                            <textarea class="form-control @error('message') is-invalid

                            @enderror" rows="8" name="message" placeholder="Message">{{old('message')}}</textarea>
                             @error('message')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                        </div>
                        <div>
                            <button class="btn btn-dark py-2 px-4" type="submit" id="sendMessageButton">Send
                                Message</button>
                        </div>
                    </form>

                </div>
            </div>
            <div class="col-lg-5 mb-5">
                <div class="bg-light p-30 mb-5">
                    <h3>Direct SDK Shop Location</h3>
                        <iframe style="width: 100%; height: 250px;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d488799.48078774964!2d95.59056818983017!3d16.83895506438647!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30c1949e223e196b%3A0x56fbd271f8080bb4!2z4YCb4YCU4YC64YCA4YCv4YCU4YC6!5e0!3m2!1smy!2smm!4v1706185651576!5m2!1smy!2smm" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                <div class="bg-light p-30 mb-3">
                    <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>123 Street, Yangon, Myanmar</p>
                    <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>dars7703@gmail.com</p>
                    <p class="mb-2"><i class="fa fa-phone-alt text-primary mr-3"></i>+095 980 624 170</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->
@endsection
