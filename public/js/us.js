const search = document.querySelector("#search"),
      posting = document.querySelector("#posting"),
      postingStatus = document.querySelector("#posting-status"),
      trending = document.querySelectorAll(".trending");

let status = document.querySelector("#status"),
    discover = document.querySelector("#discover"),
    delate = document.querySelector("#costumLink"),
    valueComment = document.querySelector("#comment-value");

const reloadHastag = () =>{
    let hastags = document .querySelectorAll(".hastag");
    if(hastags != null){
        hastags.forEach(hastag => {
            hastag.addEventListener("click",(e) => {
                e.preventDefault();
                status.innerHTML = loading;

                fetch(e.target.href, { 
                    method: "POST", 
                    headers: { "Content-Type": "application/json; charset=utf-8"},
                    body: JSON.stringify({"hastag" : true})
                })
                .then(response => response.text())
                .then(data => {
                    status.innerHTML = data;
                    reloadHastag();
                });
            })
        });  
  }
}

if(posting != null){
    posting.addEventListener('submit', (e) =>{
        e.preventDefault();
        discover.innerHTML = loading;

        const data = new FormData();
        data.append("content", postingStatus.value);
        data.append("file", imageInput.files[0]);
        data.append("posting", true);

        if(postingStatus.value != ""){
            fetch(url + "posting", { 
                method: "POST", 
                body: data
            })          
            .then(response => response.text())
            .then(data => {
                postingStatus.value = "";
                discover.innerHTML = data;
                clearSelectedImage();
                reloadHastag();
            });
        }
    })
    
    delate.addEventListener("click", (e) =>{
        e.preventDefault();
        status.innerHTML = loading;
        
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
            reloadHastag();
            $('#costum-modal').modal('hide');
        });
    })

    if(trending != null){
        trending.forEach(trend => {
            trend.addEventListener("click",(e) => {
                e.preventDefault();
                status.innerHTML = loading;
                link1 = e.target.href;
                link2 = e.target.parentElement.parentElement.href;
                link3 = e.target.parentElement.href;
                
                link = link1;

                if(link2 != undefined) link = link2;
                else if(link3 != undefined) link = link3;
                else link = link1;
                
                fetch(link, { 
                    method: "POST", 
                    headers: { "Content-Type": "application/json; charset=utf-8"},
                    body: JSON.stringify({"hastag" : true})
                })
                .then(response => response.text())
                .then(data => {
                    status.innerHTML = data;
                    reloadHastag();
                });
            })
        })
    }

    reloadHastag();
}

const searchClick = () =>{
    if(status != null){
        status.innerHTML = loading;
        fetch(url + "search/" + search.value, { 
            method: "POST", 
            headers: { "Content-Type": "application/json; charset=utf-8"},
            body: JSON.stringify({"status" : true})
        })
        .then(response => response.text())
        .then(data => {
            status.innerHTML = data;
        });
    }

}

const publicClick = () => {
    discover.innerHTML = loading;
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
       reloadHastag();
    });
}

const myClick = () => {
    discover.innerHTML = loading;
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
       discover.innerHTML = data;
       reloadHastag();
    });
}

const like = (post)=>{
    fetch(url + "like", { 
        method: "POST", 
        headers: { "Content-Type": "application/json; charset=utf-8"},
        body: JSON.stringify({
            "status" : true,
            "like": post
        })
    })
   .then(response => response.text())
   .then(data => {
       document.querySelector('.more'+post).innerHTML = data;
    });
}

const unlike = (post)=>{
    fetch(url + "unlike", { 
        method: "POST", 
        headers: { "Content-Type": "application/json; charset=utf-8"},
        body: JSON.stringify({
            "status" : true,
            "like": post
        })
    })
   .then(response => response.text())
   .then(data => {
         document.querySelector('.more'+post).innerHTML = data;
    });
}

const toComment = (post)=>{
    status.innerHTML = loading;
    fetch(url + "commentArea", { 
        method: "POST", 
        headers: { "Content-Type": "application/json; charset=utf-8"},
        body: JSON.stringify({
            "status" : true,
            "post": post
        })
    })
   .then(response => response.text())
   .then(data => {
        status.innerHTML = data
        status = document.querySelector("#status");
        valueComment = document.querySelector("#comment-value");
    });
}

const commentPost = (post) =>{
    fetch(url + "commentPost", { 
        method: "POST", 
        headers: { "Content-Type": "application/json; charset=utf-8"},
        body: JSON.stringify({
            "status" : true,
            "post": post,
            "comment": valueComment.value
        })
    })
   .then(response => response.text())
   .then(data => {
        status.innerHTML = data
        status = document.querySelector("#status");
        valueComment = document.querySelector("#comment-value");
        valueComment.value ="";
    });
}