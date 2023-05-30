
<div data-onsuccess="onSignIn"></div>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script>
function onSignIn(googleUser) {
    var id_token = googleUser.getAuthResponse().id_token;
    $.ajax({
        type: "POST",
        url: "",
        data:{ 'token':id_token, },
        dataType :'json',
    }).done(function(json){
        var html = "";
        var key;
        for (key in json){
            html += "<p>"+key+" => "+json[key]+"</p>";
        }
        $("#data").html(html);
    });
}
</script>
<div id="data"></div>
