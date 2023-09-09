<div class="relative flex flex-1 flex-col overflow-hidden px-4 py-8 sm:px-6 lg:px-8">
    <div class="relative mx-auto flex w-full max-w-[25.75rem] flex-1 flex-col items-center justify-center pb-16 pt-12">
        <img height="28" width="28" src="{{ Vite::image('mark.svg') }}" alt="Logo Mark" />

        <hgroup class="mt-5 text-center">
            <h2 class="text-lg font-medium text-gray-900">
                Forgot Your Password?
            </h2>
            <p class="mt-3 text-sm/6 text-gray-600">
                Enter your email and we'll send you a link to reset your password.
            </p>
        </hgroup>

        <form x-data wire:submit.prevent="forgotPassword"
            x-on:rate-limited.window="
            toast('Rate limited. Please try again in ' + $event.detail.timeLeft + 's.', {
                type: 'danger'
            });
        "
            class="mt-10 w-full">
            <input type="email" placeholder="Email address" wire:model="email" required autocomplete="email"
                class="block w-full rounded-lg border border-gray-200 bg-white px-3.5 py-2 text-gray-800 placeholder:text-gray-600 sm:text-sm/6 
                @error('email') input-error @enderror" />
            @error('email')
                <p class="text-xs text-red-600 mt-1.5">
                    {{ $message }}
                </p>
            @enderror

            <button type="submit" wire:loading.attr="disabled" wire:target="forgotPassword"
                class="mt-6 block w-full rounded-lg bg-gray-900 px-6 py-2
                text-sm/6 font-semibold text-gray-50 hover:bg-gray-800 focus:outline-offset-2">
                Reset your password
            </button>
        </form>
    </div>
    <div class="flex items-center justify-center">
        <p class="text-sm/6 text-gray-600">
            Not a member?
            <a href="{{ route('register') }}" class="relative text-gray-700 hover:text-gray-600 font-semibold group">
                Get your free account.
                <span
                    class="absolute bottom-0 left-0 w-0 group-hover:w-full ease-out duration-300 h-0.5 bg-gray-600"></span>
            </a>
        </p>
    </div>
</div>
