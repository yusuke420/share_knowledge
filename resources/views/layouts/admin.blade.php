<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Share knowledge') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <script defer src="https://unpkg.com/alpinejs@3.2.4/dist/cdn.min.js"></script>
        <!-- CSSファイルを読み込む -->
        <link href="{{ mix('css/app.css') }}" rel="stylesheet">

        <!-- JavaScriptファイルを読み込む -->
        <script src="{{ mix('js/app.js') }}"></script>
    </head>
    <body class="font-sans text-gray-900 antialiased">
        @include('layouts.admin_navigation')
        {{ $slot }}
        @include('layouts.footer')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
        <script src="https://kit.fontawesome.com/d6cedd7120.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js"></script>
        <script src="https://unpkg.com/vue@3.1.1/dist/vue.global.prod.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
        {{-- <script>
            const surveyResultComponent = {
                props: {
                    option: {
                        type: String,
                        default: ''
                    },
                    percentage: {
                        type: Number,
                        default: 0
                    }
                },
                computed: {
                    barStyles() {
                        return {
                            backgroundColor: '#b2e9f8',
                            width: `${this.percentage}%`
                        };
                    }
                },
                template: `
                    <div class="position-relative py-1">
                        <div class="position-absolute" :style="barStyles">&#8203;</div>
                        <div class="position-absolute ps-1" v-text="option"></div>
                        <div class="position-absolute" style="right:0;">
                            <span v-text="percentage"></span> %
                        </div>
                    </div>
                `
            }; --}}
{{-- 
            // Vue.createApp({
            //     data(){
            //         return {
            //             status: 'survey', // `survey` or `result`
            //             survey: @json($survey),
            //             isPolled: @json($is_polled),
            //             surveyResults: {}
            //         }
            //     },
            //     methods: {
            //         poll(surveyItemId) {
            //             const url = '{{ route('survey.store') }}';
            //             const params = {
            //                 survey_id: this.survey.id,
            //                 survey_item_id: surveyItemId
            //             };
            //             axios.post(url, params)
            //             .then(response => {
            //                 if(response.data.result === true) {
            //                     this.getResult();
            //                 }
            //             })
            //             .catch(error => {
            //                 alert('バリデーション・エラー');
            //                 console.log(errors.response.data);
            //                 // TODO: ここでエラー処理
            //             });
            //         },
            //         getResult() {
            //             const url = '{{ route('survey.result') }}/'+ this.survey.id;
            //             axios.get(url)
            //             .then(response => {
            //                 this.status = 'result'; // 表示を切り替え
            //                 this.surveyResults = response.data;
            //             });
            //         }
            //     },
            //     computed: {
            //         isStatussurvey(){
            //             return (this.status === 'survey');
            //         },
            //         isStatusResult(){
            //             return (this.status === 'result');
            //         }
            //     },
            //     mounted() {
            //         if(this.isPolled === true) {
            //             this.getResult();
            //         }
            //     }
            // })
            // .component('v-survey-result', surveyResultComponent)
            // .mount('#app');
        </script> --}}
    </body>
</html>
