

@extends('layouts.app')
        
@section('content')
<div class=" bg--gray">
    <section class="breadcrumb justify-content-center">
        <div class="background-image" data-background="{{ optional($blog_image)->image }}" 
            style="background-image: url({{ optional($blog_image)->image }}); background-position: {{ optional($blog_image)->x_pos . '%' }} {{ optional($blog_image)->y_pos . '%'}};"
            data-bg-posx="center" data-bg-posy="center" data-bg-overlay="4"></div> 
            <div class="breadcrumb-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 text-center">
                            <h1 class="breadcrumb-title">Blog</h1>
                            <nav class="breadcrumb-link">
                                <span><a href="/">Home</a></span> /
                                <span>Blog</span>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    <div class="container  bg--gray">
            <div class="head text-center mt-3 mb-3">
               <h4  class="widget-title ">OHRAM BLOG </h4>
            </div>
             <!--Content-->
             <section class="">
                <div id="blog-entry" class="blog-entry blog-masonry">
                    <div class="container">
                        <div class="row blog-masonry-wrap text-center">
                            @foreach($posts as $post)
                            <!--Item-->
                            <div class="blog-item-grid col-md-4  col-lg-4">
                                <!--Blog Item-->
                                <div class="blog-item bg--light">
                                    <div class="blog-item-image blog">
                                        <a title="{{ $post->title }}" class="blog-img-link blog">
                                            <img title="{{ $post->title }}" src="{{ $post->m_path() }}" alt="{{ $post->title }} ">
                                        </a>
                                    </div>
                                    <div class="blog-item-content">
                                        <div class="tag bold">
                                            @foreach($post->attributes as $tag)
                                            <a href="/blog/tag/{{ $tag->id }}"><i class="fa fa-tags"></i> {{ $tag->name }}</a>
                                            @endforeach
                                        </div>
                                        <h6 class="blog-title text-uppercase"> 
                                            <a title="{{  $post->title }}" href="{{ route('blog.show',['blog'=> $post->slug]) }}" class="">
                                               {{ $post->title }}
                                            </a> 
                                        </h6>
                                        <div class="blog-description-content text-center">
                                            <?php echo  html_entity_decode($post->teaser);  ?>
                                         </div>
                                        <p class="info">
                                            <i class="fa fa-clock-o"></i><span>{{ $post->created_at->diffForHumans() }}</span>
                                        </p>
                                    </div>
                                </div>
                                <!--End Blog Item-->
                            </div>
                            @endforeach
                            <div class="clearfix"></div>
                        </div>
                        <div class="clearfix"></div>
                            <div class="col-12">
                                <div class="justifiy-content-center">
                                <div class="pagination-wraper">
                                </div>
                                </div>
                            </div>
                    </div>
                </div>
            </section>
            <!--End Content--> 
    </div> <!-- /container -->

</div>


<!-- /container -->
 
@endsection

@section('page-scripts')
<script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>
@stop
@section('inline-scripts')
$(document).ready(function() {
    $('.blog-masonry-wrap').masonry({
    // options
       itemSelector: '.blog-item-grid',
    });      
});
@stop

