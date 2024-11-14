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

                        <!-- Description Text (Below the buttons) -->
                        <div
                            class="mt-6 text-gray-600 text-lg grid grid-cols-1 md:grid-cols-[150px,1fr] gap-4 text-justify">
                            <p class="font-semibold">Deskripsi:</p>
                            <p class="break-words">
                                dddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddd
                            </p>
                        </div>

                        <div class="mt-6 flex justify-center items-center space-x-4">
                            <!-- Like Button -->


                            <!-- Donate Button -->
                            <!-- Donate Button -->
                            <div class="flex items-center">
                                <button
                                    class="flex items-center px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 focus:outline-none"
                                    onclick="openModal()"> <!-- Open modal on click -->
                                    <i class="fas fa-donate mr-2"></i> <!-- Donate Icon -->
                                    <span>Donate</span>
                                </button>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
        <div id="donateModal" class="fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center hidden">
            <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-lg mx-4 sm:w-2/3 md:w-1/2 lg:w-1/3">
                <h2 class="text-2xl font-semibold mb-4">Donate</h2>
                <form id="donateForm" action="{{ route('users.transactionStore') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="title" class="block text-gray-700">Title</label>
                        <input disabled type="text" id="title" value="{{ $karya->title }}" name="title"
                            class="w-full p-2 border border-gray-300 rounded mt-1">
                        <input hidden type="text" id="title" value="{{ $karya->id }}" name="id"
                            class="w-full p-2 border border-gray-300 rounded mt-1">
                    </div>
                    <div class="mb-4">
                        <label for="amount" class="block text-gray-700">Amount</label>
                        <input type="number" id="amount" placeholder="Minimum 10,000" name="amount"
                            class="w-full p-2 border border-gray-300 rounded mt-1">
                    </div>
                    <label for="channel">Select Channel:</label>
                    <select id="channel" name="channel" class="w-full p-2 border border-gray-300 rounded mt-1 mb-5">
                        <option value="" disabled selected>Select a channel</option>
                        @foreach ($channels as $channel)
                            <option value="{{ $channel->code }}">{{ $channel->name }}</option>
                        @endforeach
                    </select>
                    <div class="flex justify-end">
                        <button type="button" class="px-4 py-2 bg-gray-300 rounded-lg mr-2"
                            onclick="closeModal()">Cancel</button>
                        <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded-lg">Submit</button>
                    </div>
                </form>
            </div>
        </div>

    </x-slot>




    <!-- Modal -->


    <!-- JavaScript for Modal -->
    <script>
        function openModal() {
            document.getElementById('donateModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('donateModal').classList.add('hidden');
        }
    </script>
</x-app-layout>
