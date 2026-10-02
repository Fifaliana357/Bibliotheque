@extends('layouts.app')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Livres</h1>
        <a href="{{ route('books.create') }}"
           class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition flex items-center gap-2">
            <x-icon name="plus" class="w-4 h-4" />
            Ajouter un livre
        </a>
    </div>

    <form method="GET" action="{{ route('books.index') }}" class="bg-white p-4 rounded-lg shadow mb-6 flex gap-3">
        <div class="relative flex-1">
            <x-icon name="search" class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2 text-gray-400" />
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Rechercher un titre..."
                   oninput="clearTimeout(window.searchTimer); window.searchTimer = setTimeout(() => this.form.submit(), 500);"
                   class="w-full border border-gray-300 rounded-lg pl-10 pr-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
        </div>

        <select name="category" onchange="this.form.submit();"
                class="border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
            <option value="">Toutes catégories</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>

        @if (request('search') || request('category'))
            <a href="{{ route('books.index') }}"
               class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300 transition flex items-center gap-2">
                <x-icon name="x-circle" class="w-4 h-4" />
                Réinitialiser
            </a>
        @endif
    </form>

    <div class="space-y-4">
        @forelse ($books as $book)
            <div class="bg-white p-4 rounded-lg shadow flex justify-between items-start">
                <div>
                    <h2 class="font-semibold text-lg text-gray-800">{{ $book->title }} ({{ $book->year }})</h2>
                    <p class="text-sm text-gray-500">par {{ $book->author->name }}</p>
                    <p class="text-gray-600">{{ $book->summary }}</p>
                    <div class="flex gap-1 mt-2">
                        @foreach ($book->categories as $category)
                            <span class="text-xs bg-indigo-100 text-indigo-700 px-2 py-1 rounded-full">{{ $category->name }}</span>
                        @endforeach
                    </div>
                    <p class="text-sm text-gray-500 mt-1">Stock : {{ $book->stock }}</p>
                </div>
                <div class="flex gap-2 shrink-0 ml-4">
                    <a href="{{ route('books.edit', $book) }}" title="Modifier"
                       class="p-2 rounded-lg text-gray-500 hover:bg-indigo-50 hover:text-indigo-600 transition">
                        <x-icon name="pencil" class="w-4 h-4" />
                    </a>
                    <form action="{{ route('books.destroy', $book) }}" method="POST"
                          onsubmit="return confirm('Supprimer ce livre ?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" title="Supprimer"
                                class="p-2 rounded-lg text-gray-500 hover:bg-red-50 hover:text-red-600 transition">
                            <x-icon name="trash" class="w-4 h-4" />
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div class="text-center py-12 text-gray-400">
                <x-icon name="book" class="w-12 h-12 mx-auto mb-2" />
                <p>Aucun livre trouvé.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $books->links() }}
    </div>
@endsection
