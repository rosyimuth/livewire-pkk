<div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400">
  <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">

    <div class="fixed inset-0 transition-opacity">
      <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
    </div>

    <!-- This element is to trick the browser into centering the modal contents. -->
    <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>

    <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
      <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
        <div>
          <!-- Judul Detail -->
          <div class="text-xl font-semibold text-gray-700 mb-4" id="modal-headline">
            Detail Data
          </div>
          
          <!-- Menampilkan Title -->
          <div class="mb-4">
            <p class="text-gray-700 text-sm font-bold">Title:</p>
            <p class="text-gray-900">{{ $title }}</p>
          </div>

          <!-- Menampilkan Description -->
          <div class="mb-4">
            <p class="text-gray-700 text-sm font-bold">Description:</p>
            <p class="text-gray-900">{{ $description }}</p>
          </div>

          <!-- Menampilkan Image -->
          <div class="mb-4">
            <p class="text-gray-700 text-sm font-bold">Image:</p>
            @if($imagePath)
              <div class="flex justify-center mt-2">
                <img src="{{ asset('storage/' . $imagePath) }}" class="max-w-[120px] max-h-[120px] rounded-md object-contain" alt="Image">
              </div>
            @else
              <p class="text-gray-500">No image available</p>
            @endif
          </div>
        </div>
      </div>

      <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
        <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
          <button wire:click="closeModal()" type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
            Close
          </button>
        </span>
      </div>
    </div>
  </div>
</div>
