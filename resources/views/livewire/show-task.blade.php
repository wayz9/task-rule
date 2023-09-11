<div class="relative bg-white md:rounded-t-3xl grow shadow-sm md:border-x md:border-t border-gray-900/5">
    <div class="lg:mr-[21.25rem]">
        <hgroup class="pt-9 px-6 md:px-11">
            <p class="text-sm/6 text-gray-500">{{ $task->created_at->format('d F Y') }}</p>
            <h1 class="mt-1.5 text-[1.75rem]/9 font-semibold">
                {{ $task->title }}
                @if ($task->priority)
                    <span
                        class="py-0.5 ml-2 inline-block font-medium px-3 rounded-full text-sm/6 align-middle {{ $task->priority->getPillClasses() }}">
                        {{ $task->priority->name }}
                    </span>
                @endif
            </h1>
        </hgroup>

        {{-- Tailwind Prose Content Here --}}
        <div wire:ignore x-data="markdown({{ Js::from($task->description) }})"
            class="mt-9 mb-16 px-6 md:px-11 max-w-none prose prose-gray prose-violet">
            <div x-show="isLoading" class="not-prose">
                <div class="w-1/3 h-6 bg-gray-100 animate-pulse"></div>
                <div class="mt-4 w-full h-5 bg-gray-100 animate-pulse"></div>
                <div class="mt-1 w-full h-5 bg-gray-100 animate-pulse"></div>
                <div class="mt-1 w-4/5 h-5 bg-gray-100 animate-pulse"></div>

                <div class="mt-8 w-1/3 h-6 bg-gray-100 animate-pulse"></div>
                <div class="mt-4 w-full h-5 bg-gray-100 animate-pulse"></div>
                <div class="mt-1 w-full h-5 bg-gray-100 animate-pulse"></div>

                <div class="mt-8 w-1/2 h-6 bg-gray-100 animate-pulse"></div>
                <div class="mt-4 w-1/6 h-5 bg-gray-100 animate-pulse"></div>
                <div class="mt-2 w-1/6 h-5 bg-gray-100 animate-pulse"></div>
                <div class="mt-2 w-1/6 h-5 bg-gray-100 animate-pulse"></div>
                <div class="mt-6 w-full h-36 bg-gray-100 animate-pulse"></div>

                <div class="mt-8 w-1/3 h-6 bg-gray-100 animate-pulse"></div>
                <div class="mt-4 w-full h-5 bg-gray-100 animate-pulse"></div>
                <div class="mt-1 w-full h-5 bg-gray-100 animate-pulse"></div>
            </div>
            <div x-html="parsedContent"></div>
        </div>
    </div>

    <div class="absolute top-0 inset-y-0 right-0 border-l border-gray-100 w-[21.25rem] hidden lg:block">
        <div class="pt-16">
            <h4 class="px-7 text-base/7 font-semibold">Summary</h4>
            <hgroup class="mt-6 px-7">
                <div class="text-sm/6 font-medium">
                    AI - Echomancer
                    <span
                        class="inline-block text-xs/5 px-2 rounded-full bg-sky-500/10 text-sky-800 font-semibold align-middle">Beta</span>
                </div>
                <p class="mt-2.5 text-sm/6 text-gray-600">
                    Revamp banner: modern CSS, animations, responsive design, typography upgrade, fusion of styles, user
                    accessibility, iterative collaboration.
                </p>
            </hgroup>
            <div class="mt-10 px-7">
                <div class="text-sm/6 font-medium">
                    Actions
                </div>

                <ul class="mt-2.5 flex flex-col gap-y-2.5">
                    <li x-data="{ modalOpen: false }" @keydown.escape.window="modalOpen = false"
                        class="relative z-50 w-auto h-auto">
                        <div class="flex items-center gap-x-1.5">
                            <button x-on:click="modalOpen=true"
                                class="group flex items-center gap-x-2 text-sm/6 font-medium text-gray-800 transition-colors focus:outline-none">
                                <span class="inline-flex text-gray-400 group-hover:text-primary-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.6" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                                    </svg>
                                </span>
                                <span>Collaboration</span>
                            </button>
                            <span
                                class="inline-block text-xs/5 px-2 rounded-full bg-sky-500/10 text-sky-800 font-semibold align-middle">New</span>
                        </div>
                        @teleport('body')
                            <div x-show="modalOpen"
                                class="fixed top-0 left-0 z-[99] flex items-center justify-center w-screen h-screen"
                                x-cloak>
                                <div x-show="modalOpen" x-transition:enter="ease-out duration-300"
                                    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                                    x-transition:leave="ease-in duration-300" x-transition:leave-start="opacity-100"
                                    x-transition:leave-end="opacity-0" x-on:click="modalOpen=false"
                                    class="absolute inset-0 w-full h-full bg-black/[0.15]"></div>
                                <div x-show="modalOpen" x-trap.inert.noscroll="modalOpen"
                                    x-transition:enter="ease-out duration-300"
                                    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                                    x-transition:leave="ease-in duration-200"
                                    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                    class="relative w-full bg-white sm:max-w-lg sm:rounded-2xl border border-gray-200">
                                    <div class="flex items-center justify-between px-9 py-6 border-b border-gray-100">
                                        <div class="flex items-center gap-x-2">
                                            <span class="inline-flex text-gray-500">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                                                </svg>
                                            </span>
                                            <h4 class="text-base/7 font-medium">
                                                Collaboration
                                            </h4>
                                        </div>
                                        <button x-on:click="modalOpen=false"
                                            class="absolute top-0 right-0 flex items-center justify-center w-8 h-8 mt-5 mr-5 text-gray-600 rounded-full hover:text-gray-800 hover:bg-gray-50">
                                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>

                                    <div class="relative w-auto mb-5">
                                        {{-- URL Sharing --}}
                                        <div class="px-9 py-6 border-b border-gray-100">
                                            <hgroup class="text-sm/6">
                                                <div class="font-medium">Collab via URL</div>
                                                <p class="mt-1.5 text-gray-600">
                                                    Make this task visible for the next 24 hours.
                                                </p>
                                            </hgroup>

                                            <div x-data="{
                                                uri: 'https://task-rule.test/shareable/task/359129?cacheKey=12399123',
                                                copyNotification: false,
                                                copyToClipboard() {
                                                    navigator.clipboard.writeText(this.uri);
                                                    this.copyNotification = true;
                                                    let that = this;
                                                    setTimeout(function() {
                                                        that.copyNotification = false;
                                                    }, 3000);
                                                }
                                            }" class="mt-4 flex items-center">
                                                <input type="text" x-data x-on:focus="$el.select()" readonly
                                                    x-model="uri"
                                                    class="block grow rounded-l-lg w-full border border-gray-200 bg-white px-3.5 py-2 text-gray-800 placeholder:text-gray-600 sm:text-sm/6">
                                                <button x-on:click="copyToClipboard()"
                                                    class="border-l-0 px-4 py-2 text-sm/6 font-semibold text-gray-700 border border-gray-200 rounded-r-lg hover:bg-gray-50 focus:outline-offset-2">
                                                    <span x-show="!copyNotification">Copy</span>
                                                    <span x-show="copyNotification">Copied</span>
                                                </button>
                                            </div>
                                        </div>

                                        {{-- Inviting Access --}}
                                        <div class="px-9 py-6 border-b border-gray-100">
                                            <hgroup class="text-sm/6">
                                                <div class="font-medium">
                                                    Invite People
                                                    <span
                                                        class="inline-block text-xs/5 px-2 rounded-full bg-sky-500/10 text-sky-800 font-semibold align-middle">
                                                        New
                                                    </span>
                                                </div>
                                                <p class="mt-1.5 text-gray-600">
                                                    Share this task with only people you invited.
                                                </p>
                                            </hgroup>

                                            <div class="mt-4 flex items-center">
                                                <input type="email" placeholder="Email address"
                                                    class="block grow rounded-l-lg w-full border border-gray-200 bg-white px-3.5 py-2 text-gray-800 placeholder:text-gray-600 sm:text-sm/6">
                                                <button
                                                    class="border-l-0 px-4 py-2 text-sm/6 font-semibold text-gray-700 border border-gray-200 rounded-r-lg hover:bg-gray-50 focus:outline-offset-2">Invite</button>
                                            </div>

                                            <div class="mt-2.5 flex items-center gap-x-1 text-xs text-gray-600">
                                                <div class="inline-flex">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1" stroke="currentColor"
                                                        class="w-4 h-4">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                                                    </svg>
                                                </div>
                                                <span>
                                                    Invites are only sent to existing users on <span
                                                        class="font-medium text-gray-800">{{ config('app.name') }}</span>.
                                                </span>
                                            </div>
                                        </div>

                                        {{-- Email Sharing --}}
                                        <div class="px-9 py-6 border-b border-gray-100">
                                            <hgroup class="text-sm/6">
                                                <div class="font-medium">
                                                    Email Sharing
                                                    <span
                                                        class="inline-block text-xs/5 px-2 rounded-full bg-sky-500/10 text-sky-800 font-semibold align-middle">
                                                        Coming Soon
                                                    </span>
                                                </div>
                                                <p class="mt-1.5 text-gray-600">
                                                    Email a copy of the task to your friend or colleagues.
                                                </p>
                                            </hgroup>

                                            <div class="mt-4 flex items-center">
                                                <input type="email" placeholder="Email address" disabled
                                                    class="block grow rounded-l-lg w-full border border-gray-200 bg-white px-3.5 py-2 text-gray-800 placeholder:text-gray-600 sm:text-sm/6 disabled:bg-gray-50 disabled:cursor-not-allowed">
                                                <button disabled
                                                    class="border-l-0 px-4 py-2 text-sm/6 font-semibold text-gray-700 border border-gray-200 rounded-r-lg hover:bg-gray-50 focus:outline-offset-2 disabled:bg-gray-50 disabled:cursor-not-allowed">Invite</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endteleport
                    </li>
                    <li>
                        <a href="{{ route('tasks.edit', $task) }}" wire:navigate.hover
                            class="group flex items-center gap-x-2 text-sm/6 font-medium text-gray-800 transition-colors focus:outline-none">
                            <span class="inline-flex text-gray-400 group-hover:text-primary-500">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                    <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                    <path d="M16 5l3 3" />
                                </svg>
                            </span>
                            <span>Edit task</span>
                        </a>
                    </li>
                    <li>
                        <button
                            class="group flex items-center gap-x-2 text-sm/6 font-medium text-gray-800 transition-colors focus:outline-none">
                            <span class="inline-flex text-gray-400 group-hover:text-primary-500">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                    class="w-5 h-5">
                                    <path fill-rule="evenodd"
                                        d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"
                                        clip-rule="evenodd" />
                                </svg>
                            </span>
                            <span>Mark as complete</span>
                        </button>
                    </li>
                    <li>
                        <button wire:click="downloadTXT" wire:loading.attr="disabled" wire:target="downloadTXT"
                            class="group flex items-center gap-x-2 text-sm/6 font-medium text-gray-800 transition-colors focus:outline-none">
                            <span class="inline-flex text-gray-400 group-hover:text-primary-500">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                    class="w-5 h-5">
                                    <path
                                        d="M10.75 2.75a.75.75 0 00-1.5 0v8.614L6.295 8.235a.75.75 0 10-1.09 1.03l4.25 4.5a.75.75 0 001.09 0l4.25-4.5a.75.75 0 00-1.09-1.03l-2.955 3.129V2.75z" />
                                    <path
                                        d="M3.5 12.75a.75.75 0 00-1.5 0v2.5A2.75 2.75 0 004.75 18h10.5A2.75 2.75 0 0018 15.25v-2.5a.75.75 0 00-1.5 0v2.5c0 .69-.56 1.25-1.25 1.25H4.75c-.69 0-1.25-.56-1.25-1.25v-2.5z" />
                                </svg>
                            </span>
                            <span>Download as TXT</span>
                        </button>
                    </li>
                    <li>
                        <button
                            class="group flex items-center gap-x-2 text-sm/6 font-medium text-gray-800 transition-colors focus:outline-none">
                            <span class="inline-flex text-gray-400 group-hover:text-primary-500">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.8" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6z" />
                                </svg>
                            </span>
                            <span>Add tags</span>
                        </button>
                    </li>
                    <li>
                        <button
                            class="group flex items-center gap-x-2 text-sm/6 font-medium text-gray-800 transition-colors focus:outline-none">
                            <span class="inline-flex text-gray-400 group-hover:text-primary-500">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.7" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0z" />
                                </svg>
                            </span>
                            <span>Bookmark task</span>
                        </button>
                    </li>
                </ul>
            </div>

            <div class="mt-10 px-7">
                <div class="text-sm/6 font-medium">
                    Storage
                </div>

                <ul class="mt-2.5 flex flex-col gap-y-2.5">
                    @foreach (['some_file.pdf', 'figma_image_drawing.svg', 'tailwindcss_logo.png'] as $item)
                        <li>
                            <a href="#"
                                class="group flex items-center gap-x-2 text-sm/6 font-medium text-gray-800 transition-colors focus:outline-none">
                                <span class="inline-flex text-gray-400 group-hover:text-sky-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.8" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                    </svg>
                                </span>
                                <span class="line-clamp-1">{{ $item }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="mt-10 px-7">
                <div class="text-sm/6 font-medium">
                    Links
                </div>
                <ul class="mt-2.5 flex flex-col gap-y-2.5">
                    @forelse ($urls as $link)
                        <li>
                            <a href="{{ $link }}" target="_blank"
                                class="group flex items-center gap-x-2 text-sm/6 font-medium text-gray-800 transition-colors focus:outline-none">
                                <span class="inline-flex text-gray-400 group-hover:text-violet-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                        class="w-5 h-5">
                                        <path
                                            d="M12.232 4.232a2.5 2.5 0 013.536 3.536l-1.225 1.224a.75.75 0 001.061 1.06l1.224-1.224a4 4 0 00-5.656-5.656l-3 3a4 4 0 00.225 5.865.75.75 0 00.977-1.138 2.5 2.5 0 01-.142-3.667l3-3z" />
                                        <path
                                            d="M11.603 7.963a.75.75 0 00-.977 1.138 2.5 2.5 0 01.142 3.667l-3 3a2.5 2.5 0 01-3.536-3.536l1.225-1.224a.75.75 0 00-1.061-1.06l-1.224 1.224a4 4 0 105.656 5.656l3-3a4 4 0 00-.225-5.865z" />
                                    </svg>
                                </span>
                                <span class="line-clamp-1">{{ str($link)->replace('https://', '') }}</span>
                            </a>
                        </li>
                    @empty
                        <li>
                            <p class="text-sm/6 text-gray-500 italic">No links found.</p>
                        </li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>

    <x-ribbon />
</div>
