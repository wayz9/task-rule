<div x-data="editor({{ Js::from($task->description) }})" class="relative flex justify-end max-w-screen-2xl mx-auto bg-white border-x border-gray-100">
    <section id="editor" class="sticky top-0 w-1/2 h-screen overscroll-contain border-r border-gray-100 pb-24">
        <textarea x-on:input.debounce="updateParsedContent" x-ref="editorArea" x-model="content" wire:model="content"
            x-on:theme-switched.window="updateParsedContent" spellcheck="false"
            placeholder="🚀 Start noting, start doing. Your tasks come alive with markdown!"
            class="block w-full h-full border-none p-16 focus:outline-none placeholder:text-sm/7 placeholder:text-gray-500 resize-none"></textarea>

        <div id="tool-sidebar" class="absolute -mr-px right-full inset-y-0 flex flex-col items-end gap-y-1.5 pt-32">
            <div
                class="mb-8 py-2 px-4 border border-r-0 border-gray-100 bg-white rounded-l-lg text-xs uppercase font-semibold text-gray-600 whitespace-nowrap">
                Markdown v0.1.0
            </div>
            <button x-on:click="insertCodeBlock" aria-label="Insert code block" title="Insert code block"
                class="inline-flex items-center justify-center w-11 h-11 border border-r-0 border-gray-100 bg-white rounded-l-lg">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" width="22" height="22">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M14.25 9.75L16.5 12l-2.25 2.25m-4.5 0L7.5 12l2.25-2.25M6 20.25h12A2.25 2.25 0 0020.25 18V6A2.25 2.25 0 0018 3.75H6A2.25 2.25 0 003.75 6v12A2.25 2.25 0 006 20.25z" />
                </svg>
            </button>
            <button x-on:click="insertUrlSyntax" aria-label="Insert URL" title="Insert URL"
                class="inline-flex items-center justify-center w-11 h-11 border border-r-0 border-gray-100 bg-white rounded-l-lg">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                    <path
                        d="M12.232 4.232a2.5 2.5 0 013.536 3.536l-1.225 1.224a.75.75 0 001.061 1.06l1.224-1.224a4 4 0 00-5.656-5.656l-3 3a4 4 0 00.225 5.865.75.75 0 00.977-1.138 2.5 2.5 0 01-.142-3.667l3-3z" />
                    <path
                        d="M11.603 7.963a.75.75 0 00-.977 1.138 2.5 2.5 0 01.142 3.667l-3 3a2.5 2.5 0 01-3.536-3.536l1.225-1.224a.75.75 0 00-1.061-1.06l-1.224 1.224a4 4 0 105.656 5.656l3-3a4 4 0 00-.225-5.865z" />
                </svg>
            </button>
            <button x-on:click="insertTableSyntax" aria-label="Insert Table" title="Insert Table"
                class="inline-flex items-center justify-center w-11 h-11 border border-r-0 border-gray-100 bg-white rounded-l-lg">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.2"
                    stroke="currentColor" width="22" height="22">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3.375 19.5h17.25m-17.25 0a1.125 1.125 0 01-1.125-1.125M3.375 19.5h7.5c.621 0 1.125-.504 1.125-1.125m-9.75 0V5.625m0 12.75v-1.5c0-.621.504-1.125 1.125-1.125m18.375 2.625V5.625m0 12.75c0 .621-.504 1.125-1.125 1.125m1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125m0 3.75h-7.5A1.125 1.125 0 0112 18.375m9.75-12.75c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125m19.5 0v1.5c0 .621-.504 1.125-1.125 1.125M2.25 5.625v1.5c0 .621.504 1.125 1.125 1.125m0 0h17.25m-17.25 0h7.5c.621 0 1.125.504 1.125 1.125M3.375 8.25c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125m17.25-3.75h-7.5c-.621 0-1.125.504-1.125 1.125m8.625-1.125c.621 0 1.125.504 1.125 1.125v1.5c0 .621-.504 1.125-1.125 1.125m-17.25 0h7.5m-7.5 0c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125M12 10.875v-1.5m0 1.5c0 .621-.504 1.125-1.125 1.125M12 10.875c0 .621.504 1.125 1.125 1.125m-2.25 0c.621 0 1.125.504 1.125 1.125M13.125 12h7.5m-7.5 0c-.621 0-1.125.504-1.125 1.125M20.625 12c.621 0 1.125.504 1.125 1.125v1.5c0 .621-.504 1.125-1.125 1.125m-17.25 0h7.5M12 14.625v-1.5m0 1.5c0 .621-.504 1.125-1.125 1.125M12 14.625c0 .621.504 1.125 1.125 1.125m-2.25 0c.621 0 1.125.504 1.125 1.125m0 1.5v-1.5m0 0c0-.621.504-1.125 1.125-1.125m0 0h7.5" />
                </svg>
            </button>
            <button x-on:click="alert('todo')" aria-label="Open Settings" title="Open Settings"
                class="inline-flex items-center justify-center w-11 h-11 border border-r-0 border-gray-100 bg-white rounded-l-lg">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.4"
                    stroke="currentColor" width="22" height="22">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
            </button>

            <button x-on:click="alert('todo')" aria-label="Show Markdown syntax" title="Show Markdown syntax"
                class="inline-flex items-center justify-center w-11 h-11 border border-r-0 border-gray-100 bg-white rounded-l-lg">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" width="22" height="22">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                </svg>
            </button>
        </div>
    </section>

    <aside id="preview" class="basis-1/2">
        <div class="p-16 pb-32 max-w-none prose prose-gray prose-violet" x-html="parsedContent">
        </div>
    </aside>

    <div class="fixed bottom-0 inset-x-0 mx-auto max-w-screen-2xl border-t border-gray-200 bg-white">
        <div class="py-4 px-16 flex items-center justify-between h-full">
            <hgroup>
                <p class="text-xs text-gray-600">Currently Editing</p>
                <h2 class="mt-1 text-base font-semibold text-gray-800">
                    {{ $task->title }}
                </h2>
            </hgroup>

            <div class="flex items-center gap-x-4">
                <a href="{{ route('tasks.show', $task) }}"
                    class="rounded-lg border border-gray-200 px-4 py-2 text-sm/6 font-semibold text-gray-700 hover:bg-gray-50 focus:outline-offset-2">Cancel</a>
                <button wire:click="save()" wire:loading.attr="disabled" wire:target="save"
                    class="rounded-lg bg-gray-900 px-4 py-2 text-sm/6 font-semibold text-gray-50 hover:bg-gray-800 focus:outline-offset-2">
                    Save Changes
                </button>
            </div>
        </div>
    </div>
</div>
