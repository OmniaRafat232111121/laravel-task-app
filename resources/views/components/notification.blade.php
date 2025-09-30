@props(['type' => 'info', 'message' => '', 'show' => false])

@php
$typeClasses = [
    'success' => 'bg-green-500 text-white',
    'error' => 'bg-red-500 text-white',
    'warning' => 'bg-yellow-500 text-white',
    'info' => 'bg-blue-500 text-white',
];
@endphp

<div x-show="{{ $show }}" 
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0 transform translate-x-full"
     x-transition:enter-end="opacity-100 transform translate-x-0"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100 transform translate-x-0"
     x-transition:leave-end="opacity-0 transform translate-x-full"
     class="fixed top-4 right-4 p-4 rounded-lg shadow-lg z-50 {{ $typeClasses[$type] }} animate-slide-up">
    <div class="flex items-center">
        <div class="flex-1">
            <p class="text-sm font-medium">{{ $message }}</p>
        </div>
        <button @click="$dispatch('close-notification')" 
                class="ml-4 text-white hover:text-gray-200">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>
</div>
