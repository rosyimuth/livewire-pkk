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
    public $isShow = false;
    public $image, $title, $description, $post_id;
    public $imagePath = null;
    public $search = '';
    public $perPage = 5;

    protected $queryString = ['search', 'perPage'];

    public function render()
    {
        return view('livewire.post.index', [
            'posts' => Post::where('title', 'like', '%' . $this->search . '%')
                ->latest()
                ->paginate($this->perPage)
        ]);
    }

    public function updatePerPage()
    {
        $this->resetPage();
    }

    public function updateSearch()
    {
        $this->resetPage();
    }

    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);
        $this->fillPostData($post);
        $this->isShow = true;
        $this->isOpen = true;
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $this->fillPostData($post);
        $this->isShow = false;
        $this->openModal();
    }

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->isShow = false;
    }

    private function resetInputFields()
    {
        $this->reset(['title', 'description', 'post_id', 'image', 'imagePath']);
    }

    private function fillPostData($post)
    {
        $this->post_id = $post->id;
        $this->title = $post->title;
        $this->description = $post->description;
        $this->imagePath = $post->image;
    }

    public function store()
    {
        $this->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($this->image) {
            $imagePath = $this->image->store('posts', 'public');
        } elseif ($this->post_id) {
            $imagePath = Post::find($this->post_id)->image ?? null;
        } else {
            $imagePath = null;
        }

        Post::updateOrCreate(
            ['id' => $this->post_id],
            [
                'title' => $this->title,
                'description' => $this->description,
                'image' => $imagePath,
            ]
        );

        session()->flash('message', $this->post_id ? 'Post Updated Successfully.' : 'Post Created Successfully.');

        $this->closeModal();
        $this->resetInputFields();
        $this->resetPage();
    }

    public function removeImage()
    {
        if ($this->imagePath) {
            // Hapus file dari storage
            if (Storage::exists('public/' . $this->imagePath)) {
                Storage::delete('public/' . $this->imagePath);
            }

            // Jika sedang edit post, update database agar gambar dihapus permanen
            if ($this->post_id) {
                Post::where('id', $this->post_id)->update(['image' => null]);
            }

            // Reset variabel
            $this->imagePath = null;
        }

        $this->image = null;
    }
    
    public function delete($id)
    {
        $post = Post::find($id);

        if ($post && $post->image) {
            $imagePath = 'public/' . $post->image;
            if (Storage::exists($imagePath)) {
                Storage::delete($imagePath);
            }
        }

        $post->delete();

        session()->flash('message', 'Post Deleted Successfully.');
        $this->resetPage();
    }
}
