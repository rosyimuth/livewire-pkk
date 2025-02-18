<?php

namespace App\Livewire\Post;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    public $isOpen = false;
    public $title, $description, $post_id;
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
    }

    public function store()
    {
    $this->validate([
        'title' => 'required',
        'description' => 'required',
    ]);

    Post::updateOrCreate(['id' => $this->post_id], [
        'title' => $this->title,
        'description' => $this->description
    ]);

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

        $this->openModal();
    }

    public function delete($id)
    {
        Post::find($id)->delete();
        session()->flash('message', 'Post Deleted Successfully.');
    }
}
