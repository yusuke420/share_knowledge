<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <div class="bg-white py-6 sm:py-8 lg:py-12">
        <div class="mx-auto max-w-screen-2xl px-4 md:px-8">
            <h2 class="mb-4 text-center text-2xl font-bold text-gray-800 md:mb-8 lg:text-3xl">パスワードリセット</h2>
            <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
                {{ __('パスワードをお忘れですか？メールアドレスをご入力いただければ、新しいパスワードを選択できるパスワードリセットリンクをメールでお送りします。') }}
            </div>
            <form method="POST" action="{{ route('password.email') }}" class="mx-auto max-w-lg rounded-lg border">
                @csrf
                <div class="flex flex-col gap-4 p-4 md:p-8">
                    <!-- Email Address -->
                    <div>
                        <x-input-label for="email" :value="__('メールアドレス')" />
                        <x-text-input id="email" class="w-full rounded border bg-gray-50 px-3 py-2 text-gray-800 outline-none ring-indigo-300 transition duration-100 focus:ring" type="email" name="email" :value="old('email')" required autofocus />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-primary-button>
                            {{ __('パスワードリセットリンクを送信') }}
                        </x-primary-button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
