@extends('insideevents')

@section('browser-title')
Community Involvement
@stop

@section('meta')
<meta name="description" content="Community Involvement: Canaport LNG" />
@stop

@section('content')

<h1>Community Involvement</h1>		

@if(Auth::check())
@if(Auth::user()->access_level ==3)
{{ Form::open(array('url' => 'admin/savefragment', 'id' => 'savefrag1', 'name' => 'savefrag1')) }}
<article class="editablefragment" id="f1" data-id="4">
{{ $fragment->fragment_content }}
</article>
<article class="admin-hidden">
	<a class="btn btn-primary" href="javascript:void(0)" onclick="saveEditedFragment(1)">Save</a>
	<a class="btn btn-info" href="javascript:void(0)" onclick="turnOffEditing()">Cancel</a>
	&nbsp;&nbsp;&nbsp;
</article>
<span id="thetitle1"></span>
<input type="hidden" name="fid" value="6">
<input type="hidden" name="thedata" id="thedata1">
<input type="hidden" name="thetitle" id="thetitledata1">
{{ Form::close() }}
@endif
@endif

@if(Auth::check())
@if(Auth::user()->access_level == 1)
<article>
{{ $fragment->fragment_content }}
</article>
@endif
@endif

@if(! Auth::check())
<article>
{{ $fragment->fragment_content }}
</article>
@endif

@foreach($cis as $ci)
	<article class="post hentry">
		<div class="post-image">
			<a href="/img/ci/{{ $ci->pic }}" data-rel="prettyPhoto">
				<span class="img-hover"></span>
				<span class="fullscreen"><i class="icon-search"></i></span>
				<img src="/img/ci/{{ $ci->pic }}" alt="">
			</a>
		</div>
		<div class="post-content-wrap">
		<header class="post-header">
			<h3 class="content-title">{{ $ci->label }}</h3>
		</header>
		<div class="post-content">
		<p>{{ $ci->content }}</p>
		</div>
		</div>
		<div class="clearfix"></div>
	</article>
	<div class="blog-divider"></div>
@endforeach

@stop

<p>&nbsp;</p>	
<span id="theeditmsg" class="hidden">&nbsp;</span>
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
<script>
$(document).ready(function () {
	$(".flash").removeClass("hidden");
});
</script>
@stop