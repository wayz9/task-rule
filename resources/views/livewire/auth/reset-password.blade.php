<div class="relative flex flex-1 flex-col overflow-hidden px-4 py-8 sm:px-6 lg:px-8">
    <div class="relative mx-auto flex w-full max-w-[25.75rem] flex-1 flex-col items-center justify-center pb-16 pt-12">
        <img height="28" width="28" src="{{ Vite::image('mark.svg') }}" alt="Logo Mark" />

        <hgroup class="mt-5 text-center">
            <h2 class="text-lg font-medium text-gray-900">
                Reset Password Form
            </h2>
            <p class="mt-3 text-sm/6 text-gray-600">
                Use strong password with at least 8 characters, one uppercase and one special symbol.
            </p>
        </hgroup>

        <form wire:submit.prevent="resetPassword" class="mt-10 w-full">
            <input type="password" placeholder="New Password" wire:model="password" required autofocus
                class="block w-full rounded-lg border border-gray-200 bg-white px-3.5 py-2 text-gray-800 placeholder:text-gray-600 sm:text-sm/6
                @error('password') input-error @enderror
                " />
            @error('password')
                <p class="text-xs text-red-600 mt-1.5">
                    {{ $message }}
                </p>
            @enderror

            <input type="password" placeholder="Confirm Password" wire:model="password_confirmation" required
                class="mt-4 block w-full rounded-lg border border-gray-200 bg-white px-3.5 py-2 text-gray-800 placeholder:text-gray-600 sm:text-sm/6" />

            <button type="submit"
                class="mt-6 block w-full rounded-lg bg-gray-900 px-6 py-2 text-sm/6 font-semibold text-gray-50 hover:bg-gray-800 focus:outline-offset-2">
                Reset Password
            </button>
        </form>
    </div>
</div>
