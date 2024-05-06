@extends("template.main")
@section('title', 'Contact List')
@section('body')

<div class="container pt-4">
    <h1>Message List</h1>

    @if(count($contacts) > 0)
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Message</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($contacts as $index => $contact)
            <tr>
                <td>{{ $contact['name'] }}</td>
                <td>{{ $contact['email'] }}</td>
                <td>{{ $contact['phone'] }}</td>
                <td>{{ $contact['message'] }}</td>
                <td>
                    <form action="{{ route('delete_contact', $index) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p>No messages found.</p>
    @endif
</div>

@endsection
