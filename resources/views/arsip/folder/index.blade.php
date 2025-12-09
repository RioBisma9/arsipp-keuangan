{{-- resources/views/arsip/folder/index.blade.php --}}

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $rak->box->jenisArsip->nama }} > Box {{ $rak->box->nomor_box }} > Rak {{ $rak->nama_rak }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-6 flex justify-between items-center">
                <a href="{{ route('arsip.rak.index', $rak->box) }}" class="text-blue-600 hover:text-blue-800 text-sm">
                    &larr; Kembali ke Daftar Rak
                </a>
                {{-- Tombol untuk menampilkan Form Tambah Folder --}}
                <button 
                    onclick="document.getElementById('form-tambah-folder').classList.toggle('hidden')" 
                    class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">
                    + Tambah Folder Baru
                </button>
            </div>
            
            {{-- Form Tambah Folder (CRUD Create) --}}
            <div id="form-tambah-folder" class="hidden bg-white p-6 rounded-lg shadow-md mb-6">
                <h3 class="text-lg font-semibold mb-4">Buat Folder Baru di Rak {{ $rak->nama_rak }}</h3>
                <form action="{{ route('arsip.folder.store', $rak) }}" method="POST">
                    @csrf
                    <div class="space-y-4">
                        <div>
                            <label for="nomor_folder" class="block text-sm font-medium text-gray-700">Nomor Folder</label>
                            <input type="text" name="nomor_folder" id="nomor_folder" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>
                        <div>
                            <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi (Opsional)</label>
                            <textarea name="deskripsi" id="deskripsi" rows="3"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
                        </div>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                            Simpan Folder
                        </button>
                    </div>
                </form>
            </div>
            
            {{-- Daftar Folder (CRUD Read) --}}
            @if ($folders->isEmpty())
                <p>Rak {{ $rak->nama_rak }} belum memiliki Folder.</p>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach ($folders as $folder)
                    {{-- Setiap Folder akan mengarah ke Dokumen (Level 5) --}}
                    <a href="{{ route('arsip.dokumen.index', $folder) }}" 
                       class="block bg-gray-100 hover:bg-gray-200 p-4 rounded-lg shadow-sm border border-gray-300 transition duration-150">
                        <p class="text-xl font-bold text-gray-800">Folder: {{ $folder->nomor_folder }}</p>
                        <p class="text-sm text-gray-500 truncate">{{ $folder->deskripsi ?? 'Tidak ada deskripsi' }}</p>
                        <p class="text-xs mt-2 text-gray-400">Arsip Dokumen: {{ $folder->dokumens->count() }}</p>
                    </a>
                @endforeach
            </div>

        </div>
    </div>
</x-app-layout>