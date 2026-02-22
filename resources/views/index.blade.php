<x-layouts.user-dashboard>
    <div class="flex gap-5 flex-wrap w-full">
        @forelse ($books as $book)
            <a href="{{ route('book.show', $book->id) }}">
                <div class="w-70 sm:w-45 rounded-lg px-2 py-4 shadow-md/30 bg-white">
                    <img class="border h-40 object-cover rounded-lg mx-auto border-none"
                        src="{{ asset('storage/' . $book->cover_buku) }}" alt="cover">
                    <div>
                        <h1 class="font-medium text-lg mt-2 whitespace-nowrap overflow-hidden text-ellipsis">
                            {{ $book->judul }}</h1>
                        <h2 class="text-base">{{ $book->penulis }}</h2>
                        <div class="flex space-x-1.5 items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="yellow" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-5 stroke-none">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                            </svg>
                            <p class="text-sm">4.5</p>
                        </div>
                    </div>
                </div>
            </a>
        @empty
            <h1>Tidak Ada Data</h1>
        @endforelse
    </div>
</x-layouts.user-dashboard>
