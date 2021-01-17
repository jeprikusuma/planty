const imageInput = document.querySelector('#inImg'),
      imageSelectArea = document.querySelector('.select-img'),
      imageText = imageSelectArea.querySelector('span'),
      imageReplace = imageSelectArea.querySelector('img'),
      view = document.querySelector(".view-full"),
      viewImg = view.querySelector(".main-full img");

imageInput.addEventListener('change', (e)=>{
    imageReplace.src = window.URL.createObjectURL(e.target.files[0]);
    imageReplace.classList.remove('d-none');
    imageText.classList.add('d-none');
})

const clearSelectedImage = () => {
    imageInput.value = "";
    imageReplace.src = "";
    imageReplace.classList.add('d-none');
    imageText.classList.remove('d-none');
}

const viewFull = (base, file) =>{   
    viewImg.src = base + file;
    
    view.classList.remove("d-none");
    view.classList.add("d-flex");
    document.body.style.overflow = "hidden";
}

view.addEventListener('click', () => {
    view.classList.remove("d-flex");
    view.classList.add("d-none");
    document.body.style.overflow = "unset";
})