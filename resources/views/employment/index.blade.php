@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Employment List</h1>
    <a href="{{ route('employment.create') }}" class="btn btn-primary mb-3">Create Employment</a>
    <table id="employment-table" class="table table-bordered">
        <thead>
            <tr>
                <th>Employer Name</th>
                <th>Position</th>
                <th>Occupation</th>
                <th>Manager Name</th>
                <th>Manager Email</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($employments as $employment)
            <tr id="row-{{ $employment->id }}">
                <td>{{ $employment->employer_name }}</td>
                <td>{{ $employment->position }}</td>
                <td>{{ $employment->occupation }}</td>
                <td>{{ $employment->manager_name }}</td>
                <td>{{ $employment->manager_email }}</td>
                <td>
                    <a href="{{ route('employment.edit', $employment->id) }}" class="btn btn-primary btn-sm">Edit</a>
                    <button class="btn btn-danger btn-sm delete-button" data-id="{{ $employment->id }}">Delete</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    $(document).ready(function () {
        // Initialize DataTable
        $('#employment-table').DataTable();

        $(document).on('click', '.delete-button', function () {
            let id = $(this).data('id');
            let url = "{{route('employment.destroy', ':id')}}";
            url = url.replace(':id', id);
                $.ajax({
                    url: url,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (response) {
                            $(`#row-${id}`).remove();
                    },
                });
        });
    });
</script>
@endsection
