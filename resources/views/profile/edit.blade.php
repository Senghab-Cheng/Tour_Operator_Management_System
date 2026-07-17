@extends('layouts.front')

@section('title', 'Profile')

@section('content')
    <div class="container py-5">
        <h2 class="mb-4">Profile</h2>

        <div class="row g-4">
            <div class="col-md-6">
                <div class="card p-4 mb-4">
                    @include('profile.partials.update-profile-information-form')
                </div>
                <div class="card p-4 mb-4">
                    @include('profile.partials.update-password-form')
                </div>
                <div class="card p-4">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
@endsection
