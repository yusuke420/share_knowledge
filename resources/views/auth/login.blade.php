<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <div class="bg-white py-6 sm:py-8 lg:py-12">
        <div class="mx-auto max-w-screen-2xl px-4 md:px-8">
            <h2 class="mb-4 text-center text-2xl font-bold text-gray-800 md:mb-8 lg:text-3xl">ユーザーログイン</h2>
            <form method="POST" action="{{ route('login') }}" class="mx-auto max-w-lg rounded-lg border">
                @csrf
                <div class="flex flex-col gap-4 p-4 md:p-8">
                    <!-- Email Address -->
                    <div>
                        <x-input-label for="email" :value="__('メールアドレス')" />
                        <x-text-input id="email" class="w-full rounded border bg-gray-50 px-3 py-2 text-gray-800 outline-none ring-indigo-300 transition duration-100 focus:ring" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div>
                        <x-input-label for="password" :value="__('パスワード')" />
                        <x-text-input id="password" class="w-full rounded border bg-gray-50 px-3 py-2 text-gray-800 outline-none ring-indigo-300 transition duration-100 focus:ring"
                                        type="password"
                                        name="password"
                                        required autocomplete="current-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Remember Me -->
                    <div>
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                            <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('ログイン情報を保存') }}</span>
                        </label>
                    </div>
                    <x-primary-button class="block rounded-lg bg-gray-800 px-8 py-3 text-center text-sm font-semibold text-white outline-none ring-gray-300 transition duration-100 hover:bg-gray-700 focus-visible:ring active:bg-gray-600 md:text-base">
                        {{ __('ログイン') }}
                    </x-primary-button>
                </div>

                <div class="flex items-center justify-center bg-gray-100 p-4">
                    @if (Route::has('password.request'))
                    <p class="text-center text-sm text-gray-500">パスワードをお忘れの方は<a class="text-indigo-500 transition duration-100 hover:text-indigo-600 active:text-indigo-700" href="{{ route('password.request') }}">
                            {{ __('こちら') }}
                        </a></p>
                    @endif
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
