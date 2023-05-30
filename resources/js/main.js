// "use strict";
window.addEventListener('DOMContentLoaded',function(){
    const READ = document.getElementsByClassName("read-button");
    const btns = Array.from(READ);
    btns.map((btn) => {
        btn.addEventListener('click', async (e) => {
            console.log(e);
            let postId = e.currentTarget.id; //@NOTE: data-post-id属性を取得する
            const res = await fetch(`/admin/dashboard/${postId}/read`, {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    "Content-Type": "application/json",
                },
            })
            .then(res => {
                const CHECK = document.querySelectorAll(".check");
                CHECK.classList.toggle("active");
            })
            .catch(error =>
                console.error(error)
            );
        })
    })
    // if(READ){
    //     for(let i = 0; i < READ.length; i++) {
    //         READ[i].addEventListener("click", async (e) => {
    //             const postId = e.currentTarget.data("post-id"); //@NOTE: data-post-id属性を取得する
    //             const res = await fetch(`/admin/dashboard/${postId}/read`, {
    //                 method: "POST",
    //                 headers: {
    //                     "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    //                     "Content-Type": "application/json",
    //                 },
    //             })
    //             .then(res => {
    //                 const CHECK = document.querySelectorAll(".check")[i];
    //                 CHECK.classList.toggle("active");
    //             })
    //             .catch(error =>
    //                 console.error(error)
    //             );
    //         });
    //     }
    // }
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
