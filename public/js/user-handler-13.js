const sideElement = document.querySelectorAll(".aside-element"),
      mSideElement = document.querySelectorAll(".m-aside-element"),  
      reportDes = document.querySelector("#report-des"),
      main = document.querySelector("#main"),
      rightSite = document.querySelector("#right");

let status = document.querySelector("#status"),
    postingStatus = document.querySelector("#posting-status"),
    discover = document.querySelector("#discover"),
    posting = document.querySelector("#posting"),
    delate = document.querySelector("#costumLink"),
    valueComment = document.querySelector("#comment-value");

let intervalOnline = null,
    intervalChat = null,
    intervalPersonalChat = null;

const checkIntervalOnline = () => {
    if(intervalOnline != null){
        clearInterval(intervalOnline);
        
    }
    if(intervalChat != null){
        clearInterval(intervalChat);
    }
    if(intervalPersonalChat != null){
        clearInterval(intervalPersonalChat);
    }
}

const setNav = (active) => {
    sideElement.forEach(el => {
        if(!el.classList.contains("logout")){
            el.classList.remove('active');
            el.classList.add('text-dark');
        }
    });

    sideElement[active].classList.add('active');
    sideElement[active].classList.remove('text-dark');

    mSideElement.forEach(el => {
        el.classList.remove('active');
        el.classList.add('text-secondary');
    });

    mSideElement[active-1].classList.add('active');
    mSideElement[active-1].classList.remove('text-secondary');
}

const reloadHastag = () =>{
    let hastags = document .querySelectorAll(".hastag");
    if(hastags != null){
        hastags.forEach(hastag => {
            hastag.addEventListener("click",(e) => {
                e.preventDefault();
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

const reloadPost = () => {
    fetch(url + "getAside", { 
        method: "POST", 
        headers: { "Content-Type": "application/json; charset=utf-8"},
        body: JSON.stringify({
            "status" : true,
        })
    })
   .then(response => response.text())
   .then(data => {
       rightSite.innerHTML = data;
    });

    fetch(url + "getPostingInput", { 
        method: "POST", 
        headers: { "Content-Type": "application/json; charset=utf-8"},
        body: JSON.stringify({
            "status" : true,
        })
    })
   .then(response => response.text())
   .then(data => {
       main.innerHTML = data;
       setNav(1);
       checkIntervalOnline();
       discover = document.querySelector('#discover');
       posting = document.querySelector("#posting");
       postingStatus = document.querySelector("#posting-status");
    });
        
}

const topublic = () => {
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
       discover.innerHTML = data;
       setNav(1);
       status = document.querySelector("#status");
       if(window.screen.width <= 765){
        document.querySelector('.header').classList.add('d-none');
        document.querySelector('.posting-discover').classList.add('d-none');
        document.querySelector('.trending-discover').classList.remove('d-none');
        document.querySelector('.search-post').classList.remove('d-none');
        window.scrollTo(0, window.scrollHeight);
     }
       reloadHastag();
    });
}

const submitPost = (e) => {
    let onUploading = false;
    e.preventDefault();
    if(!onUploading){
        onUploading = true;
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
                onUploading = false;
                postingStatus.value = "";
                discover.innerHTML = data;
                setNav(1);
                clearSelectedImage();
                reloadHastag();
            });
        }
    }           
}
const trendingClick = (e, link) => {
    topublic();
    e.preventDefault();

    fetch(url + link, { 
        method: "POST", 
        headers: { "Content-Type": "application/json; charset=utf-8"},
        body: JSON.stringify({"hastag" : true})
    })
    .then(response => response.text())
    .then(data => {
        status.innerHTML = data;
        reloadHastag();
    });                
}

const searchClick = () =>{
    const search = document.querySelector("#search");
    if(status != null){
        topublic();
        fetch(url + "search", { 
            method: "POST", 
            headers: { "Content-Type": "application/json; charset=utf-8"},
            body: JSON.stringify({
                "status" : true,
                "keyword":  search.value
            })
        })
        .then(response => response.text())
        .then(data => {
            status.innerHTML = data;
        });
    }

}

const publicClick = (e) => {
    e.preventDefault();
    if(discover == null){
        reloadPost();
    }
    topublic();
}

const markClick = (e) => {
    e.preventDefault();
    if(discover == null){
        reloadPost();
    }
    fetch(url + "marked", { 
        method: "POST", 
        headers: { "Content-Type": "application/json; charset=utf-8"},
        body: JSON.stringify({
            "status" : true,
            "nav": "public"
        })
    })
   .then(response => response.text())
   .then(data => {
       discover.innerHTML = data;
       setNav(3);
       if(window.screen.width <= 765){
        document.querySelector('.header').classList.add('d-none');
        document.querySelector('.posting-discover').classList.add('d-none');
        document.querySelector('.trending-discover').classList.add('d-none');
        document.querySelector('.search-post').classList.add('d-none');
        window.scrollTo(0, window.scrollHeight);
     }
       reloadHastag();
    });   
}

const myClick = (e) => {
    e.preventDefault();
    if(discover == null){
        reloadPost();
    }
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
       setNav(2);
       if(window.screen.width <= 765){
           document.querySelector('.header').classList.remove('d-none');
           document.querySelector('.posting-discover').classList.remove('d-none');
           document.querySelector('.trending-discover').classList.add('d-none');
           document.querySelector('.search-post').classList.add('d-none');
           window.scrollTo(0, window.scrollHeight);
        }
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

const mark = (post)=>{
    fetch(url + "mark", { 
        method: "POST", 
        headers: { "Content-Type": "application/json; charset=utf-8"},
        body: JSON.stringify({
            "status" : true,
            "mark": post
        })
    })
   .then(response => response.text())
   .then(data => {
       document.querySelector('.more'+post).innerHTML = data;
    });
}

const unmark = (post)=>{
    fetch(url + "unmark", { 
        method: "POST", 
        headers: { "Content-Type": "application/json; charset=utf-8"},
        body: JSON.stringify({
            "status" : true,
            "mark": post
        })
    })
   .then(response => response.text())
   .then(data => {
         document.querySelector('.more'+post).innerHTML = data;
    });
}

const toComment = (post)=>{
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

const commentPost = (post) =>{``
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
const sendReport = () => {
    if(reportDes.value != ""){
        fetch(baseUrl + "Report/send", { 
            method: "POST", 
            headers: { "Content-Type": "application/json; charset=utf-8"},
            body: JSON.stringify({
                "des" : reportDes.value
            })
        })
       .then(() => {
           reportDes.value = "";
           $("#static-report").modal('show')
       })
    }
}