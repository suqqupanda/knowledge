const btnEye = document.getElementById("buttonEye");

function pushHideButton()
{
    const txtPass = document.getElementById("textPassword");
    if(txtPass.type === "text")
    {
        txtPass.type = "password";
        btnEye.className = "fa fa-eye";
    }
    else{
        txtPass.type = "text";
        btnEye.className = "fa fa-eye-slash";
    }
}
btnEye.addEventListener('click', function(){
    pushHideButton();
})

// アイコンのinput要素
var iconInput = document.getElementById('icon');
// プレビューするためのimg要素
var iconPreview = document.getElementById('icon-preview');

iconInput.addEventListener('change', function () {
    if (iconInput.files && iconInput.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            iconPreview.src = e.target.result;
            iconPreview.style.display = 'block';
        };
        reader.readAsDataURL(iconInput.files[0]);
    }
});