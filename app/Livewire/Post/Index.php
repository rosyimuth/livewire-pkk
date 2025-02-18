<?php

namespace App\Livewire\Post;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Index extends Component
{
    use WithPagination, WithFileUploads;

    public $isOpen = false;
    public $image, $title, $description, $post_id;
    public $imagePath = null;  // Properti untuk menyimpan path gambar lama
    public $search = '';

    public function render()
    {
        return view('livewire.post.index', [
            'posts' => Post::where('title', 'like', '%' . $this->search . '%')
                ->latest()
                ->paginate(5)
        ]);
    }

    public function updateSearch()
    {
        $this->resetPage(); // Reset pagination ke halaman pertama setelah pencarian
    }

    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    private function resetInputFields()
    {
        $this->title = '';
        $this->description = '';
        $this->post_id = '';
        $this->image = null;
        $this->imagePath = null; // Reset path gambar juga
    }

    public function store()
{
    // Validasi input
    $this->validate([
        'title' => 'required',
        'description' => 'required',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    // Menyimpan gambar jika ada
    $imagePath = null;
    if ($this->image) {
        // Jika ada gambar baru, simpan dan ambil path-nya
        $imagePath = $this->image->store('posts', 'public'); // Menyimpan gambar ke folder 'posts'
    } elseif ($this->post_id) {
        // Jika tidak ada gambar baru dan ini adalah edit, gunakan gambar lama
        $post = Post::find($this->post_id);
        $imagePath = $post->image; // Menggunakan gambar yang lama
    }

    // Menyimpan data post ke database
    Post::updateOrCreate(['id' => $this->post_id], [
        'title' => $this->title,
        'description' => $this->description,
        'image' => $imagePath,
    ]);

    // Menampilkan pesan sukses
    session()->flash('message', 
        $this->post_id ? 'Post Updated Successfully.' : 'Post Created Successfully.');

    $this->closeModal();
    $this->resetInputFields();
}

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $this->post_id = $id;
        $this->title = $post->title;
        $this->description = $post->description;

        // Set gambar lama jika ada
        $this->imagePath = $post->image; // Set gambar lama di sini

        $this->openModal();
    }

    public function removeImage()
    {
        // Menghapus gambar yang sedang dipilih
        $this->image = null;
        $this->imagePath = null; // Pastikan path juga di-reset jika gambar dihapus
    }
    
    public function delete($id)
    {
        $post = Post::find($id);

        // Menghapus gambar dari storage jika ada
        if ($post && $post->image) {
            // Pastikan path gambar yang disimpan adalah relatif terhadap folder public
            $imagePath = 'public/' . $post->image;
            if (Storage::exists($imagePath)) {
                // Menghapus gambar dari storage
                Storage::delete($imagePath);
            }
        }

        // Menghapus post dari database
        $post->delete();

        session()->flash('message', 'Post Deleted Successfully.');
    }
}
