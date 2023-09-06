<div x-data="editor"
    class="relative flex justify-end max-w-screen-2xl mx-auto bg-white border-x border-gray-100 divide-x divide-gray-100">
    <div id="editor" class="sticky top-0 w-1/2 h-screen">
        <textarea x-ref="editorArea" x-model="content" wire:model="content" spellcheck="false"
            placeholder="🚀 Start noting, start doing. Your tasks come alive with markdown!"
            class="block w-full h-full border-none p-16 focus:outline-none placeholder:text-sm/7 placeholder:text-gray-500 resize-none"></textarea>
    </div>
    <div id="preview" class="basis-1/2">
        <div class="p-16 max-w-none prose prose-gray prose-violet" x-html="new Marked().parse(content)">
        </div>
    </div>
</div>
