<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Struktur Organisasi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @forelse($structures as $structure)
                            <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-6 flex flex-col items-center">
                                @if ($structure->photo_path)
                                    <img src="{{ $structure->photo_path }}" alt="{{ $structure->name }}"
                                        class="w-32 h-32 rounded-full object-cover mb-4">
                                @else
                                    <div
                                        class="w-32 h-32 rounded-full bg-gray-200 dark:bg-gray-600 flex items-center justify-center mb-4">
                                        <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    </div>
                                @endif

                                <h3 class="text-lg font-medium">{{ $structure->name }}</h3>
                                <p class="text-sm text-gray-600 dark:text-gray-400">{{ $structure->position }}</p>

                                @if ($structure->phone || $structure->email)
                                    <div class="mt-4 text-sm text-gray-600 dark:text-gray-400 text-center">
                                        @if ($structure->phone)
                                            <p>{{ $structure->phone }}</p>
                                        @endif
                                        @if ($structure->email)
                                            <p>{{ $structure->email }}</p>
                                        @endif
                                    </div>
                                @endif

                                @can('role', 'Admin')
                                    <div class="mt-4 flex space-x-2">
                                        <button onclick="editStructure({{ $structure->id }})"
                                            class="px-3 py-1 bg-blue-600 text-white rounded-md hover:bg-blue-700 text-sm">
                                            Edit
                                        </button>
                                        <form action="{{ route('organization.destroy', $structure->id) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="px-3 py-1 bg-red-600 text-white rounded-md hover:bg-red-700 text-sm"
                                                onclick="return confirm('Yakin ingin menghapus?')">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                @endcan
                            </div>
                        @empty
                            <div class="col-span-full text-center py-12">
                                <p class="text-gray-600 dark:text-gray-400">Belum ada data struktur organisasi.</p>
                            </div>
                        @endforelse
                    </div>

                    @can('role', 'Admin')
                        <div class="mt-6">
                            <button onclick="showAddForm()"
                                class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-md">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4" />
                                </svg>
                                Tambah Pengurus
                            </button>
                        </div>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
