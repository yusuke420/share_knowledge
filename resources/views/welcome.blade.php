<x-guest-layout>
    <section class="text-gray-600 body-font">
        <div class="container px-5 py-24 mx-auto">
            <div class="flex flex-col text-center w-full mb-20">
                <p class="lg:w-2/3 mx-auto leading-relaxed text-base">周知事項共有サイト</p>
                <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">Share knowledge</h1>
            </div>
            <div class="flex flex-wrap -m-4 text-center">
                <a href="{{ route('admin.login') }}" class="p-4 md:w-1/2 sm:w-1/2 w-full">
                    <div class="border-2 border-gray-200 px-4 py-6 rounded-lg">
                        <h2 class="title-font font-medium text-3xl text-gray-900">管理者の方はこちら<i class="fa-solid fa-arrow-right"></i></h2>
                    </div>
                </a>
                <a href="{{ route('login') }}" class="p-4 md:w-1/2 sm:w-1/2 w-full">
                    <div class="border-2 border-gray-200 px-4 py-6 rounded-lg">
                        <h2 class="title-font font-medium text-3xl text-gray-900">ユーザーの方はこちら<i class="fa-solid fa-arrow-right"></i></h2>
                    </div>
                </a>
            </div>
        </div>
    </section>
</x-guest-layout>
