<?php
namespace App\Http\Livewire\Posts;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;


class Posts extends Component
{
    use WithPagination,AuthorizesRequests;

    public $title, $category, $post_id;
    public $theme = 'default';
    public $content = null;
    public $tagids = array();
    public $isOpen = 0;

    public function render()
    {
        return view('livewire.posts.posts', [
            'posts' => Post::orderBy('id', 'desc')->simplePaginate(),
            'categories' => Category::all(),
            'tags' => Tag::all(),
        ]);
    }

    public function store()
    {
        $this->validate([
            'title' => 'required',
            'content' => 'required',
            'category' => 'required',
        ]);

        // Update or Insert Post
        $post = Post::updateOrCreate(['id' => $this->post_id], [
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
        $this->resetInputFields();
    }

    public function delete($id)
    {
        Post::find($id)->delete();
        DB::table('post_tag')->where('post_id', $id)->delete();

        session()->flash('message', 'Post Deleted Successfully.');

        return redirect('/dashboard/posts');
    }

    public function edit($id)
    {
        $post = Post::with('tags')->findOrFail($id);

        $this->post_id = $id;
        $this->title = $post->title;
        $this->content = $post->content;
        $this->theme = $post->theme;
        $this->category = $post->category_id;
        $this->tagids = $post->tags->pluck('id');

        $this->openModal();
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
        $this->title = null;
        $this->content = null;
        $this->theme = 'default';
        $this->category = null;
        $this->tagids = null;
        $this->post_id = null;
    }
}
