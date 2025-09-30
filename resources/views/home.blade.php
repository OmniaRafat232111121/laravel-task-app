@extends('layouts.app')

@section('content')
<div class="hero-section">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center animate-fade-in">
            <h1 class="hero-title" data-translate="welcome">Welcome to the App</h1>
            <p class="hero-description" data-translate="description">
                A modern Laravel application with Tailwind CSS and Alpine.js. 
                Experience beautiful design, responsive layouts, and interactive features.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('users.index') }}" 
                   class="hero-button inline-flex items-center justify-center">
                    <span data-translate="getStarted">Get Started</span>
                    <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                    </svg>
                </a>
                <button onclick="scrollToFeatures()" 
                        class="bg-transparent border-2 border-white text-white hover:bg-white hover:text-blue-600 font-semibold py-3 px-8 rounded-lg text-lg transition-colors duration-200">
                    Learn More
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Features Section -->
<div class="py-20 bg-white dark:bg-gray-900" id="features">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">Features</h2>
            <p class="text-xl text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
                Discover the powerful features that make this application stand out
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Feature 1 -->
            <div class="bg-gray-50 dark:bg-gray-800 p-6 rounded-lg hover:shadow-lg transition-shadow duration-200 animate-slide-up">
                <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900 rounded-lg flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">User Management</h3>
                <p class="text-gray-600 dark:text-gray-300">
                    Complete CRUD operations for user management with bulk actions and keyboard shortcuts.
                </p>
            </div>

            <!-- Feature 2 -->
            <div class="bg-gray-50 dark:bg-gray-800 p-6 rounded-lg hover:shadow-lg transition-shadow duration-200 animate-slide-up">
                <div class="w-12 h-12 bg-green-100 dark:bg-green-900 rounded-lg flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zM21 5a2 2 0 00-2-2h-4a2 2 0 00-2 2v12a4 4 0 004 4h4a2 2 0 002-2V5z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Responsive Design</h3>
                <p class="text-gray-600 dark:text-gray-300">
                    Beautiful, responsive design that works perfectly on all devices and screen sizes.
                </p>
            </div>

            <!-- Feature 3 -->
            <div class="bg-gray-50 dark:bg-gray-800 p-6 rounded-lg hover:shadow-lg transition-shadow duration-200 animate-slide-up">
                <div class="w-12 h-12 bg-purple-100 dark:bg-purple-900 rounded-lg flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l3 3-3 3m5 0h3M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Keyboard Shortcuts</h3>
                <p class="text-gray-600 dark:text-gray-300">
                    Powerful keyboard shortcuts for efficient navigation and user management operations.
                </p>
            </div>

            <!-- Feature 4 -->
            <div class="bg-gray-50 dark:bg-gray-800 p-6 rounded-lg hover:shadow-lg transition-shadow duration-200 animate-slide-up">
                <div class="w-12 h-12 bg-yellow-100 dark:bg-yellow-900 rounded-lg flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Dark Mode</h3>
                <p class="text-gray-600 dark:text-gray-300">
                    Toggle between light and dark themes with persistent preference storage.
                </p>
            </div>

            <!-- Feature 5 -->
            <div class="bg-gray-50 dark:bg-gray-800 p-6 rounded-lg hover:shadow-lg transition-shadow duration-200 animate-slide-up">
                <div class="w-12 h-12 bg-red-100 dark:bg-red-900 rounded-lg flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Multi-language</h3>
                <p class="text-gray-600 dark:text-gray-300">
                    Support for multiple languages with easy switching between English and Spanish.
                </p>
            </div>

            <!-- Feature 6 -->
            <div class="bg-gray-50 dark:bg-gray-800 p-6 rounded-lg hover:shadow-lg transition-shadow duration-200 animate-slide-up">
                <div class="w-12 h-12 bg-indigo-100 dark:bg-indigo-900 rounded-lg flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Fast & Modern</h3>
                <p class="text-gray-600 dark:text-gray-300">
                    Built with modern technologies: Laravel, Tailwind CSS, Alpine.js, and Vite.
                </p>
            </div>
        </div>
    </div>
</div>

<!-- Stats Section -->
<div class="py-20 bg-gray-50 dark:bg-gray-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
            <div class="animate-slide-up">
                <div class="text-4xl font-bold text-blue-600 dark:text-blue-400 mb-2">100%</div>
                <div class="text-gray-600 dark:text-gray-300">Responsive</div>
            </div>
            <div class="animate-slide-up">
                <div class="text-4xl font-bold text-green-600 dark:text-green-400 mb-2">2</div>
                <div class="text-gray-600 dark:text-gray-300">Languages</div>
            </div>
            <div class="animate-slide-up">
                <div class="text-4xl font-bold text-purple-600 dark:text-purple-400 mb-2">∞</div>
                <div class="text-gray-600 dark:text-gray-300">Possibilities</div>
            </div>
        </div>
    </div>
</div>

<script>
function scrollToFeatures() {
    document.getElementById('features').scrollIntoView({ 
        behavior: 'smooth' 
    });
}
</script>
@endsection
