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
            <div class="flex justify-between items-center mb-4">
                <!-- Tombol Create -->
                <button wire:click.prevent="create()" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                    <i class="bi bi-plus"></i> Create
                </button>

                <!-- Input Search dengan Icon -->
                <div class="relative w-1/3">
                    <input type="text" wire:model="search" wire:keyup="updateSearch" 
                        placeholder="Search..." 
                        class="border border-gray-300 rounded-md px-4 py-2 w-full focus:outline-none focus:ring focus:border-blue-300 pl-10">
                    <i class="bi bi-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500"></i>
                </div>
            </div>

            <!-- Menampilkan Modal Create/Edit -->
            @if($isOpen)
                @if($post_id)
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
                            <td class="border px-4 py-2 flex justify-center items-center">
                                @if($post->image)
                                    <img src="{{ asset('storage/' . $post->image) }}" alt="Uploaded Image" class="max-w-[120px] max-h-[120px] rounded-md object-contain">
                                @else
                                    <span>No image</span>
                                @endif
                            </td>
                            <td class="border px-4 py-2">
                                <!-- Tombol Edit -->
                                <button wire:click.prevent="edit({{ $post->id }})" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </button>
                                <!-- Tombol Delete -->
                                <button wire:click.prevent="delete({{ $post->id }})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                    <i class="bi bi-trash"></i> Delete
                                </button>
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
