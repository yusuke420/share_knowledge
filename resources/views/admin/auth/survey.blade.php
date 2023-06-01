<x-admin-layout>
    <div class="bg-white py-6 sm:py-8 lg:py-12">
        <div class="mx-auto max-w-screen-2xl px-4 md:px-8">
            <h2 class="mb-4 text-center text-2xl font-bold text-gray-800 md:mb-8 lg:text-3xl">新規アンケート投稿</h2>
            <form method="POST" action="{{ route('admin.survey.store') }}" class="mx-auto max-w-lg rounded-lg border">
                @csrf
                <div class="flex flex-col gap-4 p-4 md:p-8">
                    <!-- Title -->
                    <div>
                        <x-input-label for="title" :value="__('質問内容')" />
                        <x-text-input id="title" class="w-full rounded border bg-gray-50 px-3 py-2 text-gray-800 outline-none ring-indigo-300 transition duration-100 focus:ring" type="text" name="title" :value="old('title')" required autofocus autocomplete="title" />
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>

                    <!-- Importance -->
                    <div>
                        <x-input-label for="options" :value="__('選択肢')" />
                        <ul class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white" id="options" type="options" name="options" required autocomplete="options">
                            <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                <div class="flex items-center pl-3">
                                    <input id="option1" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" type="radio" name="options" value="high" {{ old ('options') == '1' ? 'checked' : '' }} required autocomplete="options" />
                                    <label for="option1" class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                        <x-text-input id="option1" class="w-full rounded border bg-gray-50 px-3 py-2 text-gray-800 outline-none ring-indigo-300 transition duration-100 focus:ring" type="text" name="option1" :value="old('option1')" required autofocus autocomplete="options" />
                                    </label>
                                </div>
                            </li>
                            <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                <div class="flex items-center pl-3">
                                    <input id="option2" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" type="radio" name="options" value="high" {{ old ('options') == '2' ? 'checked' : '' }} required autocomplete="options" />
                                    <label for="option2" class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                        <x-text-input id="option2" class="w-full rounded border bg-gray-50 px-3 py-2 text-gray-800 outline-none ring-indigo-300 transition duration-100 focus:ring" type="text" name="option2" :value="old('option2')" required autofocus autocomplete="options" />
                                    </label>
                                </div>
                            </li>
                        </ul>
                        <x-input-error :messages="$errors->get('options')" class="mt-2" />
                    </div>

                    <x-primary-button class="block rounded-lg bg-gray-800 px-8 py-3 text-center text-sm font-semibold text-white outline-none ring-gray-300 transition duration-100 hover:bg-gray-700 focus-visible:ring active:bg-gray-600 md:text-base">
                        {{ __('送信') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
