<x-layouts.admin-dashboard>
    <div class="ml-45 flex flex-col gap-y-3">
        @forelse ($pengajuans as $pengajuan)
            <div class="flex bg-white justify-between items-center py-3 px-5 rounded-lg shadow-sm/30">
                <div>
                    <h1 class="text-lg">{{ $pengajuan->buku->judul }}</h1>
                    <p class="text-sm">Jumlah Buku: {{ $pengajuan->stok }}</p>
                </div>
                <p>{{ $pengajuan->user->nama_lengkap }}</p>
                <div class="flex gap-x-3">
                    <form action="{{ route('kelola-kembali.setuju-kembali', $pengajuan->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="cursor-pointer">Approve</button>
                    </form>
                    <form action="{{ route('kelola-kembali.tolak-kembali', $pengajuan->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="cursor-pointer">Reject</button>
                    </form>
                </div>
            </div>
        @empty
            <p class="capitalize text-gray-600">Tidak Ada Data</p>
        @endforelse
    </div>
</x-layouts.admin-dashboard>
