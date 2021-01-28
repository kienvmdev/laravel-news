<div class="flex flex-row flex-grow mb-4">
    <div class="py-3 flex-1">
        <h3 class="text-lg">Input</h3>
        <textarea wire:model="content" id="content" class="border h-22 w-full p-2 h-full text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter Content"></textarea>
        <!-- <textarea rows="10" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="content" wire:model="content" placeholder="Enter Content"></textarea> -->
    </div>
    <div class="p-3 flex-1">
        <h3 class="text-lg">Output</h3>
        <div class="border h-22 w-full p-2 h-full">
            @markdom($content)
        </div>
    </div>
</div>