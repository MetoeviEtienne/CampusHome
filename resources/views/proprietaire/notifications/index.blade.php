@extends('layouts.proprietaire')

@section('title', 'Notifications')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-6">
    <div class="bg-white dark:bg-gray-900 rounded-xl shadow-lg p-6">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100 flex items-center gap-2">
                🔔 Notifications
            </h2>
            @if($notificationsMessages->count())
                <form action="{{ route('notifications.toutes.lues') }}" method="POST">
                    @csrf
                    <button type="submit" class="text-sm text-blue-600 dark:text-blue-400 hover:underline">
                        Tout marquer comme lu
                    </button>
                </form>
            @endif
        </div>

        @if($notificationsMessages->isEmpty())
            <div class="text-center py-8 text-gray-500 dark:text-gray-400">
                📭 Aucune notification pour l’instant.
            </div>
        @else
            <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                @foreach($notificationsMessages as $notification)
                    <li class="flex justify-between items-start p-4 rounded-lg transition hover:bg-blue-50 dark:hover:bg-gray-800 {{ is_null($notification->read_at) ? 'bg-gray-50 dark:bg-gray-800 font-medium' : '' }}">
                        <a href="{{ route('notifications.lire', $notification->id) }}" class="flex-1 text-gray-800 dark:text-gray-100 hover:text-blue-600 dark:hover:text-blue-400">
                            {{ $notification->data['message'] ?? 'Nouvelle notification' }}
                        </a>
                        <span class="text-xs text-gray-500 dark:text-gray-400 ml-4 whitespace-nowrap">
                            {{ $notification->created_at->diffForHumans() }}
                        </span>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</div>
@endsection
