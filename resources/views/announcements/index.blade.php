<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Pengumuman') }}
            </h2>
            @role('Admin')
                <a href="{{ route('announcements.create') }}"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Tambah Pengumuman
                </a>
            @endrole
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @foreach ($announcements as $announcement)
                        <div
                            class="mb-6 p-4 rounded-lg border
                        {{ $announcement->priority === 'hight'
                            ? 'border-red-200 bg-red-50 dark:bg-red-900/10'
                            : ($announcement->priority === 'medium'
                                ? 'border-yellow-200 bg-yellow-50 dark:bg-yellow-900/10'
                                : 'border-gray-200 bg-gray-50 dark:bg-gray-900/10') }}">
                            <div class="flex justify-between items-start">
                                <h3 class="text-lg font-semibold">
                                    {{ $announcement->title }}
                                </h3>
                                <div class="flex items-center-space-x-2">
                                    @role('Admin')
                                        <a href="{{ route('announcements.edit', $announcement) }}"
                                            class="text-blue-500 hover:text-blue-700">
                                            Edit
                                        </a>
                                        <form action="{{ route('announcements.destroy', $announcement) }}" method="POST"
                                            class="inline"
                                            onsubmit="return confirm('Yakin ingin menghapus pengumuman ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-700">
                                                Hapus
                                            </button>
                                        </form>
                                    @endrole
                                </div>
                            </div>
                            <div class="mt-2 text-gray-600 dark:text-gray-300">
                                {!! nl2br(e($announcement->content)) !!}
                            </div>
                            <div class="mt-4 text-sm text-gray-500 dark:text-gray-400">
                                Diposting: {{ $announcement->created_at->format('d M Y H:i') }}
                                @if ($announcement->valid_until)
                                    | Berlaku sampai: {{ $announcement->valid_until->format('d M Y') }}
                                @endif
                            </div>
                        </div>
                    @endforeach
                    {{ $announcements->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
