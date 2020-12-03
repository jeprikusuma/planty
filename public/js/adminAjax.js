const adminUrl = "http://localhost/jepri-media/public/Admin/";


const toHome = document.querySelector("#go-home"),
      toUser = document.querySelector("#go-user"),
      toPost = document.querySelector("#go-post");
const container = document.querySelector("#main-content");

let searchUser = document.querySelector("#search-user"),
    searchPosts = document.querySelector("#search-posts"),
    usersResult = document.querySelector("#users-result"),
    usersDiscover = document.querySelector("#users-discover"),
    postsResult = document.querySelector("#posts-result"),
    postsDiscover = document.querySelector("#posts-discover"),
    buttons = document.querySelector("#costumLink");

let onNav = "all",
    onNavPosts = "all";

if(toHome != null){
    toHome.addEventListener('click', (e) => {
        e.preventDefault();

        fetch(adminUrl, { 
            method: "POST", 
            headers: { "Content-Type": "application/json; charset=utf-8"},
            body: JSON.stringify({
                "aside": true
            })
        })
        .then(response => response.text())
        .then(data => container.innerHTML = data)
    })
    toUser.addEventListener('click', (e) => {
        e.preventDefault();
        
        fetch(adminUrl + "/users", { 
            method: "POST", 
            headers: { "Content-Type": "application/json; charset=utf-8"},
            body: JSON.stringify({
                "aside": true
            })
        })
        .then(response => response.text())
        .then(data => {
            container.innerHTML = data;
            usersResult = document.querySelector("#users-result");
            usersDiscover = document.querySelector("#users-discover");
            searchUser = document.querySelector("#search-user");
            buttons = document.querySelector("#costumLink");
        })
    })
    toPost.addEventListener('click', (e) => {
        e.preventDefault();
        
        fetch(adminUrl + "/posts", { 
            method: "POST", 
            headers: { "Content-Type": "application/json; charset=utf-8"},
            body: JSON.stringify({
                "aside": true
            })
        })
        .then(response => response.text())
        .then(data => 
            {container.innerHTML = data;
            searchPosts = document.querySelector("#search-posts");
            postsResult = document.querySelector("#posts-result");
            postsDiscover = document.querySelector("#posts-discover");
            buttons = document.querySelector("#costumLink"); 
        })
    })

    buttons.addEventListener("click", (e) =>{
        e.preventDefault();
        
        fetch(e.target.href, { 
            method: "POST", 
            headers: { "Content-Type": "application/json; charset=utf-8"},
            body: JSON.stringify({
                "aside": true,
                "nav": onNav,
                "navPosts": onNavPosts
            })
        })
        .then(response => response.text())
        .then(data => {
            usersResult = document.querySelector("#users-result");
            postsResult = document.querySelector("#posts-result");
            if(usersResult != null){
                usersResult.innerHTML = data;
            }else{
                postsResult.innerHTML = data;
            }
            buttons = document.querySelector("#costumLink");
            $('#costum-modal').modal('hide');
        });
    })
}

const searchUserClick = () =>{
    fetch(adminUrl + "users", { 
        method: "POST", 
        headers: { "Content-Type": "application/json; charset=utf-8"},
        body: JSON.stringify({
            "aside" : true,
            "search": searchUser.value
        })
    })
    .then(response => response.text())
    .then(data => usersDiscover.innerHTML = data);
}

const userNav = (to) => {
    onNav = to;
    fetch(adminUrl + "users/" + to, { 
        method: "POST", 
        headers: { "Content-Type": "application/json; charset=utf-8"},
        body: JSON.stringify({
            "aside" : true,
            "nav": true
        })
    })
    .then(response => response.text())
    .then(data => {
        usersDiscover.innerHTML = data;
        usersResult = document.querySelector("#users-result");
        usersDiscover = document.querySelector("#users-discover");
        searchUser = document.querySelector("#search-user");
    });
}


const searchPostsClick = () =>{
    fetch(adminUrl + "posts", { 
        method: "POST", 
        headers: { "Content-Type": "application/json; charset=utf-8"},
        body: JSON.stringify({
            "aside" : true,
            "search": searchPosts.value
        })
    })
    .then(response => response.text())
    .then(data => postsDiscover.innerHTML = data);
}

const postsNav = (to) => {
    onNavPosts = to;
    fetch(adminUrl + "posts/" + to, { 
        method: "POST", 
        headers: { "Content-Type": "application/json; charset=utf-8"},
        body: JSON.stringify({
            "aside" : true,
            "nav": true
        })
    })
    .then(response => response.text())
    .then(data => {
        postsDiscover.innerHTML = data;
        postsResult = document.querySelector("#posts-result");
        postsDiscover = document.querySelector("#posts-discover");
        searchPosts = document.querySelector("#search-posts");
    });
}
