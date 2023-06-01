<x-admin-layout>
    <div class="bg-white py-6 sm:py-8 lg:py-12">
        <div class="mx-auto max-w-screen-2xl px-4 md:px-8">
            <h2 class="mb-4 text-center text-2xl font-bold text-gray-800 md:mb-8 lg:text-3xl">
                {{ __('周知詳細') }}
            </h2>
        </div>

        <div class="bg-white py-6 sm:py-8 lg:py-12">
            <div class="mx-auto max-w-screen-2xl px-4 md:px-8">
                <div class="grid gap-6 sm:grid-cols-2">
                <!-- post - start -->
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
                            {{-- <span>
                                <button class="absolute top-0 right-0 px-4 py-2 read-button" id="{{ $post->id }}" type="button">
                                    <i class="{{ $post->isReadBy(Auth::guard('admin')->user()->id) ? 'fa-solid fa-square-check check active' : 'fa-regular fa-square check' }}" style="color: #000000;"></i>
                                </button>
                            </span> --}}
                            <span>
                                <a href="{{ route('admin.read', $post) }}" class="btn btn-secondary btn-sm">
                                    <button class="absolute top-0 right-0 px-4 py-2" data-post-id="{{ $post->id }}" type="button">既読
                                        <i class="{{ $post->isReadBy(Auth::guard('admin')->user()->id) ? 'fa-solid fa-square-check' : 'fa-regular fa-square' }}" style="color: #000000;"></i>
                                    </button>
                                </a>
                            </span>
                            <p class="absolute right-0 px-2" style="top: 3.5rem;">{{ \Carbon\Carbon::parse($post->created_at)->format('Y/m/d') }}</p>
                        </div>
                        <p class="p-4">{{ $post->body }}</p>
                        @if ($post->image !=='')
                        <div>
                            <img src="{{ Storage::url($post->image) }}">
                        </div>
                        @else
                        @endif
                        <a href="{{ route('admin.post.edit', $post) }}" class="text-indigo-500 inline-flex items-center md:mb-2 lg:mb-0 absolute bottom-0 right-0 p-4">編集
                            <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                <!-- post - end -->
                </div>
                <span class="ml-2">
                    <form method="post" action="{{ route('admin.post.destroy', $post) }}">
                        @csrf
                        @method('delete')
                        <button type="submit" onClick="return confirm('本当に削除しますか？');" class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-md">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                            この投稿を削除
                        </button>
                    </form>
                </span>
            </div>
        </div>


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
                                    既読
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
                                    <i class="{{ $post->isReadBy($user->id) ? 'fa-solid fa-square-check' : 'fa-regular fa-square' }}" style="color: #000000;"></i>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>