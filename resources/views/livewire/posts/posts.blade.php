<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Tips
    </h2>
</x-slot>
<div class="px-6 py-8">
    <div class="flex justify-between container mx-auto">
        <div class="w-full lg:w-8/12">
            <div class="mt-0">
                @if (session()->has('message'))
                    <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3"
                         role="alert">
                        <div class="flex">
                            <div>
                                <p class="text-sm">{{ session('message') }}</p>
                            </div>
                        </div>
                    </div>
                @endif
                @auth
                <div class="bg-white px-4 text-right">
                    <button wire:click="create()" class="inline-flex items-center px-4 py-2 mt-2 bg-green-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-600 focus:outline-none focus:border-green-900 focus:shadow-outline-green disabled:opacity-25 transition ease-in-out duration-150">
                        New Tips
                    </button>
                </div>
                @endif
                <div class="bg-white py-4 px-4">
                    @livewire('post-search', ['cate_id' => @$cid, 'tag_id' => @$tid])
                </div>
                @if ($isOpen)
                    @include('livewire.posts.create')
                @endif
            </div>
            <div class="bg-white mt-4 pb-4 pt-4">
                @foreach ($posts as $post)
                    <div class="max-w-full pl-4 pr-4 bg-white rounded-lg">
                        <div class="mt-0">
                            <a href="{{ url('dashboard/posts', $post->id) }}" class="text-xl text-blue-600 font-medium hover:underline">
                                {{ $post->title }}
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="py-4">
                {{ $posts->links() }}
            </div>
        </div>
        <div class="-mx-8 w-4/12 hidden lg:block">
            <div class="mt-0 px-5">
                <h1 class="mb-2 text-xl font-bold text-gray-700">Categories</h1>
                <div class="flex flex-col bg-white px-4 py-4 max-w-sm mx-auto rounded-lg shadow-md">
                    <ul>
                        @foreach ($categories as $cate)
                            <li>
                                <a href="{{ url('dashboard/categories/'. $cate->id .'/posts') }}" class="text-blue-600 font-semibold mx-1 hover:text-blue-600 hover:underline">
                                    {{$cate->title}}
                                </a>
                                <span class="text-gray-800">({{$cate->posts_count}})</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="mt-5 px-5">
                <h1 class="mb-2 text-xl font-bold text-gray-700">Tags</h1>
                <div class="bg-white px-4 py-6 max-w-sm mx-auto rounded-lg shadow-md">
                    @foreach ($tags as $tag)
                        <a href="{{ url('dashboard/tags/'. $tag->id .'/posts') }}" class="text-gray-700 font-bold mx-1 hover:text-gray-600">
                            <span class="m-2 bg-gray-200 hover:bg-gray-500 rounded-full px-1 my-2 font-semibold text-sm leading-loose cursor-pointer" >#{{$tag->title}} ({{$tag->posts_count}})</span>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
