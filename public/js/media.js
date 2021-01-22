const imageInput = document.querySelector('#inImg'),
      imageSelectArea = document.querySelector('.select-img'),
      imageText = document.querySelector('.select-img span'),
      imageReplace = document.querySelector('.select-img img'),
      view = document.querySelector(".view-full"),
      viewImg = document.querySelector(".main-full img");

if(imageInput != null){
    imageInput.addEventListener('change', (e)=>{
        imageReplace.src = window.URL.createObjectURL(e.target.files[0]);
        imageReplace.classList.remove('d-none');
        imageText.classList.add('d-none');
    })
    view.addEventListener('click', () => {
        view.classList.remove("d-flex");
        view.classList.add("d-none");
        document.body.style.overflow = "unset";
    })
}

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

