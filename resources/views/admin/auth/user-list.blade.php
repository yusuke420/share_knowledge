<x-admin-layout>
    <div class="bg-white py-6 sm:py-8 lg:py-12">
        <div class="mx-auto max-w-screen-2xl px-4 md:px-8">
            <h2 class="mb-4 text-center text-2xl font-bold text-gray-800 md:mb-8 lg:text-3xl">
                {{ __('ユーザーリスト') }}
            </h2>
            <form class="mt-4 shadow-lg" action="{{ route('admin.searchResultUser') }}" method="GET">
            @csrf
                <div class="flex">
                    <div class="relative w-full user-search-form">
                        <input type="search" id="search-dropdown" class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-r-lg border-l-2 border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-l-gray-700  dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500" placeholder="ユーザー検索">
                        <button type="submit" class="absolute top-0 right-0 p-2.5 text-sm font-medium text-white bg-blue-700 rounded-r-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            <svg aria-hidden="true" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            <span class="sr-only">Search</span>
                        </button>
                    </div>
                </div>
            </form>

            <div class="bg-white py-6 sm:py-8 lg:py-12">
                <div class="mx-auto max-w-screen-2xl px-4 md:px-8">
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 dark:bg-gray-800">
                                        ID
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        名前
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 dark:bg-gray-800">
                                        メールアドレス
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        登録日
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 dark:bg-gray-800">
                                        編集
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        削除
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($users as $user)
                                <tr class="border-b border-gray-200 dark:border-gray-700">
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                                        {{ $user->id }}
                                    </td>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                        {{ $user->name }}
                                    </td>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                                        {{ $user->email }}
                                    </td>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                        {{ \Carbon\Carbon::parse($user->created_at)->format('Y/m/d') }}
                                    </td>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                                        <div class="">
                                            <a href="" class="">編集</a>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                        <form action="" method="post" class="">
                                        @csrf
                                            <input type="submit" value="削除" class="" onclick='return confirm("本当に削除しますか？");'>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>