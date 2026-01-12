@extends('layouts.app')

@section('content')

<section class="breadcrumb no-banner  justify-content-center">
    <div class="breadcrumb-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12  text-center border-bottom">
                    <nav aria-label="breadcrumb" class="breadcrumb-nav breadcrumb-link mt-3">
                        <div class="container d-flex justify-content-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/"><i class="icon-home"></i></a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ 'Returns'}}</li>
                            </ol>
                        </div>
                    </nav>
                    <h1 class="breadcrumb-title">{{ 'Returns'}}</h1>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="home">
    <div class="container">
        <div class="row justifiy-content-center">
            <h2>Returns</h2>
            <p>
                Welcome to the Returns Page
                We’re here to help make your return process quick and easy.
            </p>

            <p>
                Do you have a Return? Kindly click on the WhatsApp link to send us to message and a customer care representative would respond to you as soon as possible.
            <h2 style="font-style: italic;"><span style="font-family: Tahoma, Geneva, sans-serif; font-size: medium;">Whatsapp- <ins><strong><a href="https://cbl.link/ZrFXBpf"><span style="color: rgb(52, 152, 219);">Click to send us a Message</span></a></strong></ins></span></h2>
            </p>

            <p>Please click the link below to learn more about our Return, Refund, and Wallet Policy.
            <h2 style="font-style: italic;"><span style="font-family: Tahoma, Geneva, sans-serif; font-size: medium;"><ins><strong><a href="https://autofactorng.com/pages/return-policy"><span style="color: rgb(52, 152, 219);">Learn More</span></a></strong></ins></span></h2>
            =
            </p>

            <div class="margin-top-35"></div>
        </div> <!-- /row -->
    </div> <!-- /container -->
</section>



@endsection