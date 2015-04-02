@extends('email-layout')

@section('email-content')

<p>The following email should be added to your notification list (from website):</p>

<p><strong>Contact email:</strong> <a href="mailto:{{ $email }}">{{ $email }}</a></p>

@stop