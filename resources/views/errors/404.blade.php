@extends('layouts.app')
 
@section('content')


<div class="page-contaiter">
            <!--Content-->
            <section class="sec-padding--lg">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 offset-md-4">
                            <div class="error-page text-center">
                                <h1>404</h1>
                                <h3>Oops, page not found.</h3>
                                <p class="large">It looks like nothing was found at this location. Click the link below to return home.</p>
                                <!--<div class="widget">
                                    <form class="search-form">
                                        <input class="search-field input--lg" placeholder="Search.." value="" name="s" type="search">
                                        <button type="submit" class="search-button btn btn--primary btn--lg">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </form>
                                </div>-->
                                <a href="/" class="btn btn--gray space-t--2">Back to Home</a>
                            </div>
                        </div>

                    </div>
                </div>
            </section>
            <!--End Content-->
        </div>
@endsection