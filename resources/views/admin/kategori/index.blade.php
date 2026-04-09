<x-layouts.admin-dashboard>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="bg-white px-10 py-8 rounded-lg">

        <div class="mb-10">
            <h1 class="capitalize text-2xl font-medium">{{ __($title) }}</h1>
        </div>

        <div class="flex justify-between items-center mb-5">
            <form class="w-1/2" action="{{ route('kategori.index') }}" method="GET">
                <x-search-input class="w-full"></x-search-input>
            </form>
            <a class="flex items-center gap-1.5 px-5 py-2 bg-(--third-color) hover:bg-(--second-color) text-white rounded-lg transition-colors duration-200"
                href="{{ route('kategori.create') }}">
                <i class="size-4" data-lucide="plus"></i>Tambah Kategori</a>
        </div>

        <table class="table-fixed w-full">
            <thead>
                <tr class="border-b-2 border-gray-500/40 text-left">
                    <th class="w-11/12 py-3">Nama Kategori</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($categories as $category)
                <tr class="border-b-2 border-gray-500/40">
                    <td>{{ $category->nama_kategori }}</td>
                    <td class="py-3">
                        <div class="flex items-center gap-x-2">
                            <a href="{{ route('kategori.show', $category->id) }}"
                                class="rounded-lg hover:bg-amber-50 text-(--third-color) transition-colors"
                                title="Edit">
                                <i class="size-4" data-lucide="pencil"></i>
                            </a>
                            <form onsubmit="return confirm('Yakin?')"
                                action="{{ route('kategori.destroy', $category->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="rounded-lg hover:bg-red-50 text-red-500 cursor-pointer transition-colors"
                                    title="Hapus">
                                    <i class="size-4" data-lucide="trash-2"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td class="text-base text-gray-600 pt-5">Tidak ada data</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        {{-- Pagination --}}
        @if ($categories->hasPages())
        <div class="flex justify-center mt-6">
            {{ $categories->links('components.pagination') }}
        </div>
        @endif

    </div>

</x-layouts.admin-dashboard>