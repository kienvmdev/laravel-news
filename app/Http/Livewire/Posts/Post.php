<?php

namespace App\Http\Livewire\Posts;

use App\Models\Category;
use App\Models\Post as PostModel;
use App\Models\Tag;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Post extends Component
{
    use AuthorizesRequests;

    public $post;
    public $title, $category, $post_id;
    public $theme = 'default';
    public $content = null;
    public $tagids = array();
    public $categories = array();
    public $tags = array();
    public $isOpen = 0;

    public function mount($id)
    {
        $this->post = PostModel::with(['author', 'comments', 'category', 'tags'])->find($id);
        $this->post_id = $id;
        $this->title = $this->post->title;
        $this->content = $this->post->content;
        $this->theme = $this->post->theme;
        $this->category = $this->post->category_id;
        $this->tagids = $this->post->tags->pluck('id');
        $this->categories = Category::all();
        $this->tags = Tag::all();
    }

    public function render()
    {
        return view('livewire.posts.post');
    }

    public function edit()
    {
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

    public function backToList()
    {
        return redirect()->route('posts');
    }

    public function store()
    {
        $this->validate([
            'title' => 'required',
            'content' => 'required',
            'category' => 'required',
        ]);

        // Update or Insert Post
        $post = \App\Models\Post::updateOrCreate(['id' => $this->post_id], [
            'title' => $this->title,
            'content' => $this->content,
            'theme' => $this->theme,
            'category_id' => intVal($this->category),
            'author_id' => Auth::user()->id,
        ]);

        // Post Tag mapping
        if (count($this->tagids) > 0) {
            DB::table('post_tag')->where('post_id', $post->id)->delete();

            foreach ($this->tagids as $tagid) {
                DB::table('post_tag')->insert([
                    'post_id' => $post->id,
                    'tag_id' => intVal($tagid),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        session()->flash(
            'message',
            $this->post_id ? 'Post Updated Successfully.' : 'Post Created Successfully.'
        );

        $this->closeModal();

        return redirect()->route('post', ['id' => $this->post_id]);
    }

    public function delete($id)
    {
        PostModel::find($id)->delete();
        DB::table('post_tag')->where('post_id', $id)->delete();
        session()->flash('message', 'Post Deleted Successfully.');

        return redirect('/dashboard/posts');
    }
}
