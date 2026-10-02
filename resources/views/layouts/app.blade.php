<!DOCTYPE html>
<html lang="fr" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#193f33">
    <title>Ma Bibliothèque — Gestion de collection</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gray-50 font-sans antialiased">

    <header class="app-mobile-header md:hidden flex items-center justify-between px-4 py-3">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-3 text-gray-800">
            <span class="app-brand-mark flex h-9 w-9 items-center justify-center rounded-lg">
                <x-icon name="book" class="h-5 w-5" />
            </span>
            <span class="text-base font-semibold">Ma Bibliothèque</span>
        </a>
        <button id="menu-toggle" type="button" aria-label="Ouvrir le menu" aria-controls="sidebar" aria-expanded="false"
                class="rounded-lg p-2 text-gray-600 transition hover:bg-gray-100">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>
        </button>
    </header>

    <div id="overlay" aria-hidden="true" class="fixed inset-0 z-20 hidden bg-gray-900/40 md:hidden"></div>

    <div class="min-h-screen md:flex">
        <aside id="sidebar"
               class="app-sidebar fixed inset-y-0 left-0 z-30 flex min-h-screen w-72 -translate-x-full flex-col text-white transition-transform duration-200 md:sticky md:top-0 md:translate-x-0">

            <div class="hidden border-b border-white/10 px-6 py-6 md:block">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 text-white">
                    <span class="app-brand-mark flex h-10 w-10 items-center justify-center rounded-lg">
                        <x-icon name="book" class="h-5 w-5" />
                    </span>
                    <span>
                        <span class="block text-base font-semibold">Ma Bibliothèque</span>
                        <span class="mt-0.5 block text-xs text-emerald-100/70">Gestion de collection</span>
                    </span>
                </a>
            </div>

            <nav aria-label="Navigation principale" class="mt-4 flex-1 space-y-1 px-3 py-4 md:mt-0">
                <p class="px-3 pb-2 text-[10px] font-semibold uppercase tracking-[0.16em] text-emerald-100/55">Votre espace</p>
                @php
                    $links = [
                        ['route' => 'dashboard', 'prefix' => 'dashboard', 'label' => 'Tableau de bord', 'icon' => 'chart'],
                        ['route' => 'authors.index', 'prefix' => 'authors.*', 'label' => 'Auteurs', 'icon' => 'user'],
                        ['route' => 'categories.index', 'prefix' => 'categories.*', 'label' => 'Catégories', 'icon' => 'tag'],
                        ['route' => 'books.index', 'prefix' => 'books.*', 'label' => 'Livres', 'icon' => 'book'],
                        ['route' => 'loans.index', 'prefix' => 'loans.*', 'label' => 'Emprunts', 'icon' => 'clipboard'],
                    ];
                @endphp

                @foreach ($links as $link)
                    @php $active = request()->routeIs($link['prefix']); @endphp
                    <a href="{{ route($link['route']) }}"
                          class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition
                              {{ $active ? 'bg-lime-100 text-emerald-950 shadow-sm' : 'text-emerald-50/80 hover:bg-white/10 hover:text-white' }}">
                        <x-icon :name="$link['icon']" class="w-5 h-5" />
                        {{ $link['label'] }}
                    </a>
                @endforeach
            </nav>

            <div class="border-t border-white/10 px-6 py-4 text-xs text-emerald-100/65">
                Ma Bibliothèque <span class="px-1">·</span> {{ date('Y') }}
            </div>
        </aside>

        <main class="app-main min-w-0 flex-1 px-4 py-6 md:px-8 md:py-8">
            <div class="mx-auto mb-7 flex max-w-screen-2xl items-center justify-between border-b border-gray-200/80 pb-4">
                <p class="text-xs font-semibold uppercase tracking-[0.12em] text-gray-500">Espace de gestion</p>
                <time datetime="{{ now()->toDateString() }}" class="text-xs font-medium tabular-nums text-gray-500">
                    {{ now()->format('d.m.Y') }}
                </time>
            </div>
            <div class="mx-auto max-w-screen-2xl">
                @yield('content')
            </div>
        </main>
    </div>

</body>
</html>
