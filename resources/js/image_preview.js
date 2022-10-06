


const placeholder = "https://socialistmodernism.com/wp-content/uploads/2017/07/placeholder-image.png";
const preview = document.getElementById('preview');
const imageField = document.getElementById('image-field');
imageField.addEventListener('input', () => {
    if (imageField.value) preview.src = imageField.value;
    else preview.src = placeholder;
});
