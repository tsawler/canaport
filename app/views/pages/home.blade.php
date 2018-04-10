@extends('layout')

@section('browser-title')
Canaport LNG | Clean. Safe. Energy.
@stop

@section('meta')
<meta name="description" content="Canaport LNG. Clean. Safe. Energy." />
@stop

@section('slider')
@include('partials.slider')
@stop

@section('hero-unit')

@stop

@section('content')

<h1>Welcome to Canaport LNG</h1>

@if(Auth::check())
@if(Auth::user()->access_level ==3)
	<div id="editmsg" class='alert alert-success hidden'>
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<span id="theeditmsg"></span>
	</div>

	{{ Form::open(array('url' => 'page/edit', 'id' => 'savedata', 'name' => 'savedata')) }}
	<article id="editablecontent" class="editablecontent" style='width: 100%; line-height: 2em;'>
	{{ $page_content }}
	</article>
	<article class="admin-hidden">
		<a class="btn btn-primary" href="javascript:void(0)" onclick="saveChanges()">Save</a>
		<a class="btn btn-info" href="javascript:void(0)" onclick="turnOffEditing()">Cancel</a>
		<br><br>
	</article>
	<input type="hidden" name="page_id" value="<?php echo $page_id;?>">
	<input type="hidden" name="thedata" id="thedata">
	<input type="hidden" name="thetitledata" value="{{ $page_title }}">
	{{ Form::close() }}
	<p>&nbsp;</p>
@endif
@endif

@if(Auth::check())
@if(Auth::user()->access_level == 1)
	<article style='width: 100%; line-height: 2em;'>
	{{ $page_content }}	
	</article>
	<p>&nbsp;</p>
@endif
@endif

@if(!Auth::check())
	<article style='width: 100%; line-height: 2em;'>
	{{ $page_content }}	
	</article>
	<p>&nbsp;</p>
@endif

<div class="row">
@if(Auth::check())
@if(Auth::user()->access_level ==3)
{{ Form::open(array('url' => 'admin/savefragment', 'id' => 'savefrag1', 'name' => 'savefrag1')) }}
<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
<h1><span class="editablecontenttitle" id="thetitle1">{{ $fragment_title }}</span></h1>
<article class="editablefragment" id="f1" data-id="4">
{{ $fragment_content }}
</article>
<article class="admin-hidden">
	<a class="btn btn-primary" href="javascript:void(0)" onclick="saveEditedFragment(1)">Save</a>
	<a class="btn btn-info" href="javascript:void(0)" onclick="turnOffEditing()">Cancel</a>
	&nbsp;&nbsp;&nbsp;
</article>
<input type="hidden" name="fid" value="4">
<input type="hidden" name="thedata" id="thedata1">
<input type="hidden" name="thetitle" id="thetitledata1">
{{ Form::close() }}
</div>
<p>&nbsp;</p>
@endif
@endif

@if(Auth::check())
@if(Auth::user()->access_level == 1)
<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
<h1>{{ $fragment_title }}</h1>
{{ $fragment_content }}
</div>
<p>&nbsp;</p>
@endif
@endif

@if(! Auth::check())
<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
<h1>{{ $fragment_title }}</h1>
{{ $fragment_content }}
</div>
<p>&nbsp;</p>
@endif

<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 item animate_afc d2" style="vertical-align: top; margin-top: -46px;">
   <div class="portfolio-item" style="vertical-align: top;">
      <a href="{{ $splash_image }}" class="portfolio-item-link" data-rel="prettyPhoto" >
      <span class="portfolio-item-hover"></span>
      <span class="fullscreen"><i class="icon-search"></i></span><img src="{{ $splash_image }}" alt=" "/>
      </a>
      <div class="portfolio-item-title">
            <a href="">{{ $splash_text }}</a>
      </div>
      <div class="clearfix"></div>
   </div>
</div>
</div>
<p>&nbsp;</p>
@stop

@section('second-row')

@if ((Auth::check()) && (Auth::user()->access_level == 3))

	{{ Form::open(array('url' => 'admin/savefragment', 'id' => 'savefrag2', 'name' => 'savefrag2')) }}
	
	<h1><span class="editablecontenttitle" id="thetitle2">{{ $fragment_title2 }}</span></h1>
	<div class="row">
	 <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 animate_afl d1">
	    <div class="portfolio-desc">
	
	
	<article class="editablefragment" id="f2" data-id="14">
	{{ $fragment_content2 }}
	</article>
	<article class="admin-hidden">
		<a class="btn btn-primary" href="javascript:void(0)" onclick="saveEditedFragment(2)">Save</a>
		<a class="btn btn-info" href="javascript:void(0)" onclick="turnOffEditing()">Cancel</a>
		&nbsp;&nbsp;&nbsp;
	</article>
	<input type="hidden" name="fid" value="14">
	<input type="hidden" name="thedata" id="thedata2">
	<input type="hidden" name="thetitle" id="thetitledata2">
	{{ Form::close() }}
	
	<p>&nbsp;</p>
@else
	<h1>{{ $fragment_title2 }}</h1>
	<div class="row">
	 <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 animate_afl d1">
	    <div class="portfolio-desc">
	
	
	<p>
	{{ $fragment_content2 }}
	</p>
@endif

       <div class="carousel-controls">
          <a class="prev" href="#portfolio-carousel" data-slide="prev"><i class="icon-angle-left"></i></a>
          <a class="next" href="#portfolio-carousel" data-slide="next"><i class="icon-angle-right"></i></a>
          <div class="clearfix"></div>
       </div>
    </div>
 </div>
 <div class="col-lg-9 col-md-9 col-xs-12">
    <div class="row">
       <div id="portfolio-carousel" class="portfolio-carousel slide">
          <div class="carousel-inner">
             <div class="item active">
             	@foreach ($involvements as $ci)
                	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 item animate_afc d2">
						<div class="portfolio-item">
							<a href="/img/ci/{{ $ci->pic }}" class="portfolio-item-link" data-rel="prettyPhoto" >
							<span class="portfolio-item-hover"></span>
							<span class="fullscreen"><i class="icon-search"></i></span><img src="/img/ci/{{ $ci->pic }}" alt=" "/>
							</a>
							<div class="portfolio-item-title">
							<a href="">{{ $ci->label }}</a>
							</div>
							<div class="clearfix"></div>
						</div>
					</div>
                @endforeach
             </div>
             
             <div class="item">
             	@foreach ($involvements2 as $ci)
                	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 item">
						<div class="portfolio-item">
							<a href="/img/ci/{{ $ci->pic }}" class="portfolio-item-link" data-rel="prettyPhoto" >
							<span class="portfolio-item-hover"></span>
							<span class="fullscreen"><i class="icon-search"></i></span><img src="/img/ci/{{ $ci->pic }}" alt=" "/>
							</a>
							<div class="portfolio-item-title">
							<a href="">{{ $ci->label }}</a>
							</div>
							<div class="clearfix"></div>
						</div>
					</div>
                @endforeach
             </div>
          </div>
       </div>
       <div class="clearfix"></div>
       <p>&nbsp;</p>
    </div>
 </div>
</div>
@stop
	
	
	
@section('pre-footer')
<div class="our-clients">
   <div class="container">
      <div class="row">
         <div class="client">
            <div class="client-logo">
               <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
                  <div class="clients-title">
                     <h3 class="title">Recent Photos</h3>
                     <div class="carousel-controls pull-right">
                     	<!--
                        <a class="prev" href="#client-carousel" data-slide="prev"><i class="icon-angle-left"></i></a>
                        <a class="next" href="#client-carousel" data-slide="next"><i class="icon-angle-right"></i></a>
                        <div class="clearfix"></div>
                        -->
                     </div>
                  </div>
                  <div class="clearfix"></div>
                  <div class="row">
                     <div id="client-carousel" class="client-carousel slide">
                        <div class="carousel-inner">
                           <div class="item active">
                           		@foreach($photos as $image)
									<div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 item animate_afc d1">
									<div class="item-inner portfolio-item">
									<a href="/img/gallery/{{ $image->img }}" class="portfolio-item-link" data-rel="prettyPhoto" >
									<span class="portfolio-item-hover"></span>
									<span class="fullscreen"><i class="icon-search"></i></span>
									<img alt="" src="/img/gallery/{{ $image->img }}">
									</a></div>
									</div>
								@endforeach
                           </div>
                        </div>
                     </div>
                     <div class="pull-right"><a style="color: white; font-size: 16pt" href="/gallery">View all photos</a></div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@stop

@section('bottom-js')
<script>

 </script>
@stop