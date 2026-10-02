@extends('layouts.app')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Catégories</h1>
        <a href="{{ route('categories.create') }}"
           class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition flex items-center gap-2">
            <x-icon name="plus" class="w-4 h-4" />
            Ajouter une catégorie
        </a>
    </div>

    <div class="space-y-2">
        @forelse ($categories as $category)
            <div class="bg-white p-3 rounded-lg shadow flex justify-between items-center">
                <span class="text-gray-800">{{ $category->name }}</span>
                <div class="flex gap-2">
                    <a href="{{ route('categories.edit', $category) }}" title="Modifier"
                       class="p-2 rounded-lg text-gray-500 hover:bg-indigo-50 hover:text-indigo-600 transition">
                        <x-icon name="pencil" class="w-4 h-4" />
                    </a>
                    <form action="{{ route('categories.destroy', $category) }}" method="POST"
                          onsubmit="return confirm('Supprimer cette catégorie ?');">
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
                <x-icon name="tag" class="w-12 h-12 mx-auto mb-2" />
                <p>Aucune catégorie trouvée.</p>
            </div>
        @endforelse
    </div>
@endsection
