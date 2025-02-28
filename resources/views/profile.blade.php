@extends('layouts.base')

@section('content')
@section('content')
<div class="container py-5">
    <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalToggleLabel">Update your profile</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('profile.update', Auth::user()->id) }}" method="POST">
                    @csrf
                    @method("PUT")
                    <div class="modal-body">
                        <div class="from-group">
                            <label for="nom" class="form-label">Nom</label>
                            <input type="text" id="nom" name="nom" class="form-control" value="{{ Auth::user()->nom }}">
                        </div>
                        <div class="from-group">
                            <label for="prenom" class="form-label">Prénom</label>
                            <input type="text" id="prenom" name="prenom" class="form-control" value="{{ Auth::user()->prenom }}">
                        </div>
                        <div class="from-group">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" id="email" name="email" class="form-control" value="{{ Auth::user()->email }}">
                        </div>
                        <div class="from-group">
                            <label for="password" class="form-label">Password</label>
                            <input type="text" id="password" name="password" class="form-control">
                        </div>
                        <hr>
                        <button class="btn btn-success"  data-bs-toggle="modal">Confirm Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <button class="btn btn-primary mb-2" data-bs-target="#exampleModalToggle" data-bs-toggle="modal">Update Profile</button>
    {{-- --}}
    <div class="row">
        <div class="col-lg-4">
            <div class="card mb-4">
                <div class="card-body text-center">
                    <h5 class="my-3">{{ Auth::user()->nom }}</h5>
                    <p class="text-muted mb-1">Web Developer</p>
                    <p class="text-muted mb-4">San Francisco, CA</p>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Nom et prénom</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0">{{ Auth::user()->nom . ' ' . Auth::user()->prenom }}</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Email</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0">{{ Auth::user()->email }}</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Membre depuis</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0">{{ Auth::user()->created_at->format('M d, Y') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection