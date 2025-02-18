<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
    <i class="bi bi-pie-chart"></i> Counter
    </h2>
</x-slot>
<div>
    <div class="flex flex-col items-center justify-center p-6 bg-white rounded-lg shadow-md max-w-md mx-auto mt-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-4">Hello SIJA</h1>
        {{--mencetak nilai variabel di blade--}}
        <div class="flex items-center space-x-4 mb-4">
            <button wire:click="increment" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600 transition duration-200">+</button>
            <button wire:click="decrement" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600 transition duration-200">-</button>
        </div>

        <h2 class="text-4xl font-semibold text-gray-700">{{ $count }}</h2>
    </div>
</div>
