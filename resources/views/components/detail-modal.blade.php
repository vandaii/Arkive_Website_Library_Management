@props(['id' => 'detailModal', 'title' => 'Detail', 'maxWidth' => 'max-w-3xl'])

<div id="{{ $id }}" class="detail-modal fixed inset-0 z-100 hidden">
    <div class="detail-modal-backdrop absolute inset-0 bg-black/40 backdrop-blur-sm"
        onclick="closeModal('{{ $id }}')"></div>
    <div class="flex items-center justify-center min-h-screen p-4">
        <div
            class="detail-modal-content relative bg-white rounded-2xl shadow-2xl w-full {{ $maxWidth }} z-10 max-h-[90vh] flex flex-col">
            {{-- Header --}}
            <div class="flex justify-between items-center border-b border-black/10 p-5 shrink-0">
                <h2 class="text-lg font-semibold text-gray-800">{{ $title }}</h2>
                <button onclick="closeModal('{{ $id }}')"
                    class="p-1.5 rounded-full border border-black/15 cursor-pointer hover:bg-black/5 hover:border-black/30 transition-all duration-200">
                    <i class="size-4 text-gray-500" data-lucide="x"></i>
                </button>
            </div>
            {{-- Body --}}
            <div class="overflow-y-auto flex-1 p-5">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>
