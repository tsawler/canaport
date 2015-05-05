@extends('inside')

@section('browser-title')
    Redhead Cleanup Registration: Canaport LNG | Clean. Safe. Energy.
@stop

@section('title')
    Red Head Community Spring Cleanup
@stop

@section('content')

    <h1>{{ $page->title }}</h1>

    <img src="/img/{{ $page->image }}" style="width: 100%; height: auto" alt="cleanup">

    {{ $page->above }}

    <p>&nbsp;</p>

    {{ Form::open(array('url' => '/redheadcleanup',
					'class' => 'form',
					'name' => 'bookform',
					'id' => 'bookform',
					'method' => 'post')) }}

    <fieldset>

        <div class="form-group">
            {{ Form::label('name', 'Your name', array('class' => 'control-label')); }}
            <div class="controls">
                <div class="input-group">
                    <span class="input-group-addon"><i class='icon-font'></i></span>
                    {{ Form::text('name', null, array('class' => 'required form-control',
                                                                'style' => 'max-width: 400px;',
                                                                'placeholder' => 'Your name')); }}
                </div>
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('email', 'Email Address', array('class' => 'control-label')); }}
            <div class="controls">
                <div class="input-group">
                    <span class="input-group-addon"><i class='icon-envelope'></i></span>
                    {{ Form::email('email', null, array('class' => 'form-control required email',
                                                                'style' => 'max-width: 400px;',
                                                                'placeholder' => 'you@example.com')); }}
                </div>
            </div>
        </div>

        <div class="blog-divider"></div>

        <div class="form-group">
            <div class="controls">
                {{ Form::submit('Register', array('class' => 'btn-normal btn-color submit')) }}
            </div>
        </div>

    </fieldset>

    {{ Form::close() }}

    {{ $page->below }}

@stop

@section('bottom-js')
    <script>
        $(document).ready(function () {
            $("#bookform").validate({
                errorClass:'has-error',
                validClass:'has-success',
                errorElement:'span',
                highlight: function (element, errorClass, validClass) {
                    $(element).parents("div[class='form-group']").addClass(errorClass).removeClass(validClass);
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).parents(".has-error").removeClass(errorClass).addClass(validClass);
                }
            });
        });
    </script>
@stop