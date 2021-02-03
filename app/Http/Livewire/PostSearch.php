<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class PostSearch extends Component
{
    public $query;
    public $cate_id;
    public $tag_id;
    public $posts;
    public $highlightIndex;

    public function mount(){}

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
        $query = Post::where('title', 'like', '%' . $this->query . '%')
            ->orWhere('content', 'like', '%' . $this->query . '%');
        if($this->cate_id > 0) {
            $query->where('category_id', $this->cate_id);
        }
        if($this->tag_id > 0) {
            $posts = DB::table('post_tag')
                ->where('tag_id',$this->tag_id)
                ->pluck('post_id')
                ->toArray();
            $query->whereIn('id', $posts);
        }
        $this->posts = $query->get()
            ->toArray();
    }

    public function render()
    {
        return view('livewire.post-search');
    }
}
