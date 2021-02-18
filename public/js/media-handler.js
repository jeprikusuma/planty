const view = document.querySelector(".view-full"),
      viewImg = document.querySelector(".main-full img");

let imageInput = document.querySelector('#inImg'),
    imageText = document.querySelector('.select-img span'),
    imageReplace = document.querySelector('.select-img img'),
    imageSelectArea = document.querySelector('.select-img');

if(imageInput != null){
    view.addEventListener('click', () => {
        view.classList.remove("d-flex");
        view.classList.add("d-none");
        document.body.style.overflow = "unset";
    })
}
const selectImage = (e) => {
    imageText = document.querySelector('.select-img span');
    imageReplace = document.querySelector('.select-img img');
    imageSelectArea = document.querySelector('.select-img');

    imageReplace.src = window.URL.createObjectURL(e.target.files[0]);
    imageReplace.classList.remove('d-none');
    imageText.classList.add('d-none');

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

