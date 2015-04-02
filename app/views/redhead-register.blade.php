@extends('inside')

@section('browser-title')
    Redhead Cleanup Registration: Canaport LNG | Clean. Safe. Energy.
@stop

@section('title')
    Red Head Community Spring Cleanup
@stop

@section('content')

    <h1>Red Head Community Spring Clean-up</h1>

    <img src="/redhead-banner.jpg" style="width: 100%; height: auto" alt="cleanup">
    <p>&nbsp;</p>
    <h2>Show your community pride & REGISTER for the
    Red Head Community Spring clean-up</h2>

    <p><strng>Saturday, May 2nd, 2015</strng></p>
    <ul>
        <li>Registration at Ocean Drive Park: 8:30 am</li>
        <li>Clean Up Begins: 9:00 am</li>
        <li>Community BBQ at Ocean Drive Park: 12:00 noon</li>
        <li>Be sure to register by APRIL 29th! RAIN or SHINE!</li>
    </ul>

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

    <p>&nbsp;</p>

    <p><strong>With the arrival of Spring, we can all pitch in and clean up the Red Head Road</strong>. Gather your family, friends and neighbours to help make Red Head look even better by cleaning up the areas outside your homes and along the road. <strong>Working together we can keep Red Head clean and green!</strong></p>

    <p>This spring clean-up will involve the coordinated effort of Canaport LNG, its employees and the residents of the Red Head community. We will provide garbage pickup for the entire length of the Red Head Road and we encourage all residents to take an active role in this community clean-up project by cleaning up their property and the surrounding areas.</p>

    <p><strong>Wear old clothes and we’ll supply the gloves. We’ll celebrate everyone’s hard work afterwards with a community BBQ!</strong></p>

    <p>&nbsp;</p>

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