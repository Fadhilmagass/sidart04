<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 dark:text-gray-800 leading-tight">
            {{ __('Profil RT') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if ($profile)
                        <div class="space-y-6">
                            <div class="">
                                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                    {{ $profile->name }}
                                </h3>
                                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                    {{ $profile->description }}
                                </p>
                            </div>

                            @if ($profile->map_embed)
                                <div class="relative h-96 rounded-lg overflow-hidden">
                                    {!! $profile->map_embed !!}
                                </div>
                            @endif

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="">
                                    <h4 class="font-medium text-gray-900 dark:text-gray-100">
                                        Alamat
                                    </h4>
                                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                        {{ $profile->address }}
                                    </p>
                                </div>
                                <div class="">
                                    <h4 class="font-medium text-gray-900 dark:text-gray-100">
                                        Kontak
                                    </h4>
                                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                        Email: {{ $profile->email }} <br>
                                        Telepon: {{ $profile->phone }}
                                    </p>
                                </div>
                            </div>

                            @if ($profile->history)
                                <div class="">
                                    <h4 class="font-medium text-gray-900 dark:text-gray-100">
                                        Sejarah
                                    </h4>
                                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                        {{ $profile->history }}
                                    </p>
                                </div>
                            @endif
                        </div>
                    @else
                        <p class="text-gray-600 dark:text-gray-400">Profil RT belum diatur.</p>
                    @endif

                    @can('role', 'Admin')
                        <div class="mt-6">
                            <a href="{{ route('rt-profile.edit') }}"
                                class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                Edit Profil
                            </a>
                        </div>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
