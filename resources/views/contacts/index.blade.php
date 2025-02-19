@extends('layout')

@section('content')

<div class="card mt-5">
    <h2 class="card-header">Contacts</h2>
    <div class="card-body">
        
        @if(session('success'))
            <div class="alert alert-success" role="alert">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger" role="alert">{{ session('error') }}</div>
        @endif

        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <a class="btn btn-warning btn-sm" href="{{ route('contacts.xmlBulkCreate') }}"><i class="fa fa-plus"></i> Import Contacts</a>
            <a class="btn btn-success btn-sm" href="{{ route('contacts.create') }}"><i class="fa fa-plus"></i> Create New Contact</a>
        </div>

        <table class="table table-bordered table-striped mt-4">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Phone Number</th>
                    <th width="250px">Action</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($contacts as $contact)
                    <tr>
                        <td>{{ $contact->name }}</td>
                        <td>{{ $contact->phone_number }}</td>
                        <td>
                            <form action="{{ route('contacts.destroy',$contact->uid) }}" method="GET">
                                <a class="btn btn-info btn-sm" href="{{ route('contacts.show',$contact->uid) }}"><i class="fa-solid fa-list"></i> Show</a>
                                <a class="btn btn-primary btn-sm" href="{{ route('contacts.edit',$contact->uid) }}"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i> Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">There are no data.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        
        {!! $contacts->links() !!}

    </div>
</div>  

@endsection