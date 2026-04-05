<x-layouts.admin-dashboard>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="bg-white px-10 py-8 rounded-lg">

        <div class="mb-10">
            <h1 class="capitalize text-xl">{{ __($title) }}</h1>
        </div>

        <div class="flex justify-between items-center mb-5">
            <form class="relative w-1/2" action="">
                <x-search-input></x-search-input>
            </form>
            <a class="px-5 py-3 bg-indigo-500 text-white rounded-lg" href="{{ route('data-buku.create') }}">Tambah
                Buku</a>
        </div>

        <table class="table-fixed w-full">
            <thead>
                <tr class="border-b-2 border-gray-500/40 text-left">
                    <th class="py-3 w-2/12">Cover Buku</th>
                    <th class="w-3/12">Judul</th>
                    <th class="w-2/12">Penulis</th>
                    <th class="w-2/12">Penerbit</th>
                    <th class="w-1/12">Tahun Terbit</th>
                    <th class="w-1/12">Stok</th>
                    <th class="w-1/12">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($books as $book)
                    <tr class="border-b-2 border-gray-500/40">
                        <td class="py-3 pr-2">
                            <img class="rounded-sm h-25" src="{{ asset('storage/' . $book->cover_buku) }}"
                                alt="">
                        </td>
                        <td class="pr-2">{{ $book->judul }}</td>
                        <td class="pr-2">{{ $book->penulis }}</td>
                        <td class="pr-2">{{ $book->penerbit }}</td>
                        <td class="pr-2">{{ $book->tahun_terbit }}</td>
                        <td class="pr-2">{{ $book->stok }}</td>
                        <td>
                            <div class="flex gap-x-2">
                                <a href="{{ route('data-buku.show', $book->id) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                    </svg>
                                </a>
                                <form action="{{ route('data-buku.destroy', $book->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="cursor-pointer">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-5 stroke-red-600">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                        </svg>

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

    </div>

</x-layouts.admin-dashboard>
