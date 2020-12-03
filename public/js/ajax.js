const search = document.querySelector("#search"),
      posting = document.querySelector("#posting"),
      postingStatus = document.querySelector("#posting-status");

let status = document.querySelector("#status"),
      discover = document.querySelector("#discover"),
      delate = document.querySelector("#costumLink");

const url = "http://localhost/jepri-media/public/Home/";


if(posting != null){
    posting.addEventListener('submit', (e) =>{
        e.preventDefault();
    
        if(postingStatus.value != ""){
            fetch(url + "posting", { 
                method: "POST", 
                headers: { "Content-Type": "application/json; charset=utf-8"},
                body: JSON.stringify({
                    "content": postingStatus.value,
                    "posting": true
                })
            })
            .then(response => response.text())
            .then(data => {
                postingStatus.value = "";
                discover.innerHTML = data;
            });
        }
    })
    
    delate.addEventListener("click", (e) =>{
        e.preventDefault();
        
        fetch(e.target.href, { 
            method: "POST", 
            headers: { "Content-Type": "application/json; charset=utf-8"},
            body: JSON.stringify({
                "delete": true
            })
        })
        .then(response => response.text())
        .then(data => {
            status = document.querySelector("#status");
            status.innerHTML = data;
            delate = document.querySelector("#costumLink");
            $('#costum-modal').modal('hide');
        });
    })
}

const searchClick = () =>{
    if(status != null){
        fetch(url + "search/" + search.value, { 
            method: "POST", 
            headers: { "Content-Type": "application/json; charset=utf-8"},
            body: JSON.stringify({"status" : true})
        })
        .then(response => response.text())
        .then(data => status.innerHTML = data);
    }

}

const publicClick = () => {
    fetch(url + "search", { 
        method: "POST", 
        headers: { "Content-Type": "application/json; charset=utf-8"},
        body: JSON.stringify({
            "status" : true,
            "nav": "public"
        })
    })
   .then(response => response.text())
   .then(data => {
       discover.innerHTML = data
       status = document.querySelector("#status");
    });
}

const myClick = () => {
    fetch(url + "mypost", { 
        method: "POST", 
        headers: { "Content-Type": "application/json; charset=utf-8"},
        body: JSON.stringify({
            "status" : true,
            "nav": "my"
        })
    })
   .then(response => response.text())
   .then(data => {
       discover.innerHTML = data
    });
}