@extends('layout')

@section('content')

<div class="card mt-5">
    <h2 class="card-header">Import Contacts</h2>
    <div class="card-body">

        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <a class="btn btn-primary btn-sm" href="{{ route('contacts.index') }}"><i class="fa fa-arrow-left"></i> Back</a>
        </div>

        <form action="{{ route('contacts.xmlBulkStore') }}" enctype="multipart/form-data" method="POST">
            @csrf

            <div class="mb-3">
                <label for="inputName" class="form-label"><strong>Upload File:</strong></label>
                <input 
                    type="file" 
                    name="file" 
                    class="form-control @error('name') is-invalid @enderror" 
                    id="inputName" 
                    placeholder="Select File">
                @error('file')
                    <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-disk"></i> Submit</button> &nbsp; <a href="/static/contacts.xml"> Sample Format </a>
        </form>

    </div>
</div>
@endsection