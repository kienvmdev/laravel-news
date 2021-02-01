<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;

class PostSearch extends Component
{
    public $query;
    public $posts;
    public $highlightIndex;

    public function mount()
    {
        $this->reset('query', 'posts', 'highlightIndex');
    }

    public function resetFrom()
    {
        $this->query = '';
        $this->posts = [];
        $this->highlightIndex = 0;
    }

    public function incrementHighlight()
    {
        if ($this->highlightIndex === count($this->posts) - 1) {
            $this->highlightIndex = 0;
            return;
        }
        $this->highlightIndex++;
    }

    public function decrementHighlight()
    {
        if ($this->highlightIndex === 0) {
            $this->highlightIndex = count($this->posts) - 1;
            return;
        }
        $this->highlightIndex--;
    }

    public function selectPost()
    {
        $post = $this->posts[$this->highlightIndex] ?? null;
        if ($post) {
            $this->redirect(route('posts', $post['id']));
        }
    }

    public function updatedQuery()
    {
        $this->posts = Post::where('title', 'like', '%' . $this->query . '%')
            ->get()
            ->toArray();
    }

    public function render()
    {
        return view('livewire.post-search');
    }
}
