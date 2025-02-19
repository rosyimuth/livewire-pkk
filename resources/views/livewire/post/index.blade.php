<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Post
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">

            <!-- Pesan Flash -->
            @if (session()->has('message'))
                <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3" role="alert">
                    <div class="flex">
                        <div>
                            <p class="text-sm">{{ session('message') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Tombol Create dan Input Search -->
            <div class="mb-4">
                <!-- Tombol Create -->
                <button wire:click.prevent="create()" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                    <i class="bi bi-plus"></i> Create
                </button>

                <!-- Baris baru untuk perPage dan Search -->
                <div class="flex justify-between items-center mt-2">
                    <!-- Dropdown perPage di pojok kiri -->
                    <div>
                        <select wire:model.live="perPage" id="perPage" class="w-24 border border-gray-300 rounded-md px-2 py-1 focus:ring focus:border-blue-300">
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                        </select>
                    </div>
                    <!-- Input Search di pojok kanan -->
                    <div class="relative w-1/3">
                        <input type="text" wire:model="search" wire:keyup="updateSearch" 
                            placeholder="Search" 
                            class="border border-gray-300 rounded-md px-4 py-2 w-full focus:outline-none focus:ring focus:border-blue-300 pl-10">
                        <i class="bi bi-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500"></i>
                    </div>
                </div>
            </div>

            <!-- Menampilkan Modal Create/Edit/Show -->
            @if($isOpen)
                @if($isShow)
                    @include('livewire.post.show') <!-- Menampilkan form show -->
                @elseif($post_id)
                    @include('livewire.post.edit') <!-- Menampilkan form edit -->
                @else
                    @include('livewire.post.create') <!-- Menampilkan form create -->
                @endif
            @endif

            <!-- Tabel Data Post -->
            <table class="table-fixed w-full">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 w-20">No.</th>
                        <th class="px-4 py-2">Title</th>
                        <th class="px-4 py-2">Description</th>
                        <th class="px-4 py-2">Image</th>
                        <th class="px-4 py-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($posts as $index => $post)
                        <tr>
                            <td class="border px-4 py-2">{{ $posts->firstItem() + $loop->index }}</td>
                            <td class="border px-4 py-2">{{ $post->title }}</td>
                            <td class="border px-4 py-2">{{ $post->description }}</td>
                            <td class="border px-4 py-2">
                        <div class="flex justify-center flex-wrap overflow-hidden">
                                @if($post->image)
                                    <img src="{{ asset('storage/' . $post->image) }}" alt="Uploaded Image" class="max-w-[80px] max-h-[80px] rounded-md object-contain">
                                @else
                                    <span>No image</span>
                                @endif
                            </td>
                            <td class="border px-4 py-2">
                            <div class="flex justify-center flex-wrap gap-1 overflow-hidden">
                                <!-- Tombol Show -->
                                <button wire:click.prevent="show({{ $post->id }})" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-2 rounded">
                                    <i class="bi bi-eye"></i> Show
                                </button>
                                <!-- Tombol Edit -->
                                <button wire:click.prevent="edit({{ $post->id }})" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-2 rounded">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </button>
                                <!-- Tombol Delete -->
                                <button wire:click.prevent="delete({{ $post->id }})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-2 rounded">
                                    <i class="bi bi-trash"></i> Delete
                                </button>
                            </div>
                        </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Paginasi -->
            <div class="mt-4">
                {{ $posts->links() }}
            </div>

        </div>
    </div>
</div>
