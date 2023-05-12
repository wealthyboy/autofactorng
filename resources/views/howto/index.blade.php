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
                                <li class="breadcrumb-item active" aria-current="page">how to<li>
                            </ol>
                        </div>
                    </nav>
                    <h1 class="breadcrumb-title">How To</h1>
                    <p></p>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="home">
    <div class="container">
        <div class="row justifiy-content-center">
            @foreach($videos as $video)
            <div id="content" class="col-md-6  mb-5">
              <h2>{{ $video->title }}</h2>
              <?php echo  html_entity_decode( $video->description)  ?>

              <iframe src="{{ $video->link }}" height="600"  class="w-100" frameborder="0"></iframe>
               
            </div>
            @endforeach
            <div class="margin-top-35"></div>
        </div> <!-- /row -->
    </div> <!-- /container -->
</section>



@endsection