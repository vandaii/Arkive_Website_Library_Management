<x-layouts.user-dashboard>
    <div class="container mx-auto px-6 py-8">
        <a class="flex items-center gap-2 text-black/60 text-sm font-medium"
            href="{{ route('peminjaman.riwayat-peminjaman') }}"><i class="size-4 rotate-180" data-lucide="arrow-right"></i>
            Kembali</a>
        <div class="rounded-2xl overflow-hidden mb-5 bg-white mt-4">
            <div class="h-1 bg-(--third-color)"></div>
            <div class="p-8">
                <div class="flex items-center gap-3 mb-8 pb-6 border-b border-black/15">
                    <div class="p-2.5 rounded-xl bg-(--third-color)">
                        <i class="size-5 text-white" data-lucide="file-text"></i>
                    </div>
                    <div>
                        <p class="text-black font-bold mb-0.5">Detail Pinjam</p>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-8 mb-8">
                    <div>
                        <p class="text-(--third-color) font-bold tracking-widest text-xs mb-4">Informasi Pinjaman</p>
                        <div class="space-y-4">
                            <div>
                                <p class="text-black/45 text-xs mb-0.5">Tanggal Peminjaman</p>
                                <p class="text-black font-semibold text-sm">{{ $detail->tanggal_peminjaman }}</p>
                            </div>
                            <div>
                                <p class="text-black/45 text-xs mb-0.5">Estimasi Tanggal Pengembalian</p>
                                <p class="text-black font-semibold text-sm">{{ $detail->estimasi_tanggal_pengembalian }}
                                </p>
                            </div>
                            <div>
                                <p class="text-black/45 text-xs mb-0.5">Status</p>
                                <p class="text-black font-semibold text-sm">{{ $detail->status_peminjaman }}</p>
                            </div>
                        </div>
                    </div>
                    <div>
                        <p class="text-(--third-color) font-bold tracking-widest text-xs mb-4">Informasi Peminjam</p>
                        <div class="space-y-4">
                            <div>
                                <p class="text-black/45 text-xs mb-0.5">Nama Lengkap</p>
                                <p class="text-black font-semibold text-sm">{{ $detail->user->nama_lengkap }}</p>
                            </div>
                            <div>
                                <p class="text-black/45 text-xs mb-0.5">Email</p>
                                <p class="text-black font-semibold text-sm">{{ $detail->user->email }}
                                </p>
                            </div>
                            <div>
                                <p class="text-black/45 text-xs mb-0.5">No. Handphone</p>
                                <p class="text-black font-semibold text-sm">{{ $detail->user->phone_number }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <a href="{{ route('book.show', $detail->buku->id) }}">
                    <div
                        class="rounded-2xl px-5 py-5 border border-black/10 hover:shadow-md transition-all duration-200">
                        <p class="text-(--third-color) font-semibold tracking-widest mb-4">Detail Buku</p>
                        <div class="flex gap-5">
                            <img class="w-26 h-34 object-cover rounded-xl shrink-0"
                                src="{{ asset('storage/' . $detail->buku->cover_buku) }}" alt="cover">
                            <div class="flex flex-col">
                                <p class="text-black text-lg font-bold mb-1.5">{{ $detail->buku->judul }}</p>
                                <p class="text-black/55 text-base mb-1.5">{{ $detail->buku->penulis }}</p>
                                <p class="text-black/40 text-sm mb-1.5">{{ $detail->buku->penerbit }}</p>
                                <p class="text-black/40 text-sm">ISBN: {{ $detail->buku->isbn_number }}</p>
                            </div>
                        </div>
                    </div>
                </a>
                <div class="mt-12 flex gap-4">
                    <button
                        class="text-sm px-4 py-2 rounded-full border border-black/20 font-medium hover:border-black transition-all duration-200">Cetak
                        Bukti</button>
                    <button
                        class="text-sm px-4 py-2 rounded-full border border-black/20 font-medium hover:border-black transition-all duration-200">Unduh
                        PDF</button>
                </div>
            </div>
        </div>

        @if ($detail->status_peminjaman == 'Dipinjam')
            <div class="rounded-2xl p-6 flex items-center justify-between gap-4 bg-white" id="return-button">
                <div>
                    <p class="text-black font-bold mb-1">Siap mengembalikan buku ini?</p>
                    <p class="text-black/50 text-sm">Ajukan permohonan pengembalian untuk menyelesaikan pinjaman Anda.
                    </p>
                </div>
                <button type="button" onclick="showFormReturn()"
                    class="flex items-center font-medium text-white bg-(--third-color) px-4 py-2 rounded-full hover:bg-(--second-color) gap-2"><i
                        class="size-4" data-lucide="rotate-ccw"></i>Kembalikan
                    Buku</button>
            </div>
        @endif

        <div class="hidden rounded-2xl p-8 bg-white" id="form-return">
            <h1 class="text-lg font-medium mb-2">Konfirmasi Pengembalian Buku</h1>
            <p class="text-black/50 text-sm mb-6">Mohon konfirmasi dan tambahkan catatan apa pun tentang kondisi buku
                tersebut.</p>
            <form class="space-y-4" action="{{ route('peminjaman.kembalikanBuku', $detail->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="mb-12">
                    <label class="font-medium" for="notes">Catatan Kondisi (Opsional)</label>
                    <textarea class="w-full bg-gray-100 mt-1 rounded-lg px-4 py-2 focus:outline-black/15 focus:outline-2" name="notes"
                        id="notes" rows="3" placeholder="Kondisi buku, segala kerusakan, atau catatan lainnya…"></textarea>
                </div>
                <div class="grid grid-cols-2 gap-2">
                    <button type="button" onclick="hideFormReturn()"
                        class="w-full rounded-full outline-1 outline-(--third-color) py-1 text-(--third-color) hover:outline-(--second-color) hover:text-(--second-color) font-medium">Batal</button>
                    <button
                        class="w-full rounded-full bg-(--third-color) py-1 font-medium text-white hover:bg-(--second-color)">Kembalikan</button>
                </div>
            </form>
        </div>


    </div>
    <script>
        function showFormReturn() {
            const formReturn = document.getElementById("form-return");
            const returnButton = document.getElementById("return-button");
            formReturn.classList.remove("hidden");
            returnButton.classList.replace("flex", "hidden");
        }

        function hideFormReturn() {
            const formReturn = document.getElementById("form-return");
            const returnButton = document.getElementById("return-button");
            formReturn.classList.add("hidden");
            returnButton.classList.replace("hidden", "flex");
        }
    </script>
</x-layouts.user-dashboard>
