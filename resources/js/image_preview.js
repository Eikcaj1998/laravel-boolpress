


const placeholder = "https://socialistmodernism.com/wp-content/uploads/2017/07/placeholder-image.png";
const preview = document.getElementById('preview');
const imageField = document.getElementById('image-field');
imageField.addEventListener('input', () => {
   if(imageField.files && imageField.files[0]){
    let reader = new FileReader();
    reader.readAsDataURL(imageField.files[0]);
    reader.onload = event =>{
        preview.src = event.target.result
    }
   }else preview.src = placeholder;
});
