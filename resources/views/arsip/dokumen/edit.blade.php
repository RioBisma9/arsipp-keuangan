{{-- resources/views/arsip/dokumen/edit.blade.php --}}

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Dokumen: {{ $dokumen->judul }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ route('arsip.dokumen.index', $folder) }}" class="text-blue-600 hover:text-blue-800 text-sm mb-4 block">
                &larr; Kembali ke Daftar Dokumen
            </a>

            <div class="bg-white p-6 rounded-lg shadow-md">
                {{-- Form action menuju route UPDATE, menggunakan method POST dan directive @method('PUT') --}}
                <form action="{{ route('folder.dokumen.update', [$folder, $dokumen]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') 
                    
                    <div class="space-y-4">
                        <label class="block text-sm font-medium text-gray-700">Judul Dokumen</label>
                        <input type="text" name="judul" value="{{ old('judul', $dokumen->judul) }}" required class="block w-full rounded-md border-gray-300">
                        
                        <label class="block text-sm font-medium text-gray-700">Kode Klasifikasi</label>
                        <input type="text" name="kode_klasifikasi" value="{{ old('kode_klasifikasi', $dokumen->kode_klasifikasi) }}" required class="block w-full rounded-md border-gray-300">
                        
                        <label class="block text-sm font-medium text-gray-700">Nomor Item</label>
                        <input type="text" name="nomor_item" value="{{ old('nomor_item', $dokumen->nomor_item) }}" required class="block w-full rounded-md border-gray-300">
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Ganti File PDF (Kosongkan jika tidak ingin ganti)</label>
                            <input type="file" name="file_pdf" accept="application/pdf" class="mt-1 block w-full">
                            <p class="text-xs text-gray-500 mt-1">File saat ini: <a href="{{ Storage::url($dokumen->file_path) }}" target="_blank" class="text-green-600">Lihat File</a></p>
                        </div>

                        <button type="submit" class="bg-indigo-500 hover:bg-indigo-600 text-white font-bold py-2 px-4 rounded">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>