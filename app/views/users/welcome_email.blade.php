@extends('email-layout')

@section('browser-title')
Canaport LNG
@stop



@section('email-content')
Dear {{ $users_name }}:<br /><br />
<p>Thanks for registering, and Welcome to Canaport LNG.</p>
<p>In order to complete your registration, please active your account by clicking on the following link:</p>
<p><a href="{{ Config::get('app.url') }}/verifyaccount?key={{ $token }}">Click here to activate your account</a></p>
@stop