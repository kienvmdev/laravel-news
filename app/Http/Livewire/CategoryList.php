<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Livewire\Component;

class CategoryList extends Component
{
    public function render()
    {
        return view('livewire.category-list', [
            'categories' => Category::all()
        ]);
    }
}
