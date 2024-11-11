<x-guest-layout>
    <!-- Container -->
    <div class="container mx-auto my-8 px-4 h-full">
        <!-- Header Section -->
        <div class="text-center p-8 rounded-lg shadow-md mx-4" style="background-image: url('https://img.freepik.com/free-vector/gradient-abstract-geometric-background_23-2149120169.jpg?t=st=1731344322~exp=1731347922~hmac=a22344c2b9a3910c48e9387398a3e69aec83544bbccebad125ed38df67854ee0&w=1380'); background-size: cover; background-position: center;">
            <h1 class="text-5xl font-bold text-white dark:text-white">Culture Day</h1>
            <h2 class="text-xl font-bold text-white dark:text-white mt-2">PT Dharma Polimetal Tbk</h2>
            <p class="text-xl font-bold text-white dark:text-white mt-2 mb-10">2024</p>
            <p class="text-sm font-bold text-white dark:text-white mt-18">Support By:</p>
            <div class="flex justify-center space-x-4 mt-5">
                <img src="path/to/logo1.png" alt="Logo 1" class="w-12 h-12">
                <img src="path/to/logo2.png" alt="Logo 2" class="w-12 h-12">
                <img src="path/to/logo3.png" alt="Logo 3" class="w-12 h-12">
                <img src="path/to/logo4.png" alt="Logo 4" class="w-12 h-12">
            </div>
        </div>
    
        <!-- Total Donation & Donor Count Section -->
        <div class="flex justify-center my-6 space-x-8">
            <div class="text-center">
                <p class="text-xl font-semibold text-gray-700 dark:text-gray-300">Saldo Terkumpul</p>
                <p class="text-lg font-bold text-green-600 dark:text-green-400">Rp. 39,365,600</p>
            </div>
            <div class="text-center">
                <p class="text-xl font-semibold text-gray-700 dark:text-gray-300">Total Donatur</p>
                <p class="text-lg font-bold text-green-600 dark:text-green-400">483</p>
            </div>
        </div>
    
        <!-- Batik Artworks Section -->
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 px-4">
            <!-- Artwork Card (repeat for each artwork) -->
            @foreach($artworks as $artwork)
            <!-- Wrap the card in an anchor tag to make it clickable -->
            <a href="{{ route('karyas.show', $artwork->id) }}" class="block">
                <div class="bg-white rounded-lg shadow-md overflow-hidden mx-2 h-full flex flex-col">
                    <!-- Image (YouTube Thumbnail) with adjusted height -->
                    <img src="{{ $artwork->thumbnail_url }}" alt="{{ $artwork->title }}" class="w-full h-30 md:h-40 lg:h-60 object-cover">
                    
                    <!-- Artwork Details -->
                    <div class="p-4 flex-grow">
                        <!-- Title and Team Number -->
                        <h3 class="text-md font-semibold text-gray-800 dark:text-black">{{ $artwork->title }}</h3>
                        
                        <!-- Donation Amount -->
                        <p class="text-gray-600 dark:text-black text-sm mt-2">Total Donasi: 
                            <span class="font-bold">Rp. {{ number_format($artwork->total_donation, 0, ',', '.') }}</span>
                        </p>
                        <p class="text-gray-600 dark:text-black text-sm">Jumlah Donatur: 
                            <span class="font-bold">20</span>
                        </p>
                        <!-- Supporter Count -->
                        <p class="text-gray-600 dark:text-black text-sm">Jumlah LIKE: 
                            <span class="font-bold">20</span>
                        </p>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</x-guest-layout>
