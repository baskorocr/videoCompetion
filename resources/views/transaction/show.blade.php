<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Transaction Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg p-6">
                <!-- Basic Transaction Info -->
                <h3 class="text-lg font-semibold mb-4">Transaction Summary</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <p><strong>Reference:</strong> {{ $data->reference }}</p>
                        <p><strong>Merchant Reference:</strong> {{ $data->merchant_ref }}</p>
                        <p><strong>Payment Method:</strong> {{ $data->payment_name }}</p>
                        <p><strong>Status:</strong> {{ $data->status }}</p>
                    </div>
                    <div>
                        <p><strong>Amount:</strong> ${{ number_format($data->amount, 2) }}</p>


                        <p><strong>Paid At:</strong>
                            {{ \Carbon\Carbon::createFromTimestamp($data->paid_at)->toDayDateTimeString() }}</p>
                        <p><strong>Expires At:</strong>
                            {{ \Carbon\Carbon::createFromTimestamp($data->expired_time)->toDayDateTimeString() }}</p>
                    </div>
                    <!-- QR Code -->
                    <div class="flex items-center justify-center">
                        @if (!empty($data->qr_url))
                            <div>
                                <h4 class="text-center font-semibold mb-2">Scan to Pay</h4>
                                <img src="{{ $data->qr_url }}" alt="QR Code for Payment" class="w-32 h-32 mx-auto">
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Customer Information -->
                <h3 class="text-lg font-semibold mt-6 mb-4">Customer Information</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <p><strong>Name:</strong> {{ $data->customer_name }}</p>

                </div>

                <!-- Order Items (Collapsible) -->
                <h3 class="text-lg font-semibold mt-6 mb-4">Order Items</h3>
                <div class="space-y-4">
                    @foreach ($data->order_items as $item)
                        <div class="border border-gray-300 rounded-lg p-4">
                            <p><strong>Product Name:</strong> {{ $item->name }}</p>

                            <p><strong>Price:</strong> ${{ number_format($item->price, 2) }}</p>
                            <p><strong>Quantity:</strong> {{ $item->quantity }}</p>
                            <p><strong>Subtotal:</strong> ${{ number_format($item->subtotal, 2) }}</p>

                        </div>
                    @endforeach
                </div>

                <!-- Instructions (Collapsible) -->
                <h3 class="text-lg font-semibold mt-6 mb-4">Payment Instructions</h3>
                <div class="space-y-4">
                    @foreach ($data->instructions as $instruction)
                        <div class="border border-gray-300 rounded-lg p-4">
                            <h4 class="font-semibold">{{ $instruction->title }}</h4>
                            <ol class="list-decimal ml-6 mt-2">
                                @foreach ($instruction->steps as $step)
                                    <li>{!! $step !!}</li>
                                @endforeach
                            </ol>
                        </div>
                    @endforeach
                </div>

                <!-- Action Links -->

            </div>
        </div>
    </div>
</x-app-layout>
