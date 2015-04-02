@extends('dashboard')

@section('browser-title')
Security
@stop

@section('content')
 
<h1>Security</h1>

<h3>Two-Step Authentication</h3>
<p>
Two-step Authentication is an optional but highly recommended security feature that adds an extra layer of protection to your account. 
Once you enable two-step Authentication, you will be asked to enter a six-digit security code in addition to your password 
whenever you sign in.</p>

<p>You will get the six digit code using an application installed on your mobile phone. The numeric code is 
regenerated every thirty seconds, making your account very secure. Which application you use
depends on what kind of device you have:</p>

<ul>
<li><a href="http://support.google.com/accounts/bin/answer.py?hl=en&answer=1066447" target="_blank">Google Authenticator</a> (Android/iPhone/BlackBerry)</li>
<li><a href="http://guide.duosecurity.com/third-party-accounts" target="_blank">Duo Mobile</a> (Android/iPhone)</li>
<li><a href="http://www.amazon.com/gp/product/B0061MU68M" target="_blank">Amazon AWS MFA</a> (Android)</li>
<li><a href="http://www.windowsphone.com/en-US/apps/021dd79f-0598-e011-986b-78e7d1fa76f8" target="_blank">Authenticator</a> (Windows Phone)</li>
</ul>

<p><br>
<strong>Install the application on your phone before you enable two-step Authentication</strong>. Once it is installed, 
enable this feature on your account, and then scan the QR code which will be displayed on this page.</p>

<p>Most apps will generate security codes even when cellular/data service is not available, which is useful when traveling 
or where coverage is unreliable.</p>

{{ Form::model($user, array(
						'role' => 'form', 
						'class' => 'form-inline',
						'name' => 'bookform', 'id' => 'bookform',
						'url' => array('users/security', $user->id )
						) 
		   )
}}

<div class="form-group">

	{{  Form::label('use_tfa', 'Use 2-Step Auth: ', array('class' => 'control-label')) }}

	{{ Form::select('use_tfa', array(
		'1' => 'Yes',
		'0' => 'No'),
		null,
		array('id' => 'checkTFA', 'class' => 'form-control form-inline',
			'style' => 'max-width: 400px;')) }}
</div>


@if(Auth::user()->use_tfa == 1)
    <div id="qr" class="control-group">
    <div class="controls">
    <img src="{{ $qrCodeUrl }}"><br>
    <input type="text" name="testcode" id="testcode" class='form-control form-inline' style='max-width: 200px;' placeholder="enter test code">
    <a href="#!" onclick="testCode()" class="btn btn-info">Test Code</a>&nbsp;
    <span id="result"></span>
    </div>
    </div>
@else
	<div id="qr" class="control-group hidden">
    <div class="controls">
    
	<span id="tfaoutput"></span>
	<br>
	<input type="text" name="testcode" class='form-control form-inline' style='max-width: 200px;' id="testcode" placeholder="enter test code">
    <a href="#!" onclick="testNewCode()" class="btn btn-info">Test Code</a>&nbsp;
    <span id="result"></span>
    </div>
    </div>
@endif

<div class="blog-divider"></div>
			     
<div class="form-group">
    <div class="controls">
	    {{ Form::submit('Enter test code first', array('class' => 'btn-normal btn-color submit'
	    	, 'disabled' => 'disabled', 'id' => 'processform'))
	    }}
    </div>
</div>
<div>&nbsp;</div>
{{ Form::hidden('newsecret', null, array('id'=>'newsecret')) }}
{{ Form::hidden('userid', Auth::user()->id) }}
{{ Form::close() }}
			
{{ Form::open(array('url' => 'users/testcode', 'name' => 'testCodeForm', 'id' => 'testCodeForm')) }}
	<input type="hidden" name="testval" id="testval">
{{ Form::close() }}

{{ Form::open(array('url' => 'users/testcode', 'name' => 'testNewCodeForm', 'id' => 'testNewCodeForm')) }}
	<input type="hidden" name="testval" id="newtestval">
	<input type="hidden" name="thesecret" id="thesecret">
{{ Form::close() }}
		    
@stop

@section('bottom-js')
<script>
function testCode(){
	$("#testval").val($("#testcode").val());
	var options = { target: '#result', success: showResponse };
    $("#testCodeForm").unbind('submit').ajaxSubmit(options);;
    return false;
}

function testNewCode(){
	$("#newtestval").val($("#testcode").val());
	$("#thesecret").val($("#newsecret").val());
	var options = { target: '#result', success: showResponse };
    $("#testNewCodeForm").unbind('submit').ajaxSubmit(options);;
    return false;
}

function showResponse(responseText, statusText, xhr, $form)  { 
	if (responseText == "<span style='color: green'>Valid code!</span>")
	{
		$("#processform").val('Update');
		$("#processform").removeAttr("disabled");
	} 
}

$("#checkTFA").change(function() {
	var val = $("#checkTFA").val();
	if (val == 1){
		$("#qr").removeClass("hidden");
		@if(Auth::user()->use_tfa == 1)
			$("#processform").val('Enter test code first');
			$("#processform").attr("disabled", "disabled");
		@else
			var loadUrl = "/users/code";
			$("#tfaoutput").load(loadUrl, null, function(responseText){
            	$("#newsecret").val($("#newsecrettext").html());
			});
		@endif
		$("#processform").val('Enter test code first');
		$("#processform").attr("disabled","disabled");
	} else {
		$("#tfaoutput").html('');
		$("#qr").addClass("hidden");
		$("#processform").val('Update');
		$("#processform").removeAttr("disabled");
	}
});
</script>
@stop