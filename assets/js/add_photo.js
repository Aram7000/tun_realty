let add_photo = () => {
    let images = document.getElementById("post_images");
    let container = document.getElementById("images_cont");
    let mainCont = document.getElementById("main_image_cont");
    let mainImageInput = document.getElementById("main_image_input");
    
    images.addEventListener("change", () => {
        container.innerHTML = "";
        for (let i = 0; i < images.files.length; i++) {
            const file = images.files[i];
            let img = document.createElement("img");
            img.src = URL.createObjectURL(file);
            container.appendChild(img);
            img.addEventListener("click", () => {
                mainCont.src = img.src;
                mainImageInput.value = i;
            });
        }
    });
}