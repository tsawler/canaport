@extends('email-layout')

@section('email-content')

    <p>The following individual has registered for the Red Head Community Cleanup</p>

    <p><strong>Registrant name:</strong> {{ $users_name }}</p>
    <p><strong>Registrant email:</strong> <a href="mailto:{{ $email }}">{{ $email }}</a></p>
@stop