@extends('layouts.landing')

@section('styles')
    <link rel="stylesheet" href="https://unpkg.com/bs-brain@2.0.4/components/faqs/faq-2/assets/css/faq-2.css">
@endsection

@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container text-center py-5">
            <h1 class="display-3 text-white mb-4 animated slideInDown">Bantuan</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('landing.home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Bantuan</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Service Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <!-- Bagian Judul -->
            <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <p class="fs-5 fw-bold text-primary">Bantuan</p>
                <h1 class="display-5 mb-5" style="font-size: 30px;">Temukan jawaban atas pertanyaan umum atau masalah yang
                    Anda hadapi di sini.</h1>
            </div>

            <div class="row justify-content-center align-items-center g-4 mt-5">
                <div class="col-12 col-lg-10">
                    <div class="row justify-content-center">
                        <div class="col-12 col-xl-11">
                            <div class="accordion accordion-flush" id="accordionExample">
                                <div class="accordion-item mb-4 shadow-sm">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button class="accordion-button bg-transparent fw-bold" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true"
                                            aria-controls="collapseOne">
                                            How Do I Change My Billing Information?
                                        </button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse show"
                                        aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <p>To change your billing information, please follow these steps:</p>
                                            <ul>
                                                <li>Go to our website and sign in to your account.</li>
                                                <li>Click on your profile picture in the top right corner of the page
                                                    and select "Account Settings."</li>
                                                <li>Under the "Billing Information" section, click on "Edit."</li>
                                                <li>Make your changes and click on "Save."</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item mb-4 shadow-sm">
                                    <h2 class="accordion-header" id="headingTwo">
                                        <button class="accordion-button collapsed bg-transparent fw-bold" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false"
                                            aria-controls="collapseTwo">
                                            How Does Payment System Work?
                                        </button>
                                    </h2>
                                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo">
                                        <div class="accordion-body">
                                            A payment system is a way to transfer money from one person or organization
                                            to another. It is a complex process that involves many different parties,
                                            including banks, credit card companies, and merchants.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item mb-4 shadow-sm">
                                    <h2 class="accordion-header" id="headingThree">
                                        <button class="accordion-button collapsed bg-transparent fw-bold" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false"
                                            aria-controls="collapseThree">
                                            Will taxes be included in my monthly invoice?
                                        </button>
                                    </h2>
                                    <div id="collapseThree" class="accordion-collapse collapse"
                                        aria-labelledby="headingThree">
                                        <div class="accordion-body">
                                            Whether or not taxes are included in your monthly invoice depends on a
                                            number of factors, including your location, the type of services you are
                                            receiving, and the policies of the company providing you with those
                                            services.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item mb-4 shadow-sm">
                                    <h2 class="accordion-header" id="headingFour">
                                        <button class="accordion-button collapsed bg-transparent fw-bold" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false"
                                            aria-controls="collapseFour">
                                            What currency will I be charged in?
                                        </button>
                                    </h2>
                                    <div id="collapseFour" class="accordion-collapse collapse"
                                        aria-labelledby="headingFour">
                                        <div class="accordion-body">
                                            The currency you are charged in when making a purchase will depend on a
                                            number of factors, including the merchant you are purchasing from, the
                                            country you are purchasing from, and the payment method you are using.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item shadow-sm">
                                    <h2 class="accordion-header" id="headingFive">
                                        <button class="accordion-button collapsed bg-transparent fw-bold" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false"
                                            aria-controls="collapseFive">
                                            How Do I Cancel My Account?
                                        </button>
                                    </h2>
                                    <div id="collapseFive" class="accordion-collapse collapse"
                                        aria-labelledby="headingFive">
                                        <div class="accordion-body">
                                            <p>To cancel your account, please follow these steps:</p>
                                            <ul>
                                                <li>Go to our website and sign in to your account.</li>
                                                <li>Click on your profile picture in the top right corner of the page
                                                    and select "Account Settings."</li>
                                                <li>Scroll to the bottom of the page and click on "Cancel Account."</li>
                                                <li>Enter your password and click on "Cancel Account."</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endSection

@section('scripts')
    {{-- SCRIPTS --}}
@endsection
