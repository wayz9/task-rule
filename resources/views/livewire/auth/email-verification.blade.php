<div class="relative flex flex-1 flex-col overflow-hidden px-4 py-8 sm:px-6 lg:px-8">
    <div class="relative mx-auto flex w-full max-w-[25.75rem] flex-1 flex-col items-center justify-center pb-16 pt-12">
        <img height="28" width="28" src="{{ Vite::image('mark.svg') }}" alt="Logo Mark" />
        <hgroup class="mt-5 text-center">
            <h2 class="text-lg font-medium text-gray-900">
                Confirm Your Email Address
            </h2>
            <p class="mt-3 text-sm/6 text-gray-600">
                To ensure the security of your account, we need to verify your email address.
            </p>
        </hgroup>
        <form x-data
            x-on:rate-limited.window="
                toast('Rate limited. Please try again in ' + $event.detail.timeLeft + 's.', {
                    type: 'danger'
                });
            "
            wire:submit.prevent="requestVerificationEmail" class="mt-10 w-full">
            <input type="email" value="{{ auth()->user()->email }}" disabled
                class="block w-full rounded-lg border border-gray-200 bg-white px-3.5 py-2 text-gray-800 placeholder:text-gray-600 sm:text-sm/6 disabled:bg-gray-50 disabled:text-gray-700" />
            <button type="submit" wire:loading.attr="disabled" wire:target="requestVerificationEmail"
                class="mt-6 block w-full rounded-lg bg-gray-900 px-6 py-2 text-sm/6 font-semibold text-gray-50 hover:bg-gray-800 focus:outline-offset-2">
                Resend Verification Email
            </button>
            <a href="{{ route('logout') }}"
                class="mt-2.5 block text-center w-full rounded-lg border border-gray-200 px-6 py-2 text-sm/6 font-semibold text-gray-700 hover:bg-gray-50 focus:outline-offset-2">
                Log Out
            </a>
        </form>
    </div>
</div>
