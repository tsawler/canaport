@extends('dashboard')

@section('content')

    <div class="container">

        <div id="editmsg" class='alert alert-success hidden'>
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <span id="theeditmsg">&nbsp;</span>
        </div>

        <h1>Edit Cleanup Page</h1>

        @if(count($errors) > 0)
            <div class="alert alert-error">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{ Form::model($page, array(
                                'role' => 'form',
                                'name' => 'bookform', 'id' => 'bookform',
                                'enctype' => 'multipart/form-data',
                                'url' => array('admin/cleanup/marsh', $page->id)
                                )
                   )
        }}

        <div class="form-group">
            {{ Form::label('page_name', 'Page title', array('class' => 'control-label')); }}
            <div class="controls">
                <div class="input-group">
                    <span class="input-group-addon">A</span>
                    {{ Form::text('title', null, array('class' => 'required form-control',
                                                        'style' => 'max-width: 400px;',
                                                        'placeholder' => 'Page title',
                                                        'autofocus'=>'autofocus')); }}
                </div>
            </div>
        </div>

        @if($page->image)
            <img src="/img/{{ $page->image }}" class="img img-responsive" style="max-width: 350px">
        @else
            No image yet
        @endif

        <div class="form-group">
            {{ Form::label('image', 'Page Image', array('class' => 'control-label')); }}
            <div class="controls">
                <div class="input-group">
                    <span class="input-group-addon">A</span>
                    {{ Form::file('image',array('class' => 'btn btn-info','title' => 'Browse for new image')) }}
                </div>
            </div>
        </div>


        <div class="form-group">
            {{ Form::label('above', 'Page Content (above form)', array('class' => 'control-label')); }}
            <div class="controls" style='max-width: 650px;'>
                {{ Form::textarea('above', null, array('style' => 'max-width: 400px;') ); }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('below', 'Page Content (below form)', array('class' => 'control-label')); }}
            <div class="controls" style='max-width: 650px;'>
                {{ Form::textarea('below', null, array('style' => 'max-width: 400px;') ); }}
            </div>
        </div>

        <hr>
        <div class="form-group">
            <div class="controls">
                {{ Form::submit('Save', array('class' => 'btn-normal btn-color submit')) }}
            </div>
        </div>
        <div>&nbsp;</div>

        {{ Form::hidden('id', $page->id) }}

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

            CKEDITOR.replace('above',
                    {
                        toolbar: 'MyToolbar',
                        forcePasteAsPlainText: true,
                        filebrowserBrowseUrl: '/filemgmt/browse.php?type=files',
                        filebrowserImageBrowseUrl: '/filemgmt/browse.php?type=images',
                        filebrowserFlashBrowseUrl: '/filemgmt/browse.php?type=flash',
                        enterMode: '1'
                    });

            CKEDITOR.replace('below',
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
