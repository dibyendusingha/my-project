@extends('admin.layout.header')
@section('content')

<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">User Form </h3>

        </div>
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <!-- <form class="forms-sample" id="paymentForm" action="{{ route('razorpay.payment.store') }}" method="POST">
                            @csrf
                            <div class="form-group row">
                                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Amount</label>
                                <div class="col-sm-9">
                                <input type="text" class="form-control" id="payment_amount" name="payment_amount" placeholder="payment">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success me-2" onclick="payWithRazorpay()">Payment</button>
                            <button class="btn btn-dark">Cancel</button>
                            
                            
                        </form> -->

                        <form id="paymentForm" action="{{ route('razorpay.payment.store') }}" method="POST">
                            @csrf
                            <div class="form-group row">
                                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Amount</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="payment_amount" name="payment_amount" placeholder="payment">
                                </div>
                            </div>
                            <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
                        </form>
                        <input type="submit" class="btn btn-primary me-2" value="Pay Now" onclick="payWithRazorpay()">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->


    @endsection