@extends('layouts.app')
        
@section('content')

<section class="breadcrumb no-banner  justify-content-center">
    <div class="breadcrumb-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12  text-center border-bottom">
                    <nav aria-label="breadcrumb" class="breadcrumb-nav breadcrumb-link">
                        <div class="container d-flex justify-content-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/"><i class="icon-home"></i></a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ $information->title }}</li>
                            </ol>
                        </div>
                    </nav>
                    <h1 class="breadcrumb-title">{{ $information->title }}</h1>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="home">   
    <div class="container">
        <div class="row justifiy-content-center">        
          <div id="content" class="col-md-12  mb-5">  
              @if ($message = \Session::get('success'))
                  <p><a href=""> <<< Back </a></p>
                  <div class="alert alert-success color--light alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>	
                      <strong>{{ $message }}</strong>
                  </div>
                @elseif ($errors->any() )
                  <p><a href=""> <<< Back </a></p>
                  <div class="alert alert-danger">
                      <ul>
                          @foreach($errors->all()  as $error)
                              <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                  </div>
                    
                @else
                 <p><?php echo  html_entity_decode($information->description);  ?></p>
                @endif
          </div>
        <div class="margin-top-35"></div>
      </div> <!-- /row -->
    </div> <!-- /container -->
</section>


 
@endsection
