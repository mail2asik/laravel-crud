@extends('layout')

@section('content')

<div class="card mt-5">
    <h2 class="card-header">Edit Contact</h2>
    <div class="card-body">

        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <a class="btn btn-primary btn-sm" href="{{ route('contacts.index') }}"><i class="fa fa-arrow-left"></i> Back</a>
        </div>

        <form action="{{ route('contacts.update',$contact->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="inputTitle" class="form-label"><strong>Name:</strong></label>
                <input 
                    type="text" 
                    Title="Name" 
                    value="{{ $contact->name }}"
                    class="form-control @error('name') is-invalid @enderror" 
                    placeholder="Name">
                @error('name')
                    <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="inputcontent" class="form-label"><strong>Phone Number:</strong></label>
                <input 
                    type="text" 
                    Title="Phone Number" 
                    value="{{ $contact->phone_number }}"
                    class="form-control @error('phone_number') is-invalid @enderror" 
                    placeholder="Phone Number">
                @error('name')
                    <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-disk"></i> Update</button>
        </form>

    </div>
</div>
@endsection