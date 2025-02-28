@extends('layouts.base')
@section('content')
    <div class="container mt-4 mb-4">
        <h3 class="mb-4">Ajouter un livre</h3>
        <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label" for="title">Titre</label>
                        <input class="form-control" type="text" name="title" id="title">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="description">Description (Optional)</label>
                        <textarea class="form-control" name="description" id="description"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="author">Auteur (Optional)</label>
                        <input class="form-control" type="text" name="author" id="author">
                    </div>
                    <div class="mb-3">
                        <label for="type" class="form-label">Type</label>
                        <select class="form-select" id="type" name="type">
                            <option value="Roman">Roman</option>
                            <option value="Nouvelle">Nouvelle</option>
                            <option value="Essai">Essai</option>
                            <option value="Biographie">Biographie</option>
                            <option value="Manuel scolaire">Manuel scolaire</option>
                            <option value="Livre de référence">Livre de référence</option>
                            <option value="Livre jeunesse">Livre jeunesse</option>
                            <option value="Bande dessinée">Bande dessinée</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="category" class="form-label">Categorie</label>
                        <select class="form-select" id="category" name="category">
                            <option value="Documentaires">Documentaires</option>
                            <option value="Poésie">Poésie</option>
                            <option value="Mangas">Mangas</option>
                            <option value="Journaux">Journaux</option>
                            <option value="Magazines">Magazines</option>
                            <option value="Albums">Albums</option>
                            <option value="Technologie">Technologie</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="editor" class="form-label">Editeur</label>
                        <input type="text" class="form-control" id="editor" name="editor" placeholder="Editeur"
                            value="{{ old('editeur') }}">
                    </div>
                    <div class="mb-3">
                        <label for="language" class="form-label">Langue</label>
                        <select class="form-select" id="language" name="language">
                            <option value="Français">Français</option>
                            <option value="Anglais">Anglais</option>
                            <option value="Espagnol">Espagnol</option>
                            <option value="Allemand">Allemand</option>
                            <option value="Italien">Italien</option>
                            <option value="Arabe">Arabe</option>
                            <option value="Portugais">Portugais</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="price">Prix</label>
                        <input class="form-control" type="text" name="price" id="price">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="cover">Book Cover (Optional)</label>
                        <input class="form-control" type="file" name="cover" id="author">
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Ajouter</button>
        </form>
    </div>
@endsection
