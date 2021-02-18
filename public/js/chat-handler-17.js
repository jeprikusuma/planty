
const getOnlineUsers = () => {
    fetch(baseUrl + "chat/getOnlineUsers", { 
        method: "POST", 
        headers: { "Content-Type": "application/json; charset=utf-8"},
        body: JSON.stringify({
            "getOnline" : true,
        })
    })
   .then(response =>  response.text())
   .then(data => {
       let disOnline = document.querySelector('#onlineUsers');
       if(disOnline != null){
         disOnline.innerHTML = data;
       }
   });
}

const getChat = () => {
    fetch(baseUrl + "chat/getChat", { 
        method: "POST", 
        headers: { "Content-Type": "application/json; charset=utf-8"},
        body: JSON.stringify({
            "getOnline" : true,
        })
    })
   .then(response =>  response.text())
   .then(data => {
       let chat = document.querySelector('#chat');
       if(chat != null){
         chat.innerHTML = data;
       }
   });

}

const toChat = (e) => {
    checkIntervalOnline();
    if(e != null) e.preventDefault();
    fetch(baseUrl + "chat", { 
        method: "POST", 
        headers: { "Content-Type": "application/json; charset=utf-8"},
        body: JSON.stringify({
            "status" : true,
        })
    })
   .then(response => response.text())
   .then(data => {
       main.innerHTML = data;
       setNav(4);
       discover = document.querySelector('discover');
       getOnlineUsers();
       getChat();

       intervalOnline = setInterval(() => {
           getOnlineUsers();
       }, 1000)
       intervalChat = setInterval(() => {
           getChat();
       }, 500)
    });

    fetch(baseUrl + "chat/aside", { 
        method: "POST", 
        headers: { "Content-Type": "application/json; charset=utf-8"},
        body: JSON.stringify({
            "status" : true,
        })
    })
   .then(response => response.text())
   .then(data => {
       rightSite.innerHTML = data;
       if(window.screen.width <= 765){
        document.querySelector('.header').classList.add('d-none');
        document.querySelector('.chat-area-input').classList.remove('d-none');
        document.querySelector('.chat-area-show').classList.remove('d-none');
       }
       setNav(4);
    });
}

const getPersonalChat = (id) => {
    fetch(baseUrl + "chat/getPersonalChat", { 
        method: "POST", 
        headers: { "Content-Type": "application/json; charset=utf-8"},
        body: JSON.stringify({
            "personalChat" : true,
            "id" : id,
        })
    })
   .then(response => response.text())
   .then(data => {
       const chats = document.querySelector('.chats');
       if(chats != null){
           chats.innerHTML = data;
       }
    });
}

const toPersonalChat = (id, user) => {
    clearInterval(intervalChat);
    clearInterval(intervalPersonalChat);
    fetch(baseUrl + "chat/toPersonalChat", { 
        method: "POST", 
        headers: { "Content-Type": "application/json; charset=utf-8"},
        body: JSON.stringify({
            "personalChat" : true,
            "id" : id,
            "user": user
        })
    })
   .then(response => response.text())
   .then(data => {
       main.innerHTML = data;
       const chats = document.querySelector('.chats');
       chats.scrollTop = chats.scrollHeight;
       if(window.screen.width <= 765){
        document.querySelector('.header').classList.add('d-none');
        document.querySelector('.chat-area-input').classList.add('d-none');
        document.querySelector('.chat-area-show').classList.add('d-none');
       }
       intervalPersonalChat = setInterval(() => {
           getPersonalChat(id);
       }, 100);
    });
}
const sendPersonalChat = (id, user1, user2) => {
    const chatValue = document.querySelector("#inputChat");
    
    if(chatValue.value != ""){
        fetch(baseUrl + "chat/sendChat", { 
            method: "POST", 
            headers: { "Content-Type": "application/json; charset=utf-8"},
            body: JSON.stringify({
                "sendChat" : true,
                "id" : id,
                "user1": user1,
                "user2" : user2,
                "value": chatValue.value
            })
        })
        .then(() => {
            chatValue.value = "";
            setTimeout(()=>{
                const chats = document.querySelector('.chats');
                chats.scrollTo(0, chats.scrollHeight);
            }, 200)
            
         });
    }
}

const updateOnline = () => {
    fetch(baseUrl + "chat/updateOnline", { 
        method: "POST", 
        headers: { "Content-Type": "application/json; charset=utf-8"},
        body: JSON.stringify({
            "setOnline" : true,
        })
    })
}

let count = 0,
    lastCount = 0,
    waitLoad = true;
const chatCount = () => {
    fetch(baseUrl + "chat/chatCount", { 
        method: "POST", 
        headers: { "Content-Type": "application/json; charset=utf-8"},
        body: JSON.stringify({
            "chatCount" : true,
        })
    })
    .then(response => response.text())
    .then(data => {
       const chatCountDiscover = document.querySelectorAll('.chatCountDiscover');
       if(waitLoad){
           count = data;
           lastCount = data;
           waitLoad = false;
       }else{
            count = data;
            if(count > lastCount){
                document.querySelector('#notif').play();
                console.log('yes')
            }
            lastCount = data;
       }
       if(chatCountDiscover != null){
            if(data == 0){
                chatCountDiscover.forEach(el => {
                    el.classList.add('d-none');
                });
            }else{
                chatCountDiscover.forEach(el => {
                    el.classList.remove('d-none');
                });
                document.querySelectorAll('.chatCount').forEach(el => {
                    el.innerHTML = data;
                });
            }
       }
    })
}

const createRoomChat = (toUser, e = null) => {
    clearInterval(intervalChat);
    clearInterval(intervalPersonalChat);

    if(e != null) e.preventDefault();
    
    if(!document.querySelector('#onlineUsers')){
        toChat(null);
    }
    fetch(baseUrl + "chat/makeRoomChat", { 
        method: "POST", 
        headers: { "Content-Type": "application/json; charset=utf-8"},
        body: JSON.stringify({
            "makeRoomChat" : true,
            "toUser" : toUser
        })
    })
    .then(response => response.text())
    .then(data => {
        main.innerHTML = data;
        const chats = document.querySelector('.chats'),
              idChat = document.querySelector('#idChat');
        chats.scrollTop = chats.scrollHeight;
        if(window.screen.width <= 765){
            document.querySelector('.header').classList.add('d-none');
            document.querySelector('.chat-area-input').classList.add('d-none');
            document.querySelector('.chat-area-show').classList.add('d-none');
        }
        intervalPersonalChat = setInterval(() => {
            getPersonalChat(idChat.dataset.idchat);
        }, 100);
    })
}

const searchChatUser = () => {
    const search = document.querySelector('#searchChatUserInput'),
          title = document.querySelector('#searchUserTitle');

    if(search.value != ""){
        fetch(baseUrl + "chat/searchUser", { 
            method: "POST", 
            headers: { "Content-Type": "application/json; charset=utf-8"},
            body: JSON.stringify({
                "search" : true,
                "keyword" : search.value
            })
        })
        .then(response => response.text())
        .then(data => {
            clearInterval(intervalOnline);
            intervalOnline = null;
            title.innerHTML = `<h5>Search member: ${search.value}</h5>`;
            let disOnline = document.querySelector('#onlineUsers');
            if(disOnline != null){
                disOnline.innerHTML = data;
                search.value = "";
            }
        })
    }else{
        title.innerHTML = "<h4>Online Members</h4>";
        if(intervalOnline == null){
            getOnlineUsers();
            intervalOnline = setInterval(() => {
                getOnlineUsers();
            }, 1000)
        }
    }

}
if(posting != null){  
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
            if(status != null){
                status.innerHTML = data;
                delate = document.querySelector("#costumLink");
                reloadHastag();
                $('#costum-modal').modal('hide');
            }else{
                $('#costum-modal').modal('hide');
                toChat(null);
            }            
        });
    })

    document.querySelector("#costum-report-send").addEventListener("click", (e) => {
        e.preventDefault();
        fetch(e.target.href, { 
            method: "POST", 
            headers: { "Content-Type": "application/json; charset=utf-8"},
            body: JSON.stringify({
                "report": true,
                "des": document.querySelector("#custom-report-input").value
            })
        })
        .then(() => {
            $('#costum-report').modal('hide');
            $("#static-report").modal('show')
        })
    })

    reloadHastag();
}


setInterval(() => {
    updateOnline();
}, 1000);

setInterval(() => {
    chatCount();
}, 100);
