@extends('email-layout')

@section('email-content')

<p>The following email came in from the website</p>

<p><strong>Name of Organization or Group conducting the project</strong>:
<br>
{{ $organization }}
</p> 

<p><strong>Describe the proposed work and how it will be conducted</strong>:
<br>
{{ $project_description }}
</p> 

<p><strong>How will this project benefit the Saint John community?</strong>
<br>
{{ $benefit }}
</p> 


<p><strong>Please include a project/organization budget, including other sources of funding</strong>:
<br>
{{ $budget }}
</p> 

<p><strong>What is the timeline for the project?</strong>
<br>
{{ $timeline }}
</p> 

<p><strong>Please include any other relevant information applicable to your project</strong>:
<br>
{{ $timeline }}
</p> 

<p><strong>Contact name:</strong> {{ $contact_name }}</p>
<p><strong>Contact phone:</strong> {{ $contact_phone }}</p>
<p><strong>Contact email:</strong> <a href="mailto:{{ $contact_email }}">{{ $contact_email }}</a></p>

@stop