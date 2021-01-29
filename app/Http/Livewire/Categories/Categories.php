<?php

namespace App\Http\Livewire\Categories;

use App\Models\Category;
use Livewire\Component;

class Categories extends Component
{
    public $categories, $title, $desc, $category_id;
    public $isOpen = 0;

    public function render()
    {
        $this->categories = Category::all();
        return view('livewire.categories.categories');
    }

    public function store()
    {
        $this->validate([
            'title' => 'required',
            'desc' => 'required',
        ]);

        Category::updateOrCreate(['id' => $this->category_id], [
            'title' => $this->title,
            'desc' => $this->desc
        ]);

        session()->flash(
            'message',
            $this->category_id ? 'Category Updated Successfully.' : 'Category Created Successfully.'
        );

        $this->closeModal();
        $this->resetInputFields();
    }

    public function delete($id)
    {
        Category::find($id)->delete();
        session()->flash('message', 'Category Deleted Successfully.');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $this->category_id = $id;
        $this->title = $category->title;
        $this->desc = $category->desc;

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
        $this->title = '';
        $this->desc = '';
        $this->category_id = '';
    }
}
