const buttonEye = document.getElementById("buttonEye");

function handleShowPassword()
{
    const txtPass = document.getElementById("textPassword");
    if(txtPass.type === "text")
    {
        txtPass.type = "password";
        buttonEye.className = "fa fa-eye";
    }
    else
    {
        txtPass.type = "text";
        buttonEye.className = "fa fa-eye-slash";
    }
}

buttonEye.addEventListener('click', handleShowPassword)

// アイコンのinput要素
const iconInput = document.getElementById('icon');
// プレビューするためのimg要素
const iconPreview = document.getElementById('icon-preview');

function setIcon() {
    const selectedFile = iconInput.files[0];
    if (iconInput.files && selectedFile) {
        const reader = new FileReader();
        reader.onload = function (e) {
            iconPreview.src = e.target.result;
            iconPreview.style.display = 'block';
        };
        reader.readAsDataURL(selectedFile);
    }
}

iconInput.addEventListener('change', setIcon)
