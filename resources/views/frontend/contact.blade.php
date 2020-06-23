@extends('layouts.app')

@section('content')
<div class="container">
    <section id="contact" class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-5 mb-3">
                    <div class="card p-3">
                        <div class="card-body">
                            <h4>Get In Touch</h4>
                            <p class="lead">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                            <h4>Address</h4>
                            <p class="lead">New Market, Jessore</p>
                            <h4>Email</h4>
                            <p class="lead">injam.cse@gmail.com</p>
                            <h4>Phone</h4>
                            <p class="lead">+88 01911 739129 <br> +88 01685 970744</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="card p-3">
                        <div class="card-body">
                            <h3 class="text-center">Please fill out this form to contact us</h3>
                            <hr>
                            <div class="row pt-2">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="First name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Last name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Email">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Phone number">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <textarea type="text" class="form-control" placeholder="Message"
                                            rows="5"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <input type="submit" value="Submit" class="btn btn-primary btn-block">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection