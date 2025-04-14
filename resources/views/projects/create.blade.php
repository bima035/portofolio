@extends('layouts.app')

@section('content')
<h2 class="text-xl font-semibold mb-4">Tambah Proyek Baru</h2>

<form action="{{ route('projects.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div>
        <label class="block">Judul</label>
        <input type="text" name="title" class="w-full border rounded px-3 py-2" required>
    </div>
    <div>
        <label class="block">Deskripsi</label>
        <textarea name="description" class="w-full border rounded px-3 py-2" required></textarea>
    </div>
    <div>
        <label class="block">Link (opsional)</label>
        <input type="url" name="link" class="w-full border rounded px-3 py-2">
    </div>
    <div>
    <label class="block">Gambar (opsional)</label>
    <input type="file" name="image" class="w-full border rounded px-3 py-2">
    </div>
    <div class="flex gap-2">
        <button class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
        <a href="{{ route('projects.index') }}" class="text-gray-600 px-4 py-2 border rounded">Batal</a>
    </div>
</form>
@endsection
