<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Karya Management') }}
        </h2>
    </x-slot>

    <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-lg">
        <button id="openCreateModal" class="bg-green-500 text-white px-4 py-2 rounded-md mb-4">
            {{ __('Add New Karya') }}
        </button>

        <div class="overflow-x-auto">
            <table class="table-auto min-w-full text-left text-sm">
                <thead class="bg-gray-100 dark:bg-gray-700">
                    <tr>
                        <th class="px-6 py-3 text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">{{ __('ID') }}</th>
                        <th class="px-6 py-3 text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">{{ __('Title') }}</th>
                        <th class="px-6 py-3 text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">{{ __('Description') }}</th>
                        <th class="px-6 py-3 text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-600">
                    @foreach ($karyas as $karya)
                        <tr>
                            <td class="px-6 py-4">{{ $karya->id }}</td>
                            <td class="px-6 py-4">{{ $karya->title }}</td>
                            <td class="px-6 py-4">{{ $karya->description }}</td>
                            <td class="px-6 py-4 flex space-x-4">
                                <button class="bg-yellow-500 text-white px-4 py-2 rounded-md editKaryaBtn" data-id="{{ $karya->id }}" data-title="{{ $karya->title }}" data-description="{{ $karya->description }}" data-link="{{ $karya->link }}">
                                    {{ __('Edit') }}
                                </button>
                                <form action="{{ route('karyas.destroy', $karya->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this item?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-md">{{ __('Delete') }}</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal for Create New Karya -->
    <div id="createKaryaModal" class="fixed inset-0 bg-gray-500 bg-opacity-50 hidden flex justify-center items-center">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 w-96">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-4">{{ __('Add New Karya') }}</h2>
            <form id="createKaryaForm" method="POST" action="{{ route('karyas.store') }}">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Title') }}</label>
                        <input type="text" name="title" id="title" class="mt-1 block w-full px-4 py-2" required>
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Description') }}</label>
                        <textarea name="description" id="description" class="mt-1 block w-full px-4 py-2" required></textarea>
                    </div>

                    <div>
                        <label for="link" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Link') }}</label>
                        <input type="url" name="link" id="link" class="mt-1 block w-full px-4 py-2" required>
                    </div>

                    <div class="flex justify-between">
                        <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-md">{{ __('Add Karya') }}</button>
                        <button type="button" id="closeCreateModal" class="bg-gray-500 text-white px-4 py-2 rounded-md">{{ __('Close') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal for Edit Karya -->
    <div id="editKaryaModal" class="fixed inset-0 bg-gray-500 bg-opacity-50 hidden flex justify-center items-center">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 w-96">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-4">{{ __('Edit Karya') }}</h2>
            <form id="editKaryaForm" method="POST" action="{{ route('karyas.update', ':id') }}">
                @csrf
                @method('PUT')
                <input type="hidden" id="editKaryaId" name="id">

                <div class="space-y-4">
                    <div>
                        <label for="editTitle" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Title') }}</label>
                        <input type="text" name="title" id="editTitle" class="mt-1 block w-full px-4 py-2" required>
                    </div>

                    <div>
                        <label for="editDescription" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Description') }}</label>
                        <textarea name="description" id="editDescription" class="mt-1 block w-full px-4 py-2" required></textarea>
                    </div>

                    <div>
                        <label for="editLink" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Link') }}</label>
                        <input type="url" name="link" id="editLink" class="mt-1 block w-full px-4 py-2" required>
                    </div>

                    <div class="flex justify-between">
                        <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-md">{{ __('Update Karya') }}</button>
                        <button type="button" id="closeEditModal" class="bg-gray-500 text-white px-4 py-2 rounded-md">{{ __('Close') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
      document.addEventListener('DOMContentLoaded', function() {
    // Create Karya Modal
    document.getElementById('openCreateModal').addEventListener('click', function() {
        document.getElementById('createKaryaModal').classList.remove('hidden');
    });

    document.getElementById('closeCreateModal').addEventListener('click', function() {
        document.getElementById('createKaryaModal').classList.add('hidden');
    });

    // Edit Karya Modal
    const editButtons = document.querySelectorAll('.editKaryaBtn');
    editButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const title = this.getAttribute('data-title');
            const description = this.getAttribute('data-description');
            const link = this.getAttribute('data-link');

            // Set values in the form
            document.getElementById('editKaryaId').value = id;
            document.getElementById('editTitle').value = title;
            document.getElementById('editDescription').value = description;
            document.getElementById('editLink').value = link;

            // Update the form action with the correct ID
            const form = document.getElementById('editKaryaForm');
            form.action = form.action.replace(':id', id);

            // Show the edit modal
            document.getElementById('editKaryaModal').classList.remove('hidden');
        });
    });

    document.getElementById('closeEditModal').addEventListener('click', function() {
        document.getElementById('editKaryaModal').classList.add('hidden');
    });
});

    </script>
</x-app-layout>
