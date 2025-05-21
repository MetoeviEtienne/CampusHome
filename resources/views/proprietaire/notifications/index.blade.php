{{-- @extends('layouts.proprietaire')

@section('title', 'Notifications')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow">
        <h2 class="text-2xl font-semibold mb-4 text-gray-800">Notifications</h2>
        <ul class="text-sm text-gray-700 space-y-3">
            @forelse($notificationsMessages as $notification)
                <li class="flex justify-between items-center p-2 border-b border-gray-100 {{ is_null($notification->read_at) ? 'bg-gray-100 font-semibold' : '' }}">
                    <a href="{{ route('notifications.lire', $notification->id) }}" class="hover:text-blue-600 flex-1">
                        {{ $notification->data['message'] ?? 'Nouvelle notification' }}
                    </a>
                    <span class="text-xs text-gray-500">
                        {{ $notification->created_at->diffForHumans() }}
                    </span>
                </li>
            @empty
                <li class="text-gray-500">Aucune notification pour l’instant.</li>
            @endforelse
        </ul>
    </div>
@endsection --}}
@extends('layouts.proprietaire')

@section('title', 'Notifications')

@section('content')
<div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">Notifications</h2>
        @if($notificationsMessages->count())
            <form action="{{ route('notifications.toutes.lues') }}" method="POST">
                @csrf
                <button type="submit" class="text-sm text-blue-600 hover:underline">Tout marquer comme lu</button>
            </form>
        @endif
    </div>

    <ul class="text-sm text-gray-700 dark:text-gray-300 space-y-3">
        @forelse($notificationsMessages as $notification)
            <li class="flex justify-between items-center p-2 border-b border-gray-200 dark:border-gray-700 {{ is_null($notification->read_at) ? 'bg-gray-100 dark:bg-gray-700 font-semibold' : '' }}">
                <a href="{{ route('notifications.lire', $notification->id) }}" class="hover:text-blue-600 flex-1">
                    {{ $notification->data['message'] ?? 'Nouvelle notification' }}
                </a>
                <span class="text-xs text-gray-500 dark:text-gray-400">
                    {{ $notification->created_at->diffForHumans() }}
                </span>
            </li>
        @empty
            <li class="text-gray-500 dark:text-gray-400">Aucune notification pour l’instant.</li>
        @endforelse
    </ul>
</div>
@endsection
