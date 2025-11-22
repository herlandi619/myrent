{{-- Alert Success --}}
@if (session('success'))
    <div class="mb-4 flex items-center justify-between px-4 py-3 rounded-lg bg-green-100 text-green-800 border border-green-300"
         x-data="{ show: true }" x-show="show">
        <span>{{ session('success') }}</span>
        <button @click="show = false" class="text-green-800 hover:text-green-900 font-bold ml-2">✕</button>
    </div>
@endif

{{-- Alert Error --}}
@if (session('error'))
    <div class="mb-4 flex items-center justify-between px-4 py-3 rounded-lg bg-red-100 text-red-800 border border-red-300"
         x-data="{ show: true }" x-show="show">
        <span>{{ session('error') }}</span>
        <button @click="show = false" class="text-red-800 hover:text-red-900 font-bold ml-2">✕</button>
    </div>
@endif
