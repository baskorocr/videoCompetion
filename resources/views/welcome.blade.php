<x-guest-layout>
    <!-- Container -->
    <div class="container mx-auto my-8 px-4 h-full">
        <!-- Header Section -->
        <div class="text-center p-8 rounded-lg shadow-md mx-4"
            style="background-image: url('https://img.freepik.com/free-vector/flat-abstract-background_23-2149123691.jpg?t=st=1731375496~exp=1731379096~hmac=c575a10a9e20e59b7075b54fc4dfdc9264ae49819e7e197131c7755623584a3f&w=996'); background-size: cover; background-position: center;">
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
                <p class="text-lg font-bold text-green-600 dark:text-green-400">Rp.
                    {{ number_format($totalAmountSum, 0, ',', '.') }}</p>
            </div>
            <div class="text-center">
                <p class="text-xl font-semibold text-gray-700 dark:text-gray-300">Total Donatur</p>
                <p class="text-lg font-bold text-green-600 dark:text-green-400">{{ $totalDonator }}</p>
            </div>
        </div>

        <!-- Batik Artworks Section -->
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 px-4">
            <!-- Artwork Card (repeat for each artwork) -->
            @foreach ($artworks as $artwork)
                <div class="bg-white rounded-lg shadow-md overflow-hidden mx-2 h-full flex flex-col artwork-card"
                    data-artwork-id="{{ $artwork->id }}" data-votes="{{ $artwork->total_votes }}"
                    data-check="{{ $check }}" data-check-votes="{{ $check }}"
                    data-temp="{{ $artwork->temp }}" data-user-vote="{{ $artwork->user_votes }}">
                    <!-- Gambar yang menjadi link -->
                    <a href="{{ route('karyas.show', $artwork->id) }}" class="block">
                        <img src="{{ $artwork->thumbnail_url }}" alt="{{ $artwork->title }}"
                            class="w-full h-30 md:h-40 lg:h-60 object-cover">
                    </a>

                    <!-- Detail Karya -->
                    <div class="p-4 flex-grow flex flex-col">
                        <!-- Kolom Kiri: Judul, Donasi, dan Donatur -->
                        <div class="flex flex-col w-full">
                            <h3 class="text-md font-semibold text-gray-800 dark:text-black">{{ $artwork->title }}</h3>
                            <p class="text-gray-600 dark:text-black text-sm mt-2">Total Donasi:
                                <span class="font-bold">Rp.
                                    {{ number_format($artwork->transactions_sum_total_amount, 0, ',', '.') }}</span>
                            </p>
                            <p class="text-gray-600 dark:text-black text-sm">Jumlah Donatur:
                                <span class="font-bold">{{ $artwork->total_donations }}</span>
                            </p>
                            <p class="text-gray-600 dark:text-black text-sm">Jumlah LIKE:
                                <span class="font-bold">{{ $artwork->total_votes }}</span>
                            </p>
                        </div>

                        <!-- Kolom Kanan: Link Like -->
                        <div class="mt-4 flex justify-center sm:justify-end">
                            <a class="flex items-center justify-center px-4 py-2 w-full sm:w-auto {{ $artwork->user_votes == 1 ? 'bg-red-800' : 'bg-blue-800' }} text-white rounded-lg hover:bg-blue-600 focus:outline-none artwork-like"
                                href="{{ route('users.like', $artwork->id) }}" data-artwork-id="{{ $artwork->id }}">
                                <i class="fas fa-thumbs-up mr-2"></i> <!-- Like Icon -->
                                <span>{{ $artwork->total_votes }}</span> <!-- Number of Likes -->
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.artwork-like').forEach(button => {
                button.addEventListener('click', function(event) {
                    event.preventDefault(); // Prevent the default link behavior

                    const artworkCard = button.closest('.artwork-card');
                    const artworkId = artworkCard.getAttribute('data-artwork-id');
                    const check = artworkCard.getAttribute('data-check');
                    const artworkTemp = artworkCard.getAttribute('data-temp');
                    const userVote = artworkCard.getAttribute('data-user-vote');
                    const isAuthenticated = @json(auth()->check());

                    console.log(check);

                    if (artworkId === artworkTemp && userVote === '1' && isAuthenticated &&
                        check === '1') {
                        const isConfirmed = confirm(
                            "Anda akan melakukan unlike, lanjutkan?"
                        );
                        if (!isConfirmed) {
                            return; // Exit if the user cancels the confirmation
                        }
                    }

                    if ((artworkId !== artworkTemp && userVote === '0' && isAuthenticated &&
                            check === '1')) {
                        const isConfirmed = confirm(
                            "Kamu sudah melakukan like, status like sebelumnya akan dihapus diganti dengan item yang anda pilih sekarang! Lanjutkan?"
                        );
                        if (!isConfirmed) {
                            return; // Exit if the user cancels the confirmation
                        }
                    }

                    window.location.href = button.getAttribute('href');
                });
            });
        });
    </script>
</x-guest-layout>
