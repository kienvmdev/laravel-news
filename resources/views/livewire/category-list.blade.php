<div class="mt-0 px-5">
    <h1 class="mb-4 text-xl font-bold text-gray-700">Categories</h1>
    <div class="flex flex-col bg-white px-4 py-4 max-w-sm mx-auto rounded-lg shadow-md">
        <ul>
            @foreach ($categories as $cate)
            <li>
                <a href="{{ url('dashboard/categories/'. $cate->id .'/posts') }}" class="text-blue-600 font-bold mx-1 hover:text-blue-600 hover:underline">
                    {{$cate->title}}
                </a>
            </li>
            @endforeach
        </ul>
    </div>
</div>
