@extends('layouts.admin')
@section('content')
    <div class="content">

        @if(session()->has('success'))
    <div class="alert alert-danger" id="dangerid">
        {{ session()->get('success') }}
    </div>
@endif

        <div class="row">
            @foreach ($list_blocks as $block)
                <div class="col-md-6">
                    <h3>{{ $block['title'] }}</h3>
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            {{-- <th>Password</th> --}}
                            <th>Last login at</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($block['entries'] as $entry)
                            <tr>
                                <td>{{ $entry->title }} {{ $entry->name }}</td>
                                <td>{{ $entry->email }}</td>
                                {{-- <td>{{ $entry->password }}</td> --}}
                                <td>{{ $entry->last_login_at }}</td>
                                <td>
                                    <form action="{{ route('myusers.delete', $entry->id) }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button type="submit" onclick="return confirm('Are you sure you want to delete this user?')" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3">{{ __('No entries found') }}</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            @endforeach
        </div>

<script>
setTimeout(function() {
    $('#dangerid').fadeOut('fast');
}, 3000);
</script>

    </div>
@endsection