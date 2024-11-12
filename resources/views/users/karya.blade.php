<x-app-layout>
    <x-slot name="header">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200 text-center">
                        <h3 class="text-2xl font-semibold mb-4">{{ $karya->title }}</h3>

                        <!-- Video Embed -->
                        <div class="relative w-full" style="padding-bottom: 42%;"> <!-- Mengatur rasio 21:9 -->
                            <iframe class="absolute top-0 left-0 w-full h-full rounded-lg" src="{{ $youtube }}"
                                title="YouTube video player" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen>
                            </iframe>
                        </div>

                        <!-- Like and Donate Buttons (Positioned Above Text) -->
                        <div class="mt-6 flex justify-center items-center space-x-4">
                            <!-- Like Button -->
                            <div class="flex items-center">
                                <button
                                    class="flex items-center px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 focus:outline-none">
                                    <i class="fas fa-thumbs-up mr-2"></i> <!-- Like Icon -->
                                    <span>10 Likes</span> <!-- Number of Likes -->
                                </button>
                            </div>

                            <!-- Donate Button -->
                            <div class="flex items-center">
                                <a href="#"
                                    class="flex items-center px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 focus:outline-none">
                                    <i class="fas fa-donate mr-2"></i> <!-- Donate Icon -->
                                    <span>Donate</span>
                                </a>
                            </div>
                        </div>

                        <!-- Description Text (Below the buttons) -->
                        <p class="mt-4 text-gray-600 text-justify text-lg"
                            style="text-align: justify; word-wrap: break-word; overflow-wrap: break-word;">
                            dddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddd
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
</x-app-layout>
