<div class="bg-white md:rounded-t-3xl grow shadow-sm md:border-x md:border-t border-gray-900/5">
    <hgroup class="py-8 md:py-10 md:mb-4 px-6 md:text-center md:mx-auto max-w-md">
        <h1 class="text-lg font-medium">Welcome back, {{ auth()->user()->name }}</h1>
        <p class="mt-2.5 text-sm/6 text-gray-600">Stay organized and on top of your responsibilities with a comprehensive
            view of all your tasks.</p>
    </hgroup>

    <div class="relative">
        <div x-data="tabs({{ Js::from($this->categories) }})" class="relative bg-white overflow-hidden border-y border-gray-100 border-b-gray-200">
            <div x-ref="tabs" class="overflow-x-auto scrollbar-none mr-[5.375rem] md:mr-[10rem]">
                <ul class="md:ml-6 flex whitespace-nowrap">
                    <template x-for="(tab, index) in tabs">
                        <li :key="index">
                            <a wire:navigate.hover :href="tab.route" x-text="tab.name"
                                class="block py-3.5 px-6 text-sm/6 border-b transition-colors"
                                :class="tab.active ?
                                    'text-gray-900 font-semibold border-gray-800' :
                                    'text-gray-500 hover:text-gray-800 font-medium border-transparent hover:border-gray-600'">
                            </a>
                        </li>
                    </template>
                </ul>
            </div>

            <div x-ref="leftShadow"
                class="absolute left-0 inset-y-0 w-4 bg-gray-400 blur-2xl pointer-events-none transition-opacity duration-500">
            </div>
            <div x-ref="rightShadow"
                class="absolute right-0 inset-y-0 w-4 bg-gray-400 blur-2xl mr-[5.375rem] md:mr-[10rem] pointer-events-none transition-opacity duration-500">
            </div>

            <div class="absolute right-0 pl-6 pr-2.5 md:pr-7 border-l border-gray-200 inset-y-0 bg-white">
                <button class="hidden h-full md:flex items-center gap-x-1 border-b border-transparent">
                    <span class="text-sm/6 font-medium">Accessibility</span>
                    <span class="inline-flex text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                            <path fill-rule="evenodd"
                                d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                                clip-rule="evenodd" />
                        </svg>
                    </span>
                </button>

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
                <li x-data="contextMenu" x-on:contextmenu="contextMenuToggle(event)"
                    x-on:contextmenu.away="contextMenuOpen=false"
                    class="relative z-10 flex items-center justify-between whitespace-nowrap gap-x-8">
                    <div class="flex items-center gap-x-2">
                        <a wire:navigate.hover href="{{ route('tasks.show', $task) }}" class="text-sm/6 font-medium">
                            &nbsp;<span class="tabular-nums">{{ $index + 1 }}</span>.
                            {{ $task->title }}
                        </a>
                        @if ($task->priority)
                            <div
                                class="text-[13px]/[22px] font-medium py-0.5 px-3 rounded-full first-letter:uppercase {{ $task->priority->getPillClasses() }}">
                                {{ $task->priority->getRealName() }}
                            </div>
                        @endif
                    </div>
                    <div class="text-sm/6 text-gray-600 text-right">{{ now()->format('d-M-y') }}</div>
                    @teleport('body')
                        <div x-show="contextMenuOpen" @click.away="contextMenuOpen=false" x-ref="contextmenu"
                            class="z-40 min-w-[8rem] text-neutral-800 rounded-md border border-neutral-200/70 bg-white text-sm fixed p-1 shadow-md w-64"
                            x-cloak>

                        </div>
                    @endteleport
                </li>
            @endforeach
        </ul>
    </div>

    <div id="new-task"
        class="fixed bottom-0 z-50 max-w-screen-xl mx-auto pb-4 inset-x-0 w-full border-t border-gray-200 bg-white border-x border-x-gray-900/5">
        <div x-data="{
            value: '',
            addNewTask() {
                if (this.value.length <= 3) {
                    return;
                }
        
                $wire.add();
                this.value = '';
        
                setTimeout(() => {
                    window.scrollTo({
                        top: document.body.scrollHeight,
                        behavior: 'smooth',
                    });
                }, 75)
            }
        }" class="relative h-14" x-on:keydown.ctrl.space.window="$refs.value.focus()"
            x-on:keydown.escape="value = ''; $refs.value.blur()">
            <input type="text" placeholder="What's on your mind?" x-model="value" x-ref="value"
                wire:model="taskForm.title" x-on:keydown.enter="addNewTask()" wire:target="add"
                wire:loading.attr="disabled"
                class="block w-full h-full bg-white px-8 pl-[62px] text-sm/6 placeholder:text-gray-500 placeholder:font-normal text-gray-900 font-medium focus:outline-none focus:ring-1 focus:ring-gray-300 rounded-lg disabled:bg-gray-50 disabled:cursor-not-allowed">
            <div class="absolute left-8 top-1/2 -translate-y-1/2 text-gray-500">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 -mb-px">
                    <path
                        d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z" />
                </svg>
            </div>

            <div x-show="value.length == 0" class="absolute top-1/2 -translate-y-1/2 left-[13.25rem] hidden md:block">
                <div class="-mb-1 py-1 px-3 border border-gray-200 text-xs font-semibold rounded-md">
                    Control + Space
                </div>
            </div>
        </div>
    </div>

    <x-ribbon />

    <script>
        function setupScrollListener() {
            function updateShadows() {
                const scrollLeft = this.$refs.tabs.scrollLeft;
                const maxScrollLeft = this.$refs.tabs.scrollWidth - this.$refs.tabs.clientWidth;

                this.$refs.leftShadow.style.display = scrollLeft > 0 ? 'block' : 'none';
                this.$refs.rightShadow.style.display = scrollLeft < maxScrollLeft ? 'block' : 'none';
            }

            updateShadows();

            this.$refs.tabs.addEventListener('scroll', updateShadows);
        }
    </script>
</div>
