@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Profile') }}</div>

                <div class="card-body">
                    <div class="row details">
                        <div class="col-md-6">
                            @if($user->profile_picture)
                                <img src="{{ asset('storage/' . $user->profile_picture) }}"
                                alt="Profile Image"
                                class="img-fluid rounded-circle"
                                style="width: 50px; height: 50px;"></p>
                                <a target="__blank" href="{{ asset('storage/' . $user->profile_picture) }}" class=" mb-3 btn btn-sm btn-primary">View Profile Picture</a>
                            @endif
                            <p><strong>Name: </strong> <span id="name">{{$user->name}}</span>
                            <p><strong>Email: </strong> <span id="email">{{$user->email}}</span></p>
                            <p><strong>Phone: </strong> <span id="phone">{{$user->phone}}</span></p>
                            <p><strong>Skills: </strong> <span id="skills">{{$user->skills}}</span></p>
                        </div>
                        <div class="col-md-6 text-end">
                            <a class="btn btn-secondary" id="edit">Edit</a>
                        </div>
                    </div>
                    <form id="profileForm" class="d-none">
                        @csrf
                        @method('PUT')
                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="name" value="{{$user->name}}">
                                <span class="text-danger error-text name"></span>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input type="email" class="form-control" name="email" value="{{$user->email}}">
                                <span class="text-danger error-text email"></span>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end">{{ __('Phone') }}</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="phone" value="{{$user->phone}}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end">{{ __('Skills') }}</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="skills" value="{{$user->skills}}">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="save" class="btn btn-primary">
                                    {{ __('Save') }}
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('#edit').click(function(){
        $('.details').addClass('d-none');
        $('#profileForm').removeClass('d-none');
    })

    $('#profileForm').on('submit', function (e) {
        e.preventDefault();
        $('.error-text').text('');
        var userId = "{{$user->id}}"
        url = "{{ route('profile.update', ':id') }}"
        url = url.replace(':id', userId);
        $.ajax({
            url: url,
            method: "POST",
            data: $(this).serialize(),
            success: function (response) {
                console.log(response.user);

                $('#name').text(response.user.name);
                $('#email').text(response.user.email);
                $('#phone').text(response.user.phone);
                $('#skills').text(response.user.skills);
                $('.details').removeClass('d-none');
                $('#profileForm').addClass('d-none');
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
