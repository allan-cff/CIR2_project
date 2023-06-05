function toggleMusic(){};

function initPlayPauseButton(){
    pauseButton = document.querySelector('footer .music-player .progress-controller .control-buttons .play-pause-button');
    pauseButton.addEventListener('click', (e) => {
        let icon;
        if(e.target.tagName === "BUTTON"){
            icon = e.target.firstElementChild
        } else {
            icon = e.target
        }
        icon.classList.toggle("fa-play")
        icon.classList.toggle("fa-pause")
        toggleMusic();
    })
}

function initLikeButton(){
    likeButton = document.querySelector('footer .music-player .song-bar .icons button');
    likeButton.addEventListener('click', (e) => {
        let icon;
        if(e.target.tagName === "BUTTON"){
            icon = e.target.firstElementChild
        } else {
            icon = e.target
        }
        icon.classList.toggle("far")
        icon.classList.toggle("fas")
        if(classList.contains("fas")){
            getNowListening(userId, song => {
                addFavorite(userId, {"id": song.id}, ()=>{})
            })
        } else {
            getNowListening(userId, song => {
                deleteFavorite(userId, song.id, ()=>{})
            })
        }
    })
}

function createCardElement(image, title, descriptionElement){
    let card = document.createElement("table");
    card.classList.add("card");
    let imageWrapper = document.createElement("div");
    imageWrapper.classList.add("image-wrapper");
    let profile = document.createElement("img");
    profile.setAttribute("src", image);
    imageWrapper.appendChild(profile);
    card.appendChild(imageWrapper);
    body = document.createElement("div");
    body.classList.add("card-body");
    h5 = document.createElement("h5");
    h5.textContent = title
    h5.classList.add("card-title");
    descriptionElement.classList.add("card-text");
    body.appendChild(h5);
    body.appendChild(descriptionElement);
    card.appendChild(body);
    return card;
}

function showUser(userId){
    getUser(userId, (user) => {
        document.querySelector(".sidebar>button").innerHTML = user.username;
        document.querySelector(".sidebar>img").setAttribute("src", user.image);
    })
}

function showNowPlaying(userId){
    getNowListening(userId, (song) => {
        document.querySelector(".music-player .image-container img").setAttribute("src", song.image)
        document.querySelector(".music-player .song-description .title").innerHTML = song.title;
        document.querySelector(".music-player .song-description .artist").innerHTML = song.author;
    })
}

function showLastListened(userId){
    wrappers = document.querySelectorAll("#lastListened .carousel-inner .carousel-item .cards-wrapper")
    getRecentSongs(userId, (songsList) => {
        firstPage = songsList.slice(0, 5)
        secondPage = songsList.slice(5, 10)
        for(let song of firstPage){
            let p = document.createElement("p");
            p.textContent = song.author;
            let i = document.createElement("i");
            i.classList.add("fas", "fa-ellipsis-vertical")
            p.insertAdjacentElement("beforeend", i)
            wrappers[0].insertAdjacentElement("beforeend", createCardElement(song.image, song.title, p))
        }
        for(let song of secondPage){
            let p = document.createElement("p");
            p.textContent = song.author;
            let i = document.createElement("i");
            i.classList.add("fas", "fa-ellipsis-vertical")
            p.insertAdjacentElement("beforeend", i)
            wrappers[1].insertAdjacentElement("beforeend", createCardElement(song.image, song.title, p))
        }
    })
}

function showLastAlbums(){
    wrappers = document.querySelectorAll("#recentAlbums .carousel-inner .carousel-item .cards-wrapper")
    getRecentAlbums((albumsList) => {
        firstPage = albumsList.slice(0, 5);
        secondPage = albumsList.slice(5, 10);
        for(let album of firstPage){
            let p = document.createElement("p");
            p.textContent = album.author;
            let i = document.createElement("i");
            i.classList.add("fas", "fa-ellipsis-vertical")
            p.insertAdjacentElement("beforeend", i)
            wrappers[0].insertAdjacentElement("beforeend", createCardElement(album.image, album.title, p))
        }
        for(let album of secondPage){
            let p = document.createElement("p");
            p.textContent = album.author;
            let i = document.createElement("i");
            i.classList.add("fas", "fa-ellipsis-vertical")
            p.insertAdjacentElement("beforeend", i)
            wrappers[1].insertAdjacentElement("beforeend", createCardElement(album.image, album.title, p))
        }
    })
}

function showWaitingList(userId){
    waitingList = document.querySelector("#waitingList")
    getWaitList(userId, (songsList) => {
        for(let song of songsList){
            waitingList.insertAdjacentHTML("beforeend", `
            <li class="list-group-item">
                <img src="${song.image}">
                <p class="attente_title">${song.title}</p>
                <p class="attente_info">${song.author}<br>${song.duration}</p>
            </li>
            `)
        }
    })
}

showWaitingList(1);
showLastListened(1);
showUser(1);
showNowPlaying(1);
showLastAlbums();
initPlayPauseButton();
initLikeButton();