@extends('layouts.base')

@section('content')
<div class="container mb-4">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Modifier</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('books.update', $book->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label" for="title"><b>Titre</b></label>
                                    <input class="form-control" type="text" name="title" id="title"
                                        value="{{$book->title}}">
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label" for="author"><b>Auteur (Optional)</b></label>
                                    <input class="form-control" type="text" name="author" id="author"
                                        value="{{$book->author}}">
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label" for="description"><b>Description (Optional)</b></label>
                                    <textarea class="form-control" name="description"
                                        id="description">{{$book->description}}</textarea>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="type" class="form-label">Type</label>
                                    <select class="form-select" id="type" name="type">
                                        @php
                                            $types = ["Roman", "Nouvelle", "Essai", "Biographie", "Manuel scolaire", "Livre de référence", "Livre jeunesse", "Bande dessinée"];
                                        @endphp
                                        @foreach ($types as $type)
                                            <option {{ $type == $book->type ? "selected" : "" }} value="{{$type}}">{{$type}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="category" class="form-label">Categorie</label>
                                    <select class="form-select" id="category" name="category">
                                        @php
                                            $categories = ["Documentaires", "Poésie", "Mangas", "Journaux", "Magazines", "Albums", "Technologie"];
                                        @endphp
                                        @foreach ($categories as $category)
                                            <option {{ $category == $book->category ? "selected" : "" }} value={{$category}}>{{$category}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="editor" class="form-label">Editeur</label>
                                    <input type="text" class="form-control" id="editor" name="editor"
                                        placeholder="Editeur" value="{{ $book->editor }}">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="language" class="form-label">Categorie</label>
                                    <select class="form-select" id="language" name="language">
                                        @php
                                            $languages = ["Français", "Anglais", "Espagnol", "Allemand", "Italien", "Arabe"];
                                        @endphp
                                        @foreach ($languages as $language)
                                            <option {{ $language == $book->language ? "selected" : "" }} value={{$language}}>{{$language}}</option>
                                        @endforeach
                                    </select>
                                    @error('langue')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label" for="price"><b>Prix</b></label>
                                    <input class="form-control" type="text" name="price" id="price"
                                        value="{{$book->price}}">
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label" for="cover"><b>Book Cover (Optional)</b></label>
                                    <input class="form-control" type="file" name="cover" id="author">
                                    <input type="hidden" name="cover-exists"
                                        value="{{ asset('assets/img/book/'. $book->cover) }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 text-center mt-3">
                                <button type="submit" class="btn btn-primary">
                                    Update Book
                                </button>
                                <a href="{{ route('books.index') }}" class="btn btn-secondary">
                                    Cancel
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection