<div class="grid grid-cols-1 md:grid-cols-2 gap-6">

    {{-- Nama Alat --}}
    <div class="flex flex-col gap-2">
        <label class="font-semibold">Nama Alat</label>
        <input type="text" name="name" value="{{ old('name', $item->name ?? '') }}"
               class="border rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-400 focus:outline-none">
    </div>

    {{-- Kategori --}}
    <div class="flex flex-col gap-2">
        <label class="font-semibold">Kategori</label>
        <select name="category" 
                class="border rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-400 focus:outline-none">
            <option value="PS">PlayStation</option>
            <option value="Camera">Kamera</option>
            <option value="Other">Lainnya</option>
        </select>
    </div>

    {{-- Harga --}}
    <div class="flex flex-col gap-2">
        <label class="font-semibold">Harga Sewa (per Jam)</label>
        <input type="number" name="price" value="{{ old('price', $item->price ?? '') }}"
               class="border rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-400 focus:outline-none">
    </div>

    {{-- Status --}}
    <div class="flex flex-col gap-2">
        <label class="font-semibold">Status</label>
        <select name="status"
                class="border rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-400 focus:outline-none">
            <option value="available">Tersedia</option>
            <option value="maintenance">Maintenance</option>
        </select>
    </div>

</div>
