<div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400">
  <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
    
    <div class="fixed inset-0 transition-opacity">
      <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
    </div>
  
    <!-- This element is to trick the browser into centering the modal contents. -->
    <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>

    <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
      <form wire:submit.prevent="store">
        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
          <div>
            <!-- Judul Form Edit -->
          <div class="text-xl font-semibold text-gray-700 mb-4" id="modal-headline">
            Create
          </div>
            <!-- Input Title -->
            <div class="mb-4">
              <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Title:</label>
              <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                id="title" placeholder="Enter Title" wire:model.defer="title">
              @error('title') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <!-- Input Description -->
            <div class="mb-4">
              <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Description:</label>
              <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                id="description" wire:model.defer="description" placeholder="Enter description"></textarea>
              @error('description') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <!-- Input Image -->
            <!-- Input Image -->
            <div class="mb-4">
                <label for="image" class="block text-gray-700 text-sm font-bold mb-2">Image:</label>
                <input type="file" wire:model="image" id="image" class="border border-gray-300 rounded-md px-4 py-2 w-full focus:outline-none focus:ring focus:border-blue-300">

            <!-- Display existing image if available -->
            @if($image && $image instanceof \Illuminate\Http\UploadedFile)
                <div class="flex justify-center mt-2 relative">
                    <!-- Menampilkan gambar yang diupload -->
                    <img src="{{ $image->temporaryUrl() }}" class="max-w-[120px] max-h-[120px] rounded-md object-contain" alt="Uploaded Image">
                </div>
            @elseif($imagePath) <!-- Cek jika $imagePath ada -->
                <div class="flex justify-center mt-2 relative">
                    <!-- Menampilkan gambar lama -->
                    <img src="{{ asset('storage/' . $imagePath) }}" class="max-w-[120px] max-h-[120px] rounded-md object-contain" alt="Existing Image">
                    
                    <!-- Icon tempat sampah untuk menghapus gambar -->
                    <button type="button" wire:click="removeImage" class="absolute top-0 right-0 bg-white rounded-full p-1 text-red-500 hover:bg-gray-200 focus:outline-none">
                        <!-- Ikon tempat sampah menggunakan Bootstrap Icons -->
                        <i class="bi bi-trash"></i>
                    </button>
                </div>
            @endif

                @error('image') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
          </div>
        </div>

        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
          <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
            <button type="submit" class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5">
              Save
            </button>
          </span>
          <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
            <button wire:click="closeModal()" type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
              Cancel
            </button>
          </span>
        </div>
      </form>
    </div>
  </div>
</div>
