<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="flex p-4">
                    {{-- Button Create --}}
                    <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                        Create
                    </button>
                </div>
                    {{-- Row Perpage dan Searching --}}
                    <div class="p-4 grid grid-cols-2 gap-4 items-center">
                        {{-- ROW PER PAGE (Kiri) --}}
                        <div>
                            <select wire:model.live="perPage" id="perPage" class="w-24 border border-gray-300 rounded-md px-2 py-1 focus:ring focus:border-blue-300">
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                            </select>
                        </div>

                        {{-- SEARCHING (Kanan) --}}
                        <div class="relative">
                            <input wire:model.live="search" type="text" placeholder="Search" class="border border-gray-300 rounded-md px-4 py-2 w-full focus:outline-none focus:ring focus:border-blue-300 pl-10">
                            <i class="bi bi-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500"></i>
                        </div>
                    </div>
                {{-- Table Product --}}
                <div class="relative overflow-x-auto p-4">
                    <table class="table-fixed w-full">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Description
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Price
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Image
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- menampilkan data products --}}
                            @foreach ($products as $index => $product)
                            <tr>
                            <td class="border px-4 py-2">{{ $product->name }}</td>
                            <td class="border px-4 py-2">{{ $product->description }}</td>
                            <td class="border px-4 py-2">{{ $product->price }}</td>
                            <td class="border px-4 py-2">{{ $product->image }}</td>
                            <td class="border px-4 py-2">{{ $product->action }}</td>
                            </tr>
                            @endforeach
                            {{-- menampilkan data products --}}
                        </tbody>
                    </table>
                    <div class="p-4 mt-4">
                        {{ $products->links() }}
                    </div>
                </div>

                </div>
            </div>
        </div>
    </div>
</div>

