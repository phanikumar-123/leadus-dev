@extends('layouts.site-base')

@section('body-class', 'plans-page')
@section('body')
<x-header />
<div class="container-fluid subscription-plans full-page">
    <div id="plan-slider" class="carousel slide" data-interval="false" data-touch="false">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <form id="plan-form" novalidate>
                    <h1 class="title mt-4 mb-5 text-center">Choose from our tailored plans to meet your requirement</h1>
                    <input type="hidden" name="plan" id="plan" />
                    <div class="plans">
                        <div class="row">
                            @foreach ($plans as $plan)
                            <div class="card" data-plan-id="{{ $plan->id }}">
                                <div class="card-body">
                                    <div class="check">
                                        <i class="fa fa-check-circle" aria-hidden="true"></i>
                                    </div>
                                    <h5 class="card-subtitle mb-5 text-muted">{{ $plan->plan_name }}</h5>
                                    <h6 class="card-title mb-4">&#8377; {{ $plan->plan_total_price }}</h6>
                                    <div class="card-text">
                                        @if ($plan->plan_type == 'free')
                                        <p class="">{{ $plan->offer_msg }}</p>
                                        @else
                                        <p class="">&#8377; {{ $plan->plan_monthly_selling_price }}/Month</p>
                                        @if ($plan->plan_monthly_selling_price != $plan->plan_monthly_cost_price)
                                        <p class="text-muted original-price">&#8377;
                                            {{ $plan->plan_monthly_cost_price }}/Month</p>
                                        @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="submit-btn-wrapper">
                        <button class="btn btn-lg btn-primary submit-btn" type="submit" disabled>Select Plan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<form method="post" class="d-none paytm-form">
    <input type="hidden" name="mid" value="YOUR_MID_HERE">
    <input type="hidden" name="orderId" value="YOUR_ORDERID_HERE">
    <input type="hidden" name="txnToken" value="YOUR_TXNTOKEN_HERE">
</form>
<x-footer />
@endsection
