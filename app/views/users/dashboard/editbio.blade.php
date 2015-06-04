@extends('dashboard')

@section('content')

    <div class="container">

        <div id="editmsg" class='alert alert-success hidden'>
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <span id="theeditmsg">&nbsp;</span>
        </div>

        <h1>Edit Bio</h1>

        @if(count($errors) > 0)
            <div class="alert alert-error">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{ Form::model($bio, array(
                                'role' => 'form',
                                'name' => 'bookform', 'id' => 'bookform',
                                'method' => 'post',
                                'url' => array('admin/editbio', $bio->id)
                                )
                   )
        }}

        <div class="form-group">
            {{ Form::label('bio_name', 'Title', array('class' => 'control-label')); }}
            <div class="controls">
                <div class="input-group">
                    <span class="input-group-addon">A</span>
                    {{ Form::text('bio_name', null, array('class' => 'required form-control',
                                                        'style' => 'max-width: 400px;',
                                                        'placeholder' => 'Title',
                                                        'autofocus'=>'autofocus')); }}
                </div>
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('bio_text', 'Text', array('class' => 'control-label')); }}
            <div class="controls" style='max-width: 650px;'>
                {{ Form::textarea('bio_text', null, array('style' => 'max-width: 400px;') ); }}
            </div>
        </div>

        <hr>
        <div class="form-group">
            <div class="controls">
                {{ Form::submit('Save', array('class' => 'btn-normal btn-color submit')) }}
            </div>
        </div>
        <div>&nbsp;</div>

        {{ Form::hidden('id', $bio->id) }}

        {{ Form::close() }}
    </div>
    <div>&nbsp;</div>
    <div>&nbsp;</div>
@stop

@section('bottom-js')
    <script>
        $(document).ready(function () {
            $("#bookform").validate({
                errorClass: 'has-error',
                validClass: 'has-success',
                errorElement: 'span',
                highlight: function (element, errorClass, validClass) {
                    $(element).parents("div[class='form-group']").addClass(errorClass).removeClass(validClass);
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).parents(".has-error").removeClass(errorClass).addClass(validClass);
                }
            });

            CKEDITOR.replace('bio_text',
                    {
                        toolbar: 'MyToolbar',
                        forcePasteAsPlainText: true,
                        filebrowserBrowseUrl: '/filemgmt/browse.php?type=files',
                        filebrowserImageBrowseUrl: '/filemgmt/browse.php?type=images',
                        filebrowserFlashBrowseUrl: '/filemgmt/browse.php?type=flash',
                        enterMode: '1'
                    });
        });

    </script>
@stop
