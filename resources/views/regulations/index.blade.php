<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Peraturan RT') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Tab Navigation -->
                    <div class="border-b border-gray-200 dark:border-gray-700">
                        <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                            <button @click="activeTab = 'rules'"
                                :class="{ 'border-indigo-500 text-indigo-600': activeTab === 'rules' }"
                                class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                                Tata Tertib
                            </button>
                            <button @click="activeTab = 'meetings'"
                                :class="{ 'border-indigo-500 text-indigo-600': activeTab === 'meetings' }"
                                class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                                Dokumen Rapat
                            </button>
                            <button @click="activeTab = 'policies'"
                                :class="{ 'border-indigo-500 text-indigo-600': activeTab === 'policies' }"
                                class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                                Kebijakan
                            </button>
                        </nav>
                    </div>

                    <!-- Tab Panels -->
                    <div class="mt-6">
                        <div x-show="activeTab === 'rules'" class="space-y-6">
                            @forelse($regulations->where('category', 'rule') as $regulation)
                                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-6">
                                    <h3 class="text-lg font-medium">{{ $regulation->title }}</h3>
                                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                                        {{ $regulation->content }}
                                    </p>
                                    @if ($regulation->document_path)
                                        <a href="{{ asset($regulation->document_path) }}"
                                            class="mt-4 inline-flex items-center text-sm text-blue-600 hover:text-blue-500">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                            Download Dokumen
                                        </a>
                                    @endif
                                    <div class="mt-4 text-sm text-gray-500">
                                        Berlaku sejak: {{ $regulation->effective_date->format('d F Y') }}
                                    </div>

                                    @can('role', 'Admin')
                                        <div class="mt-4 flex space-x-2">
                                            <button onclick="editRegulation({{ $regulation->id }})"
                                                class="px-3 py-1 bg-blue-600 text-white rounded-md hover:bg-blue-700 text-sm">
                                                Edit
                                            </button>
                                            <form action="{{ route('regulations.destroy', $regulation->id) }}"
                                                method="POST" class="inline">
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
                                <p class="text-gray-600 dark:text-gray-400 text-center py-12">
                                    Belum ada tata tertib yang ditambahkan.
                                </p>
                            @endforelse
                        </div>

                        <!-- Similar panels for meetings and policies -->
                        <!-- ... -->
                    </div>

                    @can('role', 'Admin')
                        <div class="mt-6">
                            <button onclick="showAddRegulationForm()"
                                class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-md">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4" />
                                </svg>
                                Tambah Peraturan
                            </button>
                        </div>
                    @endcan
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            function showAddRegulationForm() {
                // Implementation for showing add form modal
            }

            function editRegulation(id) {
                // Implementation for showing edit form modal
            }
        </script>
    @endpush
</x-app-layout>
