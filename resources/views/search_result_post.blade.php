<x-app-layout>
    <div class="bg-white py-6 sm:py-8 lg:py-12">
        <div class="mx-auto max-w-screen-2xl px-4 md:px-8">
            <h2 class="mb-4 text-center text-2xl font-bold text-gray-800 md:mb-8 lg:text-3xl">
                {{ __('周知一覧') }}
            </h2>

            <form class="mt-4 shadow-lg" action="{{ route('searchResultPost') }}" method="GET">
            @csrf
                <div class="flex">
                    <label for="search-dropdown" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Your Email</label>
                    <button id="dropdown-button" data-dropdown-toggle="dropdown" class="flex-shrink-0 z-10 inline-flex items-center py-2.5 px-4 text-sm font-medium text-center text-gray-900 bg-gray-100 border border-gray-300 rounded-l-lg hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700 dark:text-white dark:border-gray-600" type="button">重要度<svg aria-hidden="true" class="w-4 h-4 ml-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg></button>
                    <div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdown-button">
                            <li>
                                <button type="button" class="inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">高</button>
                            </li>
                            <li>
                                <button type="button" class="inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">中</button>
                            </li>
                            <li>
                                <button type="button" class="inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">低</button>
                            </li>
                        </ul>
                    </div>
                    <div class="relative w-full post-search-form">
                        <input type="search" type="text" name="search" class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-r-lg border-l-gray-50 border-l-2 border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-l-gray-700  dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500" placeholder="関連キーワードで検索">
                        <button type="submit" class="absolute top-0 right-0 p-2.5 text-sm font-medium text-white bg-blue-700 rounded-r-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            <svg aria-hidden="true" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            <span class="sr-only">Search</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <div class="bg-white py-6 sm:py-8 lg:py-12">
            <div class="mx-auto max-w-screen-2xl px-4 md:px-8">
                <div class="grid gap-6 sm:grid-cols-2">
                    @if($posts->isEmpty())
                    <p class="error">検索結果がありませんでした。</p>
                    @endif
                    <!-- post - start -->
                    @foreach ($posts as $post)
                    <div class="group relative h-80 overflow-hidden rounded-lg bg-gray-100 shadow-lg">
                        @switch($post->importance)
                            @case(1)
                                <div style="background-color: #E02424; height: 5rem;" class="flex w-full">
                                @break
                            @case(2)
                                <div style="background-color: #FACA15; height: 5rem;" class="flex w-full">
                                @break
                            @case(3)
                                <div style="background-color: #1C64F2; height: 5rem;" class="flex w-full">
                                @break
                            @default
                                <div>
                        @endswitch
                            <h5 class="p-4">{{ $post->title }}</h5>
                            <span>
                                <a href="{{ route('read', $post) }}" class="btn btn-secondary btn-sm">
                                    <button class="absolute top-0 right-0 px-4 py-2" data-post-id="{{ $post->id }}" type="button">
                                        <i class="{{ $post->isReadBy(Auth::user()->id) ? 'fa-solid fa-square-check' : 'fa-regular fa-square' }}" style="color: #000000;"></i>
                                    </button>
                                </a>
                            </span>
                            <p class="absolute right-0 px-2" style="top: 3.5rem;">{{ \Carbon\Carbon::parse($post->created_at)->format('Y/m/d') }}</p>
                        </div>
                        <p class="p-4">{{ $post->body }}</p>
                    </div>
                    @endforeach
                    <!-- post - end -->
                </div>
            </div>
        </div>
        {{ $posts->links() }}
    </div>
</x-app-layout>
