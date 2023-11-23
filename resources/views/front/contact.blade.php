@extends('front.layouts.master')

@section('title','Contact')
@section('bg',asset('front/assets/img/contact-bg.jpg'))

@section('content')
    <!-- Main Content-->
    <article class="mb-4">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-8 col-xl-7">
                    @if(session('success'))
                    <div class="alert alert-success">{{session('success')}}</div>
                    @endif
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    <p>Want to get in touch? Fill out the form below to send me a message and I will get back to you as soon as possible!</p>
                    <div class="my-5">
                        <!-- * * * * * * * * * * * * * * *-->
                        <!-- * * SB Forms Contact Form * *-->
                        <!-- * * * * * * * * * * * * * * *-->
                        <!-- This form is pre-integrated with SB Forms.-->
                        <!-- To make this form functional, sign up at-->
                        <!-- https://startbootstrap.com/solution/contact-forms-->
                        <!-- to get an API token!-->
                        <form method="post" action="{{route('contact.post')}}" id="contactForm" data-sb-form-api-token="API_TOKEN">
                            @csrf
                            <div class="">
                                <label for="name">Name</label>
                                <input class="form-control" id="name" name="name" value="{{old('name')}}" type="text" placeholder="Enter your name..."  />
                                <div class="invalid-feedback" data-sb-feedback="name:required">A name is required.</div>
                            </div>
                            <div class="">
                                <label for="email">Email address</label>
                                <input class="form-control" id="email" name="email" value="{{old('email')}}" type="email" placeholder="Enter your email..."  />
                                <div class="invalid-feedback" data-sb-feedback="email:required">An email is required.</div>
                                <div class="invalid-feedback" data-sb-feedback="email:email">Email is not valid.</div>
                            </div>
                            <div class="">
                                <label for="topic">Topic</label>
                                <select class="form-control" name="topic" id="topic">
                                    <option @if(old('topic')=='information') selected="selected" @endif value="information">Information</option>
                                    <option @if(old('topic')=='request') selected="selected" @endif value="request">Request</option>
                                    <option @if(old('topic')=='general') selected="selected" @endif value="general">General</option>
                                </select>
                                <div class="invalid-feedback" data-sb-feedback="phone:required">A topic is required.</div>
                            </div>
                            <div class="">
                                <label for="message">Message</label>
                                <textarea class="form-control" name="message"  id="message" placeholder="Enter your message here..." style="height: 12rem" >
                                    {{old('message')}}
                                </textarea>
                                <div class="invalid-feedback" data-sb-feedback="message:required">A message is required.</div>
                            </div>
                            <br />
                            <!-- Submit success message-->
                            <!---->
                            <!-- This is what your users will see when the form-->
                            <!-- has successfully submitted-->
                            <div class="d-none" id="submitSuccessMessage">
                                <div class="text-center mb-3">
                                    <div class="fw-bolder">Form submission successful!</div>
                                    To activate this form, sign up at
                                    <br />
                                    <a href="https://startbootstrap.com/solution/contact-forms">https://startbootstrap.com/solution/contact-forms</a>
                                </div>
                            </div>
                            <!-- Submit error message-->
                            <!---->
                            <!-- This is what your users will see when there is-->
                            <!-- an error submitting the form-->
                            <div class="d-none" id="submitErrorMessage"><div class="text-center text-danger mb-3">Error sending message!</div></div>
                            <!-- Submit Button-->
                            <button class="btn btn-primary text-uppercase" id="submitButton" type="submit">Send</button>
                        </form>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card-group">
                        <div class="card card-default">
                            <div class="card-body">Contact</div>
                            Adress: Lorem ipsum dolor sit amet.
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </article>

@endsection
