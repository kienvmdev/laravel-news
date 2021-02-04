<?php

namespace App\Http\Livewire\Categories;

use App\Models\Category;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Categories extends Component
{
    use AuthorizesRequests;

    public $title, $desc, $category_id, $parent_id;
    public $isOpen = 0;

    public function render()
    {
        return view('livewire.categories.categories', [
            'categories'=>Category::orderBy('id', 'desc')->paginate(10),
            'cates'=>Category::where('parent_id', 0)->get()
        ]);
    }

    public function store()
    {
        $this->validate([
            'title' => 'required',
            'desc' => 'required',
        ]);

        Category::updateOrCreate(['id' => $this->category_id], [
            'title' => $this->title,
            'desc' => $this->desc,
            'parent_id' => $this->parent_id,
        ]);

        session()->flash(
            'message',
            $this->category_id ? 'Category Updated Successfully.' : 'Category Created Successfully.'
        );

        $this->closeModal();
        $this->resetInputFields();

        return redirect('/dashboard/categories');
    }

    public function delete($id)
    {
        Category::find($id)->delete();
        session()->flash('message', 'Category Deleted Successfully.');

        return redirect('/dashboard/categories');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $this->category_id = $id;
        $this->title = $category->title;
        $this->desc = $category->desc;
        $this->parent_id = $category->parent_id;

        $this->openModal();

        return redirect('/dashboard/categories');
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
        $this->desc = '';
        $this->category_id = '';
        $this->parent_id = '';
    }
}
