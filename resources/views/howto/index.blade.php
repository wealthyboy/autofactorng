@extends('layouts.forum')

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
                                <li class="breadcrumb-item active" aria-current="page">VIDEO TIPS
                                <li>
                            </ol>
                        </div>
                    </nav>
                    <h1 class="breadcrumb-title">VIDEO TIPS</h1>
                    <p></p>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="home">
    <div class="container-fluid">
        <div class="row how-to justifiy-content-center">
            @foreach($videos as $video)
            <div id="content" class="col-md-6  mb-9 p-">
                <h2 class="mb-1">{{ $video->title }}</h2>
                <div style="height: 89px; " class="mt-3  d-none d-lg-block  d-xl-block mb-4"> <?php echo  html_entity_decode($video->description)  ?> </div>
                <div style="height:" class="mt-3  d-md-none d-lg-none d-sm-block mb-4"> <?php echo  html_entity_decode($video->description)  ?> </div>
                <div style="height: 69px;  " class="mt-3 d-md-block d-lg-none d-sm-none d-xl-none d-xs-none mb-4"> <?php echo  html_entity_decode($video->description)  ?> </div>

                <?php echo  html_entity_decode($video->link)  ?>
            </div>
            @endforeach
            <div class="margin-top-35">
                {{ $videos->links() }}
            </div>
        </div> <!-- /row -->
    </div> <!-- /container -->
</section>



@endsection