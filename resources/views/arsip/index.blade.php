{{-- resources/views/arsip/index.blade.php --}}

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Keuangan
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Bagian ini harus ada --}}
            @foreach ($jenisArsips as $item)
                <a href="{{ route('arsip.box.index', $item) }}" class="block bg-blue-500 hover:bg-blue-600 text-white p-4 mb-4 rounded-lg shadow-md">
                    {{ $item->nama }}
                </a>
            @endforeach
        </div>
    </div>
</x-app-layout>