@extends('layouts.app')

@section('content')
    <div class="mb-8 flex flex-col gap-5 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <p class="mb-2 text-xs font-semibold uppercase tracking-[0.14em] text-emerald-700">Votre collection</p>
            <h1 class="text-3xl font-bold text-gray-800">Tableau de bord</h1>
            <p class="mt-2 text-sm text-gray-500">La vie de votre bibliothèque, en un regard.</p>
        </div>
        <a href="{{ route('books.index') }}"
           class="inline-flex items-center justify-center gap-2 rounded-lg bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
            <x-icon name="book" class="h-4 w-4" />
            Parcourir les livres
        </a>
    </div>

    <div class="mb-8 grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">
        <div class="animate-fade-in flex items-center gap-4 rounded-lg bg-white p-5 shadow">
            <div class="rounded-lg bg-indigo-50 p-3 text-indigo-600">
                <x-icon name="book" class="h-6 w-6" />
            </div>
            <div>
                <p class="text-3xl font-bold tabular-nums text-gray-800">{{ $stats['books'] }}</p>
                <p class="mt-1 text-sm text-gray-500">Livres au catalogue</p>
            </div>
        </div>

        <div class="animate-fade-in flex items-center gap-4 rounded-lg bg-white p-5 shadow">
            <div class="rounded-lg bg-sky-50 p-3 text-sky-700">
                <x-icon name="user" class="h-6 w-6" />
            </div>
            <div>
                <p class="text-3xl font-bold tabular-nums text-gray-800">{{ $stats['authors'] }}</p>
                <p class="mt-1 text-sm text-gray-500">Auteurs référencés</p>
            </div>
        </div>

        <div class="animate-fade-in flex items-center gap-4 rounded-lg bg-white p-5 shadow">
            <div class="rounded-lg bg-orange-50 p-3 text-orange-600">
                <x-icon name="clipboard" class="h-6 w-6" />
            </div>
            <div>
                <p class="text-3xl font-bold tabular-nums text-gray-800">{{ $stats['loansActive'] }}</p>
                <p class="mt-1 text-sm text-gray-500">Emprunts en cours</p>
            </div>
        </div>

        <div class="animate-fade-in flex items-center gap-4 rounded-lg bg-white p-5 shadow">
            <div class="rounded-lg bg-red-50 p-3 text-red-600">
                <x-icon name="x-circle" class="h-6 w-6" />
            </div>
            <div>
                <p class="text-3xl font-bold tabular-nums text-gray-800">{{ $stats['loansOverdue'] }}</p>
                <p class="mt-1 text-sm text-gray-500">Emprunts en retard</p>
            </div>
        </div>
    </div>

    <section class="overflow-hidden rounded-lg bg-white shadow">
        <div class="flex items-center justify-between border-b border-gray-100 px-5 py-4">
            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.12em] text-gray-400">Activité</p>
                <h2 class="mt-1 text-lg font-semibold text-gray-800">Emprunts récents</h2>
            </div>
            <a href="{{ route('loans.index') }}" class="text-sm font-semibold text-indigo-700 transition hover:text-indigo-900">
                Tous les emprunts <span aria-hidden="true">&rarr;</span>
            </a>
        </div>
        <div class="divide-y divide-gray-100">
            @forelse ($recentLoans as $loan)
                <div class="flex items-center justify-between gap-4 px-5 py-4">
                    <div class="flex min-w-0 items-center gap-3">
                        <span class="hidden h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-gray-50 text-gray-500 sm:flex">
                            <x-icon name="book" class="h-5 w-5" />
                        </span>
                        <div class="min-w-0">
                            <p class="truncate font-medium text-gray-800">{{ $loan->book->title }}</p>
                            <p class="mt-1 text-sm text-gray-500">{{ $loan->user->name }} <span class="px-1">·</span> {{ $loan->borrowed_at }}</p>
                        </div>
                    </div>
                    @if ($loan->returned_at)
                        <span class="shrink-0 rounded-full bg-green-100 px-2.5 py-1 text-xs font-medium text-green-700">Rendu</span>
                    @else
                        <span class="shrink-0 rounded-full bg-orange-100 px-2.5 py-1 text-xs font-medium text-orange-700">En cours</span>
                    @endif
                </div>
            @empty
                <div class="px-5 py-12 text-center">
                    <span class="mx-auto mb-3 flex h-11 w-11 items-center justify-center rounded-lg bg-gray-50 text-gray-400">
                        <x-icon name="clipboard" class="h-5 w-5" />
                    </span>
                    <p class="font-medium text-gray-700">Aucun emprunt pour le moment.</p>
                    <p class="mt-1 text-sm text-gray-500">Les nouveaux mouvements apparaîtront ici.</p>
                </div>
            @endforelse
        </div>
    </section>
@endsection
