{{-- resources/views/arsip/dokumen/index.blade.php --}}

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Folder: {{ $folder->nomor_folder }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-6 flex justify-between items-center">
                <a href="{{ route('arsip.folder.index', $folder->rak) }}" class="text-blue-600 hover:text-blue-800 text-sm">
                    &larr; Kembali ke Daftar Folder
                </a>
                {{-- Tombol untuk menampilkan Form Upload Dokumen --}}
                <button 
                    onclick="document.getElementById('form-upload-dokumen').classList.toggle('hidden')" 
                    class="bg-purple-500 hover:bg-purple-600 text-white font-bold py-2 px-4 rounded">
                    ⬆️ Unggah Dokumen Baru
                </button>
            </div>
            
            {{-- Form Upload Dokumen (CRUD Create) --}}
            <div id="form-upload-dokumen" class="hidden bg-white p-6 rounded-lg shadow-md mb-6">
                <h3 class="text-lg font-semibold mb-4">Form Unggah Dokumen (PDF)</h3>
                {{-- PERHATIKAN: enctype="multipart/form-data" HARUS ada untuk upload file --}}
                <form action="{{ route('folder.dokumen.store', $folder) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="space-y-4">
                        <input type="text" name="judul" placeholder="Judul Dokumen (Kepada)" required class="block w-full rounded-md border-gray-300">
                        <input type="text" name="kode_klasifikasi" placeholder="Kode Klasifikasi" required class="block w-full rounded-md border-gray-300">
                        <input type="text" name="nomor_item" placeholder="Nomor Item" required class="block w-full rounded-md border-gray-300">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">File PDF (Maks 10MB)</label>
                            <input type="file" name="file_pdf" accept="application/pdf" required class="mt-1 block w-full">
                        </div>
                        <button type="submit" class="bg-purple-500 hover:bg-purple-600 text-white font-bold py-2 px-4 rounded">
                            Simpan & Unggah Dokumen
                        </button>
                    </div>
                </form>
            </div>
            
            {{-- Daftar Dokumen (CRUD Read) --}}
            @if ($dokumens->isEmpty())
                <p>Folder ini belum memiliki dokumen arsip.</p>
            @endif

            <div class="bg-white shadow-md rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul / Kepada</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kode Klasifikasi</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($dokumens as $dokumen)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $dokumen->judul }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $dokumen->kode_klasifikasi }} (No. Item: {{ $dokumen->nomor_item }})</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                {{-- Link untuk melihat/mengunduh PDF --}}
                                <a href="{{ Storage::url($dokumen->file_path) }}" target="_blank" class="text-indigo-600 hover:text-indigo-900">
                                    Lihat PDF
                                </a>
                                {{-- Tombol Edit dan Delete (Akan diimplementasikan di fase selanjutnya) --}}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>