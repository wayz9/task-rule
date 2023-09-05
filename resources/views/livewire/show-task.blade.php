<div class="relative bg-white md:rounded-t-3xl grow shadow-sm md:border-x md:border-t border-gray-900/5">
    <div class="lg:mr-[21.25rem]">
        <hgroup class="pt-9 px-6 md:px-11">
            <p class="text-sm/6 text-gray-500">{{ now()->format('d F Y') }}</p>
            <h1 class="mt-1.5 text-[1.75rem]/9 font-semibold">
                Update the CSS styles for the hero section.
                <span
                    class="py-0.5 ml-2 inline-block font-medium px-3 rounded-full bg-violet-500/10 text-violet-800 text-sm/6 align-middle">
                    Important
                </span>
            </h1>
        </hgroup>

        {{-- Tailwind Prose Content Here --}}
        <div class="mt-9 mb-16 px-6 md:px-11 max-w-none prose prose-gray prose-violet">
            <h3>Getting started</h3>
            <p>By default, Tailwind removes all of the default browser styling from paragraphs, headings, lists and
                more. This ends up being really useful for building application UIs because you spend less time
                undoing user-agent styles, but when you <em>really are</em> just trying to style some content that
                came from a rich-text editor in a CMS or a markdown file, it can be surprising and unintuitive.</p>
            <p>We get lots of complaints about it actually, with people regularly asking us things like:</p>
            <blockquote>
                <p>Why is Tailwind removing the default styles on my <code>h1</code> elements? How do I disable
                    this? What do you mean I lose all the other base styles too?</p>
            </blockquote>
            <p>We hear you, but we're not convinced that simply disabling our base styles is what you really want.
                You don't want to have to remove annoying margins every time you use a <code>p</code> element in a
                piece of your dashboard UI. And I doubt you really want your blog posts to use the user-agent styles
                either — you want them to look <em>awesome</em>, not awful.</p>
            <p>The <code>@tailwindcss/typography</code> plugin is our attempt to give you what you <em>actually</em>
                want, without any of the downsides of doing something stupid like disabling our base styles.</p>
            <p>It adds a new <code>prose</code> class that you can slap on any block of vanilla HTML content and
                turn it into a beautiful, well-formatted document:</p>
            <pre><code class="language-html">&lt;article class="prose"&gt;
            &lt;h1&gt;Garlic bread with cheese: What the science tells us&lt;/h1&gt;
            &lt;p&gt;
                For years parents have espoused the health benefits of eating garlic bread with cheese to their
                children, with the food earning such an iconic status in our culture that kids will often dress
                up as warm, cheesy loaf for Halloween.
            &lt;/p&gt;
            &lt;p&gt;
                But a recent study shows that the celebrated appetizer may be linked to a series of rabies cases
                springing up around the country.
            &lt;/p&gt;
            &lt;!-- ... --&gt;
            &lt;/article&gt;
            </code></pre>
            <p>For more information about how to use the plugin and the features it includes, <a
                    href="https://github.com/tailwindcss/typography/blob/master/README.md">read the
                    documentation</a>.</p>
            <hr />
            <h2>What to expect from here on out</h2>
            <p>What follows from here is just a bunch of absolute nonsense I've written to dogfood the plugin
                itself. It includes every sensible typographic element I could think of, like <strong>bold
                    text</strong>, unordered lists, ordered lists, code blocks, block quotes, <em>and even
                    italics</em>.</p>
            <p>It's important to cover all of these use cases for a few reasons:</p>
            <ol>
                <li>We want everything to look good out of the box.</li>
                <li>Really just the first reason, that's the whole point of the plugin.</li>
                <li>Here's a third pretend reason though a list with three items looks more realistic than a list
                    with two items.</li>
            </ol>
            <p>Now we're going to try out another header style.</p>
            <h3>Typography should be easy</h3>
            <p>So that's a header for you — with any luck if we've done our job correctly that will look pretty
                reasonable.</p>
            <p>Something a wise person once told me about typography is:</p>
            <blockquote>
                <p>Typography is pretty important if you don't want your stuff to look like trash. Make it good then
                    it won't be bad.</p>
            </blockquote>
            <p>It's probably important that images look okay here by default as well:</p>
            <figure>
                <img src="https://images.unsplash.com/photo-1556740758-90de374c12ad?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=crop&amp;w=1000&amp;q=80"
                    alt="" />
                <figcaption>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a
                    piece of classical Latin literature from 45 BC, making it over 2000 years old.</figcaption>
            </figure>
            <p>Now I'm going to show you an example of an unordered list to make sure that looks good, too:</p>
            <ul>
                <li>So here is the first item in this list.</li>
                <li>In this example we're keeping the items short.</li>
                <li>Later, we'll use longer, more complex list items.</li>
            </ul>
            <p>And that's the end of this section.</p>
            <h2>What if we stack headings?</h2>
            <h3>We should make sure that looks good, too.</h3>
            <p>Sometimes you have headings directly underneath each other. In those cases you often have to undo the
                top margin on the second heading because it usually looks better for the headings to be closer
                together than a paragraph followed by a heading should be.</p>
            <h3>When a heading comes after a paragraph …</h3>
            <p>When a heading comes after a paragraph, we need a bit more space, like I already mentioned above. Now
                let's see what a more complex list would look like.</p>
            <ul>
                <li>
                    <p><strong>I often do this thing where list items have headings.</strong></p>
                    <p>For some reason I think this looks cool which is unfortunate because it's pretty annoying to
                        get the styles right.</p>
                    <p>I often have two or three paragraphs in these list items, too, so the hard part is getting
                        the spacing between the paragraphs, list item heading, and separate list items to all make
                        sense. Pretty tough honestly, you could make a strong argument that you just shouldn't write
                        this way.</p>
                </li>
                <li>
                    <p><strong>Since this is a list, I need at least two items.</strong></p>
                    <p>I explained what I'm doing already in the previous list item, but a list wouldn't be a list
                        if it only had one item, and we really want this to look realistic. That's why I've added
                        this second list item so I actually have something to look at when writing the styles.</p>
                </li>
                <li>
                    <p><strong>It's not a bad idea to add a third item either.</strong></p>
                    <p>I think it probably would've been fine to just use two items but three is definitely not
                        worse, and since I seem to be having no trouble making up arbitrary things to type, I might
                        as well include it.</p>
                </li>
            </ul>
            <p>After this sort of list I usually have a closing statement or paragraph, because it kinda looks weird
                jumping right to a heading.</p>
            <h2>Code should look okay by default.</h2>
            <p>I think most people are going to use <a href="https://highlightjs.org/">highlight.js</a> or <a
                    href="https://prismjs.com/">Prism</a> or something if they want to style their code blocks but
                it wouldn't hurt to make them look <em>okay</em> out of the box, even with no syntax highlighting.
            </p>
            <p>Here's what a default <code>tailwind.config.js</code> file looks like at the time of writing:</p>
            <pre><code class="language-js">module.exports = {
            purge: [],
            theme: {
              extend: {},
            },
            variants: {},
            plugins: [],
          }
          </code></pre>
            <p>Hopefully that looks good enough to you.</p>
            <h3>What about nested lists?</h3>
            <p>Nested lists basically always look bad which is why editors like Medium don't even let you do it, but
                I guess since some of you goofballs are going to do it we have to carry the burden of at least
                making it work.</p>
            <ol>
                <li>
                    <strong>Nested lists are rarely a good idea.</strong>
                    <ul>
                        <li>You might feel like you are being really "organized" or something but you are just
                            creating a gross shape on the screen that is hard to read.</li>
                        <li>Nested navigation in UIs is a bad idea too, keep things as flat as possible.</li>
                        <li>Nesting tons of folders in your source code is also not helpful.</li>
                    </ul>
                </li>
                <li>
                    <strong>Since we need to have more items, here's another one.</strong>
                    <ul>
                        <li>I'm not sure if we'll bother styling more than two levels deep.</li>
                        <li>Two is already too much, three is guaranteed to be a bad idea.</li>
                        <li>If you nest four levels deep you belong in prison.</li>
                    </ul>
                </li>
                <li>
                    <strong>Two items isn't really a list, three is good though.</strong>
                    <ul>
                        <li>Again please don't nest lists if you want people to actually read your content.</li>
                        <li>Nobody wants to look at this.</li>
                        <li>I'm upset that we even have to bother styling this.</li>
                    </ul>
                </li>
            </ol>
            <p>The most annoying thing about lists in Markdown is that <code>&lt;li&gt;</code> elements aren't given
                a child <code>&lt;p&gt;</code> tag unless there are multiple paragraphs in the list item. That means
                I have to worry about styling that annoying situation too.</p>
            <ul>
                <li>
                    <p><strong>For example, here's another nested list.</strong></p>
                    <p>But this time with a second paragraph.</p>
                    <ul>
                        <li>These list items won't have <code>&lt;p&gt;</code> tags</li>
                        <li>Because they are only one line each</li>
                    </ul>
                </li>
                <li>
                    <p><strong>But in this second top-level list item, they will.</strong></p>
                    <p>This is especially annoying because of the spacing on this paragraph.</p>
                    <ul>
                        <li>
                            <p>As you can see here, because I've added a second line, this list item now has a
                                <code>&lt;p&gt;</code> tag.
                            </p>
                            <p>This is the second line I'm talking about by the way.</p>
                        </li>
                        <li>
                            <p>Finally here's another list item so it's more like a list.</p>
                        </li>
                    </ul>
                </li>
                <li>
                    <p>A closing list item, but with no nested list, because why not?</p>
                </li>
            </ul>
            <p>And finally a sentence to close off this section.</p>
            <h2>There are other elements we need to style</h2>
            <p>I almost forgot to mention links, like <a href="https://tailwindcss.com">this link to the Tailwind
                    CSS website</a>. We almost made them blue but that's so yesterday, so we went with dark gray,
                feels edgier.</p>
            <p>We even included table styles, check it out:</p>
            <table>
                <thead>
                    <tr>
                        <th>Wrestler</th>
                        <th>Origin</th>
                        <th>Finisher</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Bret "The Hitman" Hart</td>
                        <td>Calgary, AB</td>
                        <td>Sharpshooter</td>
                    </tr>
                    <tr>
                        <td>Stone Cold Steve Austin</td>
                        <td>Austin, TX</td>
                        <td>Stone Cold Stunner</td>
                    </tr>
                    <tr>
                        <td>Randy Savage</td>
                        <td>Sarasota, FL</td>
                        <td>Elbow Drop</td>
                    </tr>
                    <tr>
                        <td>Vader</td>
                        <td>Boulder, CO</td>
                        <td>Vader Bomb</td>
                    </tr>
                    <tr>
                        <td>Razor Ramon</td>
                        <td>Chuluota, FL</td>
                        <td>Razor's Edge</td>
                    </tr>
                </tbody>
            </table>
            <p>We also need to make sure inline code looks good, like if I wanted to talk about
                <code>&lt;span&gt;</code> elements or tell you the good news about
                <code>@tailwindcss/typography</code>.
            </p>
            <h3>Sometimes I even use <code>code</code> in headings</h3>
            <p>Even though it's probably a bad idea, and historically I've had a hard time making it look good. This
                <em>"wrap the code blocks in backticks"</em> trick works pretty well though really.
            </p>
            <p>
                Another thing I've done in the past is put a <code>code</code> tag inside of a link, like if I
                wanted to tell you about the <a
                    href="https://github.com/tailwindcss/docs"><code>tailwindcss/docs</code></a> repository. I don't
                love that there is an underline below the backticks but it is absolutely not worth the madness it
                would require to avoid it.
            </p>
            <h4>We haven't used an <code>h4</code> yet</h4>
            <p>But now we have. Please don't use <code>h5</code> or <code>h6</code> in your content, Medium only
                supports two heading levels for a reason, you animals. I honestly considered using a
                <code>before</code> pseudo-element to scream at you if you use an <code>h5</code> or
                <code>h6</code>.
            </p>
            <p>We don't style them at all out of the box because <code>h4</code> elements are already so small that
                they are the same size as the body copy. What are we supposed to do with an <code>h5</code>, make it
                <em>smaller</em> than the body copy? No thanks.
            </p>
            <h3>We still need to think about stacked headings though.</h3>
            <h4>Let's make sure we don't screw that up with <code>h4</code> elements, either.</h4>
            <p>Phew, with any luck we have styled the headings above this text and they look pretty good.</p>
            <p>Let's add a closing paragraph here so things end with a decently sized block of text. I can't explain
                why I want things to end that way but I have to assume it's because I think things will look weird
                or unbalanced if there is a heading too close to the end of the document.</p>
            <p>What I've written here is probably long enough, but adding this final sentence can't hurt.</p>
        </div>
    </div>

    <div class="absolute top-0 inset-y-0 right-0 border-l border-gray-100 w-[21.25rem] hidden lg:block">
        <div class="sticky top-0 pt-16">
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
                            <button @click="modalOpen=true"
                                class="group flex items-center gap-x-2 text-sm/6 font-medium text-gray-800 transition-colors focus:outline-none">
                                <span class="inline-flex text-gray-400 group-hover:text-primary-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.8" stroke="currentColor" class="w-5 h-5">
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
                                    x-transition:leave-end="opacity-0" @click="modalOpen=false"
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
                                        <button @click="modalOpen=false"
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
                                                <button @click="copyToClipboard(uri)"
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
                        <button
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
                    @foreach (['github.com/wayz9', 'google.com/q?search+terms', 'task-rule.test/task/very-long-url-repeated-forever'] as $item)
                        <li>
                            <a href="#"
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
                                <span class="line-clamp-1">{{ $item }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <x-ribbon />
</div>
