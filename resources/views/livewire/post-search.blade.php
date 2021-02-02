<div class="relative">
    <input
        type="text"
        class="form-input w-full"
        placeholder="Search Posts..."
        wire:model="query"
        wire:keydown.escape="reset"
        wire:keydown.tab="reset"
        wire:keydown.ArrowUp="decrementHighlight"
        wire:keydown.ArrowDown="incrementHighlight"
        wire:keydown.enter="selectPost"/>

    @if(!empty($query))
        <div class="fixed top-0 right-0 bottom-0 left-0" wire:click="reset"></div>

        <div class="absolute p-4 z-10 list-group bg-white w-full rounded-t-none shadow-lg">
            @if(!empty($posts))
                @foreach($posts as $i => $post)
                    <a href="{{ url('dashboard/posts', $post['id']) }}"
                        class="list-item text-blue-600 hover:underline {{ $highlightIndex === $i ? 'highlight' : '' }}">
                        {{ $post['title'] }}
                    </a>
                    <br/>
                @endforeach
            @else
                <div class="list-item">
                    <p class="text-red-400">No results!</p>
                </div>
            @endif
            <!--<div wire:loading class="absolute z-10 list-group bg-white w-full rounded-t-none shadow-lg">
                <div class="list-item">
                    <p class="text-red-400">Searching...</p>
                </div>
            </div>-->
        </div>
    @endif
</div>
