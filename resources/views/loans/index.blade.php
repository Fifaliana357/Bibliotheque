@extends('layouts.app')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Emprunts</h1>
        <a href="{{ route('loans.create') }}"
           class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition flex items-center gap-2">
            <x-icon name="plus" class="w-4 h-4" />
            Nouvel emprunt
        </a>
    </div>

    <div class="space-y-3">
        @forelse ($loans as $loan)
            <div class="bg-white p-4 rounded-lg shadow flex justify-between items-center">
                <div>
                    <p class="font-semibold text-gray-800">{{ $loan->book->title }}</p>
                    <p class="text-sm text-gray-500">
                        Emprunté par {{ $loan->user->name }} le {{ $loan->borrowed_at }}
                    </p>
                    @if ($loan->returned_at)
                        <span class="text-xs bg-green-100 text-green-700 px-2 py-1 rounded-full">
                            Rendu le {{ $loan->returned_at }}
                        </span>
                    @else
                        <span class="text-xs bg-orange-100 text-orange-700 px-2 py-1 rounded-full">
                            En cours
                        </span>
                    @endif
                </div>
                <div class="flex gap-2">
                    @unless ($loan->returned_at)
                        <form action="{{ route('loans.return', $loan) }}" method="POST">
                            @csrf
                            <button type="submit" title="Marquer comme rendu"
                                    class="p-2 rounded-lg text-gray-500 hover:bg-green-50 hover:text-green-600 transition">
                                <x-icon name="check" class="w-4 h-4" />
                            </button>
                        </form>
                    @endunless
                    <form action="{{ route('loans.destroy', $loan) }}" method="POST"
                          onsubmit="return confirm('Supprimer cet emprunt ?');">
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
                <x-icon name="clipboard" class="w-12 h-12 mx-auto mb-2" />
                <p>Aucun emprunt trouvé.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $loans->links() }}
    </div>
@endsection
