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
    $(document).ready(function () {
        // ------------ Twitter Feed Variables	------------
        var totaltweets = 12; //Must be a multiple of tweetshift;
        var twitterprofile = "canaportlng";
        var screenname = "Canaport LNG";
        var showdirecttweets = true;
        var showretweets = true;
        var showtweetlinks = true;
        var showprofilepic = false;
        var showtweetactions = false;
        var showretweetindicator = false;

        // ------------ Twitter Carousel Variables	------------
        var feedheight = 240;
        var pausetime = 7000;
        var slidetime = 1000;
        var tweetshift = 1
        var slideinitial = true;


        var headerHTML = '';
        var loadingHTML = '';
        headerHTML += '<div id="twitter-header"><a href="https://twitter.com/" target="_blank"><img src="/assets/img/twitter-bird-light.png" width="34" style="float:left;padding:3px 12px 0px 6px; width: 34px;" alt="twitter bird" /></a>';
        headerHTML += '<h1>'+screenname+' <span style="font-size:13px"><a href="https://twitter.com/'+twitterprofile+'" target="_blank">@'+twitterprofile+'</a></span></h1></div>';
        loadingHTML += '<div id="loading-container" style="height:'+feedheight+'px !important;"><img src="images/ajax-loader.gif" width="32" height="32" alt="tweet loader" /></div>';

        $('#twitter-feed').html(headerHTML + loadingHTML);

        $.getJSON('/twitter',
            function(feeds) {
                var feedHTML = '';
                var displayCounter = 1;

                for (var i=0; i<feeds.length; i++) {
                    var tweetscreenname = feeds[i].user.name;
                    var tweetusername = feeds[i].user.screen_name;
                    var profileimage = feeds[i].user.profile_image_url_https;
                    var status = feeds[i].text;
                    var isaretweet = false;
                    var isdirect = false;
                    var tweetid = feeds[i].id_str;



                    //If the tweet has been retweeted, get the profile pic of the tweeter
                    if(typeof feeds[i].retweeted_status != 'undefined'){
                        profileimage = feeds[i].retweeted_status.user.profile_image_url_https;
                        tweetscreenname = feeds[i].retweeted_status.user.name;
                        tweetusername = feeds[i].retweeted_status.user.screen_name;
                        tweetid = feeds[i].retweeted_status.id_str;
                        status = feeds[i].retweeted_status.text;
                        isaretweet = true;
                    };


                    //Check to see if the tweet is a direct message
                    if (feeds[i].text.substr(0,1) == "@") {
                        isdirect = true;
                    }

                    var pb = "";
                    if (showretweetindicator == true) {
                        pb = 'style="padding-bottom:20px;"';
                    }

                    //console.log(feeds[i]);

                    //Generate twitter feed HTML based on selected options
                    if (((showretweets == true) || ((isaretweet == false) && (showretweets == false))) && ((showdirecttweets == true) || ((showdirecttweets == false) && (isdirect == false)))) {
                        if ((feeds[i].text.length > 1) && (displayCounter <= totaltweets)) {
                            if (showtweetlinks == true) {
                                status = addlinks(status);
                            }

                            if (displayCounter == 1) {
                                feedHTML += headerHTML;
                                feedHTML += '<div class="tweets-container" style="height:'+feedheight+'px !important;">';
                            }



                            feedHTML += '<div class="twitter-article" id="t'+displayCounter+'" '+pb+'>';
                            feedHTML += '<div class="twitter-pic"><a href="https://twitter.com/'+tweetusername+'" target="_blank"><img src="'+profileimage+'"images/twitter-feed-icon.png" width="42" height="42" alt="twitter icon" /></a></div>';
                            feedHTML += '<div class="twitter-text"><p><span class="tweetprofilelink"><strong><a href="https://twitter.com/'+tweetusername+'" target="_blank">'+tweetscreenname+'</a></strong> <a href="https://twitter.com/'+tweetusername+'" target="_blank">@'+tweetusername+'</a></span><span class="tweet-time"><a href="https://twitter.com/'+tweetusername+'/status/'+tweetid+'" target="_blank">'+relative_time(feeds[i].created_at)+'</a></span><br/>'+status+'</p>';

                            if ((isaretweet == true) && (showretweetindicator == true)) {
                                feedHTML += '<div id="retweet-indicator"></div>';
                            }
                            if (showtweetactions == true) {
                                feedHTML += '<div id="twitter-actions"><div class="intent" id="intent-reply"><a href="https://twitter.com/intent/tweet?in_reply_to='+tweetid+'" title="Reply"></a></div><div class="intent" id="intent-retweet"><a href="https://twitter.com/intent/retweet?tweet_id='+tweetid+'" title="Retweet"></a></div><div class="intent" id="intent-fave"><a href="https://twitter.com/intent/favorite?tweet_id='+tweetid+'" title="Favourite"></a></div></div>';
                            }

                            feedHTML += '</div>';
                            feedHTML += '</div>';

                            displayCounter++;
                        }
                    }
                }
                feedHTML += '</div>';

                $('#twitter-feed').html(feedHTML);

                function tweetcarousel() {
                    var currenttweet = 1;
                    var lasttweet = totaltweets;
                    var tweetheight = new Array();
                    var totalheight  = 0;
                    var sliderheight = feedheight;

                    for (var i=1; i<=totaltweets; i++) {
                        tweetheight[i] = parseInt($('#t'+i).css('height')) + parseInt($('#t'+i).css('padding-top')) + parseInt($('#t'+i).css('padding-bottom'));
                        //console.log(totalheight);
                        if (slideinitial == false) {
                            sliderheight = 0;
                        }
                        if (i > 1) {

                            $('#t'+i).css('top', tweetheight[i-1] + totalheight + sliderheight);
                            $('#t'+i).animate({'top':tweetheight[i-1]+ totalheight}, slidetime);
                            totalheight += tweetheight[i-1];
                        } else {
                            $('#t'+i).css('top', sliderheight);
                            $('#t'+i).animate({'top':0}, slidetime);
                        }

                        //$('#t'+i).css('top', tweetheight[i]+ totalheight);


                    }
                    totalheight += tweetheight[totaltweets];


                    //$('#t'+totaltweets).css('top', tweetheight[totaltweets-1]);

                    //$('.tweets-slider').animate({'top':0}, 800);

                    setInterval(scrolltweets, pausetime);

                    function scrolltweets() {
                        var currentheight = 0;
                        //totalheight = 0;
                        for (var i=0; i<tweetshift; i++) {
                            var nexttweet = currenttweet+i;
                            if (nexttweet > totaltweets) {
                                nexttweet -= totaltweets;
                            }
                            //console.log(nexttweet + " "+ currenttweet);
                            currentheight += tweetheight[nexttweet];
                        }

                        for (var i=1; i<=totaltweets; i++) {
                            //totalheight+=tweetheight[i];
                            $('#t'+i).animate({'top': (parseInt($('#t'+i).css('top'))-currentheight) }, slidetime, function(){

                                var animatedid = parseInt($(this).attr('id').substr(1,2));

                                if (animatedid==totaltweets) {
                                    for (j=1; j<=totaltweets; j++) {
                                        if (parseInt($('#t'+j).css('top')) < -50) {
                                            var toppos = parseInt($('#t'+lasttweet).css('top')) + tweetheight[lasttweet];
                                            $('#t'+j).css('top', toppos);
                                            lasttweet = j;

                                            if (currenttweet >= totaltweets) {
                                                var newcurrent = currenttweet - totaltweets + 1;
                                                currenttweet = newcurrent;
                                            } else {
                                                currenttweet++;
                                            };
                                        }
                                    }

                                }
                            });
                        }

                        /*$('.tweets-slider').animate({'top': '-='+currentheight+''}, 1000, function() {
                            $('#t'+currenttweet).css('top', totalheight);
                            totalheight+=tweetheight[currenttweet];

                            if (currenttweet == totaltweets) {
                                currenttweet = 1;
                            } else {
                                currenttweet++;
                            }
                        });*/
                        //console.log(currentheight);
                    }
                }

                tweetcarousel();

                //Add twitter action animation and rollovers
                if (showtweetactions == true) {
                    $('.twitter-article').hover(function(){
                        $(this).find('#twitter-actions').css({'display':'block', 'opacity':0, 'margin-top':-20});
                        $(this).find('#twitter-actions').animate({'opacity':1, 'margin-top':0},200);
                    }, function() {
                        $(this).find('#twitter-actions').animate({'opacity':0, 'margin-top':-20},120, function(){
                            $(this).css('display', 'none');
                        });
                    });

                    //Add new window for action clicks

                    $('#twitter-actions a').click(function(){
                        var url = $(this).attr('href');
                        window.open(url, 'tweet action window', 'width=580,height=500');
                        return false;
                    });
                }


            }).error(function(jqXHR, textStatus, errorThrown) {
            var error = "";
            if (jqXHR.status === 0) {
                error = 'Connection problem. Check file path and www vs non-www in getJSON request';
            } else if (jqXHR.status == 404) {
                error = 'Requested page not found. [404]';
            } else if (jqXHR.status == 500) {
                error = 'Internal Server Error [500].';
            } else if (exception === 'parsererror') {
                error = 'Requested JSON parse failed.';
            } else if (exception === 'timeout') {
                error = 'Time out error.';
            } else if (exception === 'abort') {
                error = 'Ajax request aborted.';
            } else {
                error = 'Uncaught Error.\n' + jqXHR.responseText;
            }
            alert("error: " + error);
        });

        //Function modified from Stack Overflow
        function addlinks(data) {
            //Add link to all http:// links within tweets
            data = data.replace(/((https?|s?ftp|ssh)\:\/\/[^"\s\<\>]*[^.,;'">\:\s\<\>\)\]\!])/g, function(url) {
                return '<a href="'+url+'" >'+url+'</a>';
            });

            //Add link to @usernames used within tweets
            data = data.replace(/\B@([_a-z0-9]+)/ig, function(reply) {
                return '<a href="http://twitter.com/'+reply.substring(1)+'" style="font-weight:lighter;" target="_blank">'+reply.charAt(0)+reply.substring(1)+'</a>';
            });
            //Add link to #hastags used within tweets
            data = data.replace(/\B#([_a-z0-9]+)/ig, function(reply) {
                return '<a href="https://twitter.com/search?q='+reply.substring(1)+'" style="font-weight:lighter;" target="_blank">'+reply.charAt(0)+reply.substring(1)+'</a>';
            });
            return data;
        }


        function relative_time(time_value) {
            var values = time_value.split(" ");
            time_value = values[1] + " " + values[2] + ", " + values[5] + " " + values[3];
            var parsed_date = Date.parse(time_value);
            var relative_to = (arguments.length > 1) ? arguments[1] : new Date();
            var delta = parseInt((relative_to.getTime() - parsed_date) / 1000);
            var shortdate = time_value.substr(4,2) + " " + time_value.substr(0,3);
            delta = delta + (relative_to.getTimezoneOffset() * 60);

            if (delta < 60) {
                return '1m';
            } else if(delta < 120) {
                return '1m';
            } else if(delta < (60*60)) {
                return (parseInt(delta / 60)).toString() + 'm';
            } else if(delta < (120*60)) {
                return '1h';
            } else if(delta < (24*60*60)) {
                return (parseInt(delta / 3600)).toString() + 'h';
            } else if(delta < (48*60*60)) {
                //return '1 day';
                return shortdate;
            } else {
                return shortdate;
            }
        }

    });
 </script>
@stop