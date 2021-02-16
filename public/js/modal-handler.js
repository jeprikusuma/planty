const costumModalSet = (color, title, mess, link)=>{
    const cosTitle =  document.querySelector("#costumTitle"),
        cosMess =  document.querySelector("#costumMessage"),
        cosLink =  document.querySelector("#costumLink");

    switch (color) {
        case "warning":
            cosLink.classList.add("btn-warning");
            break;
        case "primary":
            cosLink.classList.add("btn-primary");
            break;
        case "danger":
            cosLink.classList.add("btn-danger");
            break;
        default:
            cosLink.classList.add("btn-secondary");
            break;
    }
    cosTitle.innerHTML = title;
    cosMess.innerHTML = mess;
    cosLink.href = link;
    cosLink.innerHTML = title;
}


const costumModalReport = (title, mess, link)=>{
    const cosTitle =  document.querySelector("#costum-report-for"),
        cosMess =  document.querySelector("#custom-report-des"),
        cosLink =  document.querySelector("#costum-report-send"),
        cosInput = document.querySelector("#custom-report-input");

    cosInput.value = "";
    cosTitle.innerHTML = title;
    cosMess.innerHTML = mess;
    cosLink.href = link;
}