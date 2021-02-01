<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Posts
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
                <div class="bg-white pt-5 px-4">
                    <livewire:post-search />
                </div>
                <div class="bg-white px-4">
                    <button wire:click="create()"
                            class="inline-flex items-center px-4 py-2 my-3 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-600 focus:outline-none focus:border-green-900 focus:shadow-outline-green disabled:opacity-25 transition ease-in-out duration-150">
                        New Post
                    </button>
                </div>
                @if ($isOpen)
                    @include('livewire.posts.create')
                @endif
            </div>
            @foreach ($posts as $post)
                <div class="mt-4">
                    <div class="max-w-full px-5 py-5 bg-white rounded-lg shadow-md">
                        <div class="mt-0">
                            <a href="{{ url('dashboard/posts', $post->id) }}" class="text-2xl text-gray-700 font-bold hover:underline">
                                {{ $post->title }}
                            </a>
                            <p class="mt-2 text-gray-600">{{ Str::words($post->content, 20, '...') }}</p>
                        </div>
                        <div class="flex justify-between items-center mt-4">
                            <a href="{{ url('dashboard/posts', $post->id) }}" class="text-blue-500 hover:underline">Read more</a>
                            <div>
                                <button wire:click="edit({{ $post->id }})"
                                        class="inline-flex items-center px-1 py-1 bg-yellow-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-500 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                                    <svg class="h-6 w-6 text-white-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"
                                        />
                                    </svg>
                                </button>
                                <button wire:click="delete({{ $post->id }})"
                                        class="inline-flex items-center justify-center px-1 py-1 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                                    <svg class="h-6 w-6 text-white-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                                        />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="py-4">
                {{ $posts->links() }}
            </div>
        </div>
        <div class="-mx-8 w-4/12 hidden lg:block">
            <livewire:category-list/>
            <livewire:tag-list/>
        </div>
    </div>
</div>
