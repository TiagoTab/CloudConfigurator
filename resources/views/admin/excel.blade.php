@extends('layout')
@section('content')
    <link href="{{ URL::asset('css/admin.css') }}" rel="stylesheet" type="text/css">
    <div>
        <h1>Import Excel servers list <span
                class="server-icon">{!! File::get('images/icons/icon_servers.svg') !!}</span></h1>
        <div class="filter-component">
            @error('name')
            <p>{{ $message }}</p>
            @enderror
            @if ($message = Session::get('success'))

                <div class="alert alert-success">
                    <strong>{{ $message }}</strong>
                </div>
                <br>
            @endif
            <form class="option-container" action="{{url("/admin/import")}}" method="post"
                  enctype="multipart/form-data">

                @csrf

                <fieldset>
                    <label>Select File to Upload<small>Excel (.xlsx or .xls) files</small></label>
                    <div class="input-group">
                        <input type="file" required class="form-control" name="uploaded_file"
                               id="uploaded_file">

                        <div class="input-group-append">
                            <button class="admin-submit" type="submit">
                                Upload
                            </button>
                        </div>
                    </div>
                </fieldset>

            </form>

            <hr>
            <form class="option-container" action="{{url("/admin/clear")}}" method="post">
                @csrf
                <fieldset>
                    <div>
                        <label>Delete Servers (Truncate)</label>
                        <small>Warning: This will remove all the servers data</small>
                        <br>

                        <button class="admin-submit" type="submit">Remove All</button>

                    </div>
                </fieldset>
            </form>
        </div>
    </div>

@endsection
