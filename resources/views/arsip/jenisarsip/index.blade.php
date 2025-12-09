

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Keuangan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @foreach ($jenisArsips as $jenis)
                {{-- Setiap item akan mengarah ke Box (Level 2) --}}
                <a href="{{ route('arsip.box.index', $jenis) }}" 
                   class="block bg-blue-500 hover:bg-blue-600 text-white p-4 my-2 rounded-lg shadow-md transition duration-150">
                    <p class="text-lg font-bold">{{ $jenis->nama }}</p>
                </a>
            @endforeach
        </div>
    </div>
</x-app-layout>