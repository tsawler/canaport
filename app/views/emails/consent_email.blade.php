@extends('email-layout')



@section('email-content')

<p>The individual below has consented to receiving email:</p>

<p><strong>First name:</strong> {{ $first_name }}</p>
<p><strong>Last name:</strong> {{ $last_name }}</p>
<p><strong>Contact email:</strong> <a href="mailto:{{ $email }}">{{ $email }}</a></p>

@stop