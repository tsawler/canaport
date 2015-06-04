@extends('dashboard')

@section('browser-title')
    Bios
@stop

@section('content')
    <h1>Manage Bios</h1>

    <table class="responsive table table-striped table-bordered">
        <thead>
        <tr>
            <th> Bio </th>
        </tr>
        </thead>

        <tbody>
        @foreach ($allbios as $bio)
            <tr>
                <td><a href="/admin/editbio/{{ $bio->id }}">{{ $bio->bio_name }}</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
@stop