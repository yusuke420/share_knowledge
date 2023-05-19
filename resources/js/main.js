'use strict';

$(document).ready(function() {
    $('.read-button').click(async function() {
        var postId = $(this).data('post-id');
        try {
            const response = await fetch(`/dashboard/${postId}/read`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({})
            });
            const data = await response.json();
            const CHECK = document.querySelectorAll(".check")[i];
            // サーバーからのレスポンスに基づいていいねボタンを更新します
            if (data.isRead) {
                CHECK.classList.toggle("active");
            } else {
                CHECK.classList.toggle("");
            }
        } catch (error) {
            console.error('エラーが発生しました:', error);
        }
    });
});
// func = async () => {
//     await log(3);
//     await log(2);
//     await log(1);
// };

// log = (num) => {
//     return new Promise(resolve => {
//         setTimeout(() => {
//             console.log(num);
//             resolve();
//         }, 1000);
//     });
// }
