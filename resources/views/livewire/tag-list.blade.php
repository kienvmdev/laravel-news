<div class="mt-5 px-5">
    <h1 class="mb-4 text-xl font-bold text-gray-700">Tags</h1>
    <div class="bg-white px-4 py-6 max-w-sm mx-auto rounded-lg shadow-md">
        @foreach ($tags as $tag)
            <a href="{{ url('dashboard/tags/'. $tag->id .'/posts') }}" class="text-gray-700 font-bold mx-1 hover:text-gray-600 hover:underline">
                <span class="m-1 bg-gray-200 hover:bg-gray-300 rounded-full px-2 font-bold text-sm leading-loose cursor-pointer" >#{{$tag->title}}</span>
            </a>
        @endforeach
    </div>
</div>
