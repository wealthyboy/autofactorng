@extends('layouts.app')
 
@section('content')


<div class="page-contaiter">
            <!--Content-->
            <section class="sec-padding--lg">
                <div class="container">
                    <div class="row">

                        <div class="col-md-4 offset-md-4">
                        @include('includes.success')
                        @if (!session('success'))
                            <div class="error-page text-center">
                                <h1>Hey!  </h1>
                                <p class="large">Please confirm your email to unsubscribe.</p>
                                <div class="widget">
                                    <form method="POST" action="" class="search-form">
                                    @csrf
                                        <input class="search-field input--lg" placeholder="Email...." value="" name="email" type="search">
                                        <button type="submit"  class="btn btn--gray space-t--2">Submit</a>
                                    </form>
                                </div>
                            </div>
                        @else
                            <a href="/" class="btn btn--gray space-t--2">Back to Home</a>
                        @endif
                        </div>

                    </div>
                </div>
            </section>
            <!--End Content-->
        </div>
@endsection