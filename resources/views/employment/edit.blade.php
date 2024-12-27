@extends('layouts.app')
@section('content')
<div class="container py-4">
    <h1 class="mb-4">Edit Employment</h1>
    <form id="employment-form">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Employer Name</label>
                <input type="text" class="form-control" name="employer_name" value="{{$employment->employer_name}}">
                <span class="text-danger error-text employer_name"></span>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Position</label>
                <input type="text" class="form-control" name="position" value="{{$employment->position}}">
                <span class="text-danger error-text position"></span>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Occupation</label>
                <input type="text" class="form-control" name="occupation" value="{{$employment->occupation}}">
                <span class="text-danger error-text occupation"></span>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Manager Name</label>
                <input type="text" class="form-control" name="manager_name" value="{{$employment->manager_name}}">
                <span class="text-danger error-text manager_name"></span>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Manager Email</label>
                <input type="text" class="form-control" name="manager_email" value="{{$employment->manager_email}}">
                <span class="text-danger error-text manager_email"></span>
            </div>
        </div>
        <button type="submit" class="btn btn-success">Save</button>
    </form>

    <script>
        $('#employment-form').on('submit', function (e) {
        e.preventDefault();
        $('.error-text').text('');
        url = "{{ route('employment.update', "$employment->id") }}"
        $.ajax({
            url: url,
            method: "POST",
            data: $(this).serialize(),
            success: function (response) {
                window.location.href = "{{route('employment.index')}}";
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    for (let key in errors) {
                        let errorKey = key.replace(/\./g, '_');
                        $('.error-text.' + errorKey).text(errors[key][0]);
                    }
                }
            }
        });
    });
    </script>
@endsection
