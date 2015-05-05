@extends('dashboard')

@section('browser-title')
    Pages
@stop

@section('content')

    <h1>Cleanup Pages</h1>

    <div class="panel panel-default">
        <div class="panel-heading text-center">

        </div>
        <table class="responsive table table-striped table-bordered">
            <thead>
            <tr>
                <th> Page name </th>
            </tr>
            </thead>

            <tbody>
                <tr>
                    <td><a href="/admin/cleanup/marsh">Marsh Creek</a></td>
                </tr>
                <tr>
                    <td><a href="/admin/cleanup/redhead">Redhead</a></td>
                </tr>
            </tbody>
        </table>
    </div>

@stop