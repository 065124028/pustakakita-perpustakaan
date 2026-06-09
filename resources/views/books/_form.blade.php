<div class="grid gap-5 sm:grid-cols-2">
    <div class="sm:col-span-2">
        <label for="title" class="block text-sm font-medium text-slate-700">Judul Buku</label>
        <input id="title" name="title" type="text" value="{{ old('title', $book->title ?? '') }}" required
            class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2.5 text-sm focus:border-brand-500 focus:ring-2 focus:ring-brand-200 outline-none">
    </div>
    <div>
        <label for="author" class="block text-sm font-medium text-slate-700">Penulis</label>
        <input id="author" name="author" type="text" value="{{ old('author', $book->author ?? '') }}" required
            class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2.5 text-sm focus:border-brand-500 focus:ring-2 focus:ring-brand-200 outline-none">
    </div>
    <div>
        <label for="category_id" class="block text-sm font-medium text-slate-700">Kategori</label>
        <select id="category_id" name="category_id" required
            class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2.5 text-sm focus:border-brand-500 focus:ring-2 focus:ring-brand-200 outline-none">
            <option value="">- Pilih kategori -</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ (string) old('category_id', $book->category_id ?? '') === (string) $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label for="publisher" class="block text-sm font-medium text-slate-700">Penerbit</label>
        <input id="publisher" name="publisher" type="text" value="{{ old('publisher', $book->publisher ?? '') }}"
            class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2.5 text-sm focus:border-brand-500 focus:ring-2 focus:ring-brand-200 outline-none">
    </div>
    <div>
        <label for="year" class="block text-sm font-medium text-slate-700">Tahun Terbit</label>
        <input id="year" name="year" type="number" value="{{ old('year', $book->year ?? '') }}"
            class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2.5 text-sm focus:border-brand-500 focus:ring-2 focus:ring-brand-200 outline-none">
    </div>
    <div>
        <label for="isbn" class="block text-sm font-medium text-slate-700">ISBN</label>
        <input id="isbn" name="isbn" type="text" value="{{ old('isbn', $book->isbn ?? '') }}"
            class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2.5 text-sm focus:border-brand-500 focus:ring-2 focus:ring-brand-200 outline-none">
    </div>
    <div>
        <label for="stock" class="block text-sm font-medium text-slate-700">Stok</label>
        <input id="stock" name="stock" type="number" min="0" value="{{ old('stock', $book->stock ?? 1) }}" required
            class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2.5 text-sm focus:border-brand-500 focus:ring-2 focus:ring-brand-200 outline-none">
    </div>
    <div class="sm:col-span-2">
        <label for="description" class="block text-sm font-medium text-slate-700">Deskripsi</label>
        <textarea id="description" name="description" rows="4"
            class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2.5 text-sm focus:border-brand-500 focus:ring-2 focus:ring-brand-200 outline-none">{{ old('description', $book->description ?? '') }}</textarea>
    </div>
    <div class="sm:col-span-2">
        <label for="cover" class="block text-sm font-medium text-slate-700">Sampul Buku <span class="text-slate-400">(jpg, png, webp — maks 2MB)</span></label>
        @if (! empty($book?->cover))
            <div class="mt-2 flex items-center gap-3">
                <img src="{{ asset('storage/' . $book->cover) }}" alt="cover" class="h-20 w-16 rounded object-cover border border-slate-200">
                <span class="text-xs text-slate-500">Unggah file baru untuk mengganti sampul.</span>
            </div>
        @endif
        <input id="cover" name="cover" type="file" accept="image/*"
            class="mt-2 block w-full text-sm text-slate-600 file:mr-3 file:rounded-lg file:border-0 file:bg-brand-50 file:px-4 file:py-2 file:text-sm file:font-medium file:text-brand-700 hover:file:bg-brand-100">
    </div>
</div>
