<div class="bg-white md:rounded-t-3xl grow shadow-sm md:border-x md:border-t border-gray-900/5">
    <hgroup class="py-8 md:py-10 md:mb-4 px-6 md:text-center md:mx-auto max-w-md">
        <h1 class="text-lg font-medium">Welcome back, {{ auth()->user()->name }}</h1>
        <p class="mt-2.5 text-sm/6 text-gray-600">Stay organized and on top of your responsibilities with a comprehensive
            view of all your tasks.</p>
    </hgroup>

    <div class="relative">
        <div id="tabs" class="sticky top-0 border-y border-gray-100 border-b-gray-200 bg-white">
            <ul class="-mb-px md:ml-8 flex overflow-hidden hover:overflow-x-auto whitespace-nowrap pr-[62px]">
                <li>
                    <button class="py-3.5 px-6 text-sm/6 font-semibold text-gray-900 border-b border-gray-600">
                        All Tasks
                    </button>
                </li>
                <li>
                    <button
                        class="py-3.5 px-6 text-sm/6 font-medium text-gray-500 hover:text-gray-800 border-b border-transparent hover:border-gray-600 transition-colors">
                        Work
                    </button>
                </li>
            </ul>

            <div class="absolute right-0 pr-2.5 md:pr-7 inset-y-0 bg-white">
                <div class="hidden md:flex items-center gap-x-7 h-full">
                    <button class="flex items-center gap-x-1">
                        <span class="inline-flex text-gray-500 -mt-0.5">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="w-4 h-4">
                                <path fill-rule="evenodd"
                                    d="M12 3.75a.75.75 0 01.75.75v6.75h6.75a.75.75 0 010 1.5h-6.75v6.75a.75.75 0 01-1.5 0v-6.75H4.5a.75.75 0 010-1.5h6.75V4.5a.75.75 0 01.75-.75z"
                                    clip-rule="evenodd" />
                            </svg>
                        </span>
                        <span class="text-sm/6 font-medium">New Category</span>
                    </button>

                    <button class="flex items-center gap-x-1">
                        <span class="text-sm/6 font-medium">Show only</span>
                        <span class="inline-flex text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                class="w-5 h-5">
                                <path fill-rule="evenodd"
                                    d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                                    clip-rule="evenodd" />
                            </svg>
                        </span>
                    </button>

                    <button class="flex items-center gap-x-1">
                        <span class="text-sm/6 font-medium">Sort by</span>
                        <span class="inline-flex text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                class="w-5 h-5">
                                <path fill-rule="evenodd"
                                    d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                                    clip-rule="evenodd" />
                            </svg>
                        </span>
                    </button>
                </div>

                <button class="p-3.5 text-gray-500 md:hidden">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M6.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM12.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM18.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                    </svg>
                </button>
            </div>
        </div>

        <ul id="tasks" class="divide-y divide-gray-100 [&>*]:px-8 [&>*]:h-14 overflow-x-auto mb-[4.5rem] grid">
            @foreach ($tasks as $index => $task)
                <li class="flex items-center justify-between whitespace-nowrap gap-x-8">
                    <div class="flex items-center gap-x-2">
                        <p class="text-sm/6 font-medium">
                            &nbsp;<span class="tabular-nums">{{ $index + 1 }}</span>.
                            {{ $task['title'] }}
                        </p>
                        @if ($task['priority'])
                            <div @class([
                                'text-[13px]/[22px] font-medium py-0.5 px-3 rounded-full first-letter:uppercase',
                                'bg-violet-500/10 text-violet-800' => $task['priority'] === 'important',
                                'bg-yellow-500/10 text-yellow-700' => $task['priority'] === 'moderate',
                                'bg-gray-100 text-gray-700' => $task['priority'] === 'trivial',
                            ])>
                                {{ $task['priority'] }}
                            </div>
                        @endif
                    </div>
                    <div class="text-sm/6 text-gray-600 text-right">{{ now()->format('d-M-y') }}</div>
                </li>
            @endforeach
        </ul>
    </div>

    <div id="new-task"
        class="fixed bottom-0 max-w-screen-xl mx-auto pb-4 inset-x-0 w-full border-t border-gray-200 bg-white border-x border-x-gray-900/5">
        <div x-data="{ newTask: '' }" class="relative h-14">
            <input type="text" placeholder="Add new task to the category" x-model="newTask"
                class="block w-full h-full px-8 pl-[62px] text-sm/6 placeholder:text-gray-500 placeholder:font-normal text-gray-900 font-medium focus:outline-none focus:ring-1 focus:ring-gray-300 rounded-lg">
            <div class="absolute left-8 top-1/2 -translate-y-1/2 text-gray-500">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 -mb-px">
                    <path
                        d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z" />
                </svg>
            </div>

            <div x-show="newTask.length == 0" class="absolute top-1/2 -translate-y-1/2 left-[276px]">
                <div class="-mb-1 py-1 px-3 border border-gray-200 text-xs font-semibold rounded-md">
                    Control + Space
                </div>
            </div>
        </div>
    </div>

    <div class="hidden md:block absolute -right-2 -top-2 h-40 w-40 overflow-hidden">
        <span class="absolute top-0 h-2 w-2 bg-primary-600"></span>
        <span class="absolute bottom-0 right-0 h-2 w-2 bg-primary-600"></span>
        <div
            class="absolute bottom-0 right-0 block w-[calc(100%*1.4142)] origin-bottom-right rotate-45 bg-primary-300 p-2 text-center text-sm leading-tight">
            <span class="text-xs font-semibold uppercase text-primary-700">
                App Version 0.1.0
            </span>
            <br />
            <span class="font-bold">Currently In Beta</span>
        </div>
    </div>
</div>
