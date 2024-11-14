<x-perfect-scrollbar as="nav" aria-label="main" class="flex flex-col flex-1 gap-4 px-3">

    <x-sidebar.link title="Dashboard" href="{{ url(auth()->user()->role . '/dashboard') }}" :isActive="url(auth()->user()->role . '/dashboard')">
        <x-slot name="icon">
            <x-icons.dashboard class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>
    </x-sidebar.link>




    @if (auth()->user()->role == 'supervisor')
        <x-sidebar.link title="User" href="{{ route('user.index') }}">
            <x-slot name="icon">
                <x-heroicon-o-user class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
            </x-slot>
        </x-sidebar.link>
    @elseif (auth()->user()->role == 'users')
        <x-sidebar.link title="Transaction" href="{{ route('users.transaction') }}">
            <x-slot name="icon">
                <x-heroicon-o-user class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
            </x-slot>
        </x-sidebar.link>
    @endif






</x-perfect-scrollbar>
