{{-- resources/views/arsip/box/index.blade.php --}}

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $jenisArsip->nama }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-4 text-sm text-gray-600">
                <a href="{{ route('arsip.index') }}" class="text-blue-600 hover:text-blue-800">
                    &larr; Kembali ke Jenis Arsip
                </a>
            </div>
            
            @if ($boxes->isEmpty())
                <p>Belum ada Box arsip untuk jenis {{ $jenisArsip->nama }} ini.</p>
            @endif

            @foreach ($boxes as $box)
                {{-- Setiap Box akan mengarah ke Rak (Level 3) --}}
                <a href="{{ route('arsip.rak.index', $box) }}" 
                   class="block bg-blue-500 hover:bg-blue-600 text-white p-4 my-2 rounded-lg shadow-md transition duration-150">
                    <p class="text-lg font-bold">Box {{ $box->nomor_box }}</p>
                    <p class="text-sm">Tahun Arsip: {{ $box->tahun }}</p>
                </a>
            @endforeach
        </div>
    </div>
</x-app-layout>