<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Transactions') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="space-y-4">
                @if ($transactions->isEmpty())
                    <div class="text-center text-gray-500">
                        No transactions available
                    </div>
                @else
                    @foreach ($transactions as $transaction)
                        <div class="border border-gray-300 rounded-lg overflow-hidden">
                            <!-- Header (Clickable) -->
                            <div class="bg-gray-200 p-4 cursor-pointer" onclick="toggleCollapse({{ $transaction->id }})">
                                <div class="flex justify-between items-center">
                                    <span>Transaction #{{ $transaction->id }}</span>
                                    <span
                                        class="text-sm text-gray-600">{{ $transaction->created_at->format('Y-m-d') }}</span>
                                </div>
                            </div>

                            <!-- Collapsible Content -->
                            <div id="collapse-{{ $transaction->id }}" class="hidden bg-white p-4">
                                <p class="mb-3"><strong>ID Karya:</strong> {{ $transaction->idKarya }}</p>
                                <p class="mb-3"><strong>ID NPK:</strong> {{ $transaction->idNPK }}</p>
                                <p class="mb-3"><strong>status:</strong> {{ $transaction->status }}</p>
                                <p class="mb-3"><strong>Total Amount:</strong>
                                    ${{ number_format($transaction->total_amount, 2) }}
                                </p>
                                <p class="mb-3"><strong>Reference:</strong> {{ $transaction->reference }}</p>
                                <p class="mb-3"><strong>Merchant Reference:</strong>
                                    {{ $transaction->merchant_reference }}</p>
                                <p class="mb-3"><strong>Created At:</strong>
                                    {{ $transaction->created_at->format('Y-m-d H:i') }}</p>
                                <p class="mt-5 mb-5"><a
                                        href="{{ route('users.transactionShow', $transaction->reference) }}"
                                        class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 focus:outline-none">
                                        Open Transaction
                                    </a>
                                </p>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>

    <script>
        function toggleCollapse(id) {
            const collapseDiv = document.getElementById('collapse-' + id);
            collapseDiv.classList.toggle('hidden');
        }
    </script>
</x-app-layout>
