@extends('email-layout')



@section('email-content')

<p>The following email came in from the website</p>

<p><strong>Contact name:</strong> {{ $users_name }}</p>
<p><strong>Contact email:</strong> <a href="mailto:{{ $email }}">{{ $email }}</a></p>
<p><strong>Message</strong>:
<br>
{{ $the_message }}
</p> 
@stop