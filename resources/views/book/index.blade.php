@extends('layouts.base')

@section('content')
    <!-- Hero Section -->
    <div class="bg-dark text-white py-5 mb-5">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h1>Liste des livres</h1>
                </div>
            </div>
        </div>
    </div>
    <!-- Main Content -->
    <div class="container py-5">
        <div class="row">
            <!-- Filters Sidebar -->
            <div class="col-md-3">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Filtrer les livres</h5>

                        <!-- Categories -->
                        <div class="mb-4">
                            <h6>Categories</h6>
                            <form id="filtering-form" action="{{ route('books.index') }}" method="GET">
                                @foreach(request()->query() as $key => $value)
                                    @if($key !== 'category')
                                        @if(is_array($value))
                                            @foreach($value as $item)
                                                <input type="hidden" name="{{ $key }}[]" value="{{ $item }}">
                                            @endforeach
                                        @else
                                            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                                        @endif
                                    @endif
                                @endforeach
                                <select class="form-select" id="category" name="category">
                                    @php
                                        $categoriesArr = ["Documentaires", "Poésie", "Mangas", "Journaux", "Magazines", "Albums", "Technologie"];
                                    @endphp
                                    <option value="" selected>Tous</option>
                                    @foreach ($categoriesArr as $value)
                                        <option value="{{$value}}" {{ request("category") == $value ? "selected" : "" }} >{{ ucfirst($value) }}</option>
                                    @endforeach
                                </select>
                            </form>
                        </div>
                        <script>
                            const category = document.querySelector("#category");
                            category.addEventListener("change", (e) => {
                                document.querySelector("#filtering-form").submit();
                            })
                        </script>

                        <!-- Type -->
                        <div class="mb-4">
                            <h6>Type</h6>
                            <form action="{{ route('books.index')}}" method="GET">
                                @foreach(request()->query() as $key => $value)
                                    @if($key !== 'type')
                                        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                                    @endif
                                @endforeach
                                <div class="form-check">
                                    <input class="form-check-input" name="type[]" value="Roman" type="checkbox" id="Roman" {{ is_array(request('type')) && in_array('Roman', request('type')) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="Roman">Roman</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="type[]" value="Nouvelle" type="checkbox" id="Nouvelle" {{ is_array(request('type')) && in_array('Nouvelle', request('type')) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="Nouvelle">Nouvelle</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="type[]" value="Essai" type="checkbox" id="Essai" {{ is_array(request('type')) && in_array('Essai', request('type')) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="Essai">Essai</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="type[]" value="Biographie" type="checkbox" id="Biographie" {{ is_array(request('type')) && in_array('Biographie', request('type')) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="Biographie">Biographie</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="type[]" value="Manuel scolaire" type="checkbox" id="Manuel_scolaire" {{ is_array(request('type')) && in_array('Manuel scolaire', request('type')) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="Manuel_scolaire">Manuel scolaire</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="type[]" value="Livre de référence" type="checkbox" id="Livre_de_reference" {{ is_array(request('type')) && in_array('Livre de référence', request('type')) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="Livre_de_reference">Livre de référence</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="type[]" value="Livre jeunesse" type="checkbox" id="Livre_jeunesse" {{ is_array(request('type')) && in_array('Livre jeunesse', request('type')) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="Livre_jeunesse">Livre jeunesse</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="type[]" value="Bande dessinée" type="checkbox" id="Bande_dessinee" {{ is_array(request('type')) && in_array('Bande dessinée', request('type')) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="Bande_dessinee">Bande dessinée</label>
                                </div>
                            </form>
                            <script>
                                const types = document.querySelectorAll("input[name='type[]']");
                                types.forEach(type => {
                                    type.addEventListener("change", function (e) {
                                        e.target.parentElement.parentElement.submit();
                                    })
                                });
                            </script>
                        </div>

                        <!-- Price Range -->
                        <div class="mb-4">
                            <h6>Filtrer par prix</h6>
                            <form action="{{ route("books.index") }}">
                                @foreach(request()->query() as $key => $value)
                                    @if($key !== 'min' && $key !== "max")
                                        @if(is_array($value))
                                            @foreach($value as $item)
                                                <input type="hidden" name="{{ $key }}[]" value="{{ $item }}">
                                            @endforeach
                                        @else
                                            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                                        @endif
                                    @endif
                                @endforeach
                                <div class="d-flex gap-2">
                                    <div class="flex-grow-1">
                                        <input name="min" value="{{ request('min') }}" type="number" class="form-control pricing" id="min-price" placeholder="Min" min="0">
                                    </div>
                                    <div class="flex-grow-1">
                                        <input name="max" value="{{ request('max') }}" type="number" class="form-control pricing" id="max-price" placeholder="Max" min="0">
                                    </div>
                                </div>
                            </form>
                            <script>
                                const pricingInputs = document.querySelectorAll(".pricing");
                                pricingInputs.forEach(input => {
                                    input.addEventListener("blur", function (e) {
                                        this.closest("form").submit();
                                    })
                                })
                            </script>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Book Listings -->
            <div class="col-md-9">
                <!-- Add Book Button -->
                <div class="d-flex justify-content-end mb-4">
                    <a href="{{ route('books.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-lg"></i> Ajouter un livre
                    </a>
                </div>

                <!-- Sort Controls -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <span>{{ trans_choice('books.count', $count, ["count" => $count]) }}</span>
                    <form action="{{ route("books.index")}}" method="GET">
                        @foreach(request()->query() as $key => $value)
                            @if($key !== 'order')
                                @if(is_array($value))
                                    @foreach($value as $item)
                                        <input type="hidden" name="{{ $key }}[]" value="{{ $item }}">
                                    @endforeach
                                @else
                                    <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                                @endif
                            @endif
                        @endforeach
                        <select id="order" name="order" class="form-select w-auto">
                            @php
                                $filteringArr = ["price", "title", "author"];
                            @endphp
                            <option value="" selected>Trier Par</option>
                            @foreach ($filteringArr as $value)
                                <option value="{{$value}}" {{ request("order") == $value ? "selected" : "" }} >{{ ucfirst($value) }}</option>
                            @endforeach
                        </select>
                    </form>
                </div>
                <script>
                    const orderForm = document.querySelector("#order");
                    orderForm.addEventListener("change", (e) => {
                        e.target.parentElement.submit();
                    })
                </script>
                <!-- Book Cards -->
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                    @foreach ($books as $book)
                        <!-- Book Card -->
                        <div class="col">
                            <div class="card h-100">
                                <img height="150" src="{{ asset('assets/img/book/') . '/' . $book->cover }}" class="card-img-top"
                                    alt="Book cover">
                                <div class="card-body">
                                    <h5 class="card-title">{{ strlen($book->title) <= 20 ? substr($book->title, 0, 20) : substr($book->title, 0, 20) . '...' }}</h5>
                                    <p class="card-text">
                                        <span class="badge bg-primary">Tech</span>
                                        <span class="badge bg-secondary">CSS</span>
                                        <span class="badge bg-secondary">HTML</span>
                                    </p>
                                    <p class="card-text">{{ $book->author }}</p>
                                    <div class="d-flex flex-column gap-2">
                                        <div class="btn-group btn-group-sm">
                                            <a href="{{ route('books.show', $book->id) }}"
                                                class="btn btn-primary">Détails</a>
                                            <a href="{{ route('books.edit', $book->id) }}"
                                                class="btn btn-secondary">Modifier</a>
                                            <form action="{{ route('books.destroy', $book->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                                            </form>
                                        </div>
                                        <span class="text-end fw-bold">{{ number_format($book->price, 2) }} DH</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <!-- Pagination -->
                <div class="mt-5">
                    {{ $books->appends(request()->query())->links("pagination::bootstrap-5") }}
                </div>
            </div>
        </div>
    </div>
@endsection