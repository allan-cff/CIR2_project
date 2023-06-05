function toggleMusic(){
    if(audioLector.src !== ''){
        if(audioLector.paused){
            audioLector.play()
            playerTimeInterval = setInterval(() => {
                document.querySelector(".progress-controller .current-time").innerHTML = secondsToTimeString(audioLector.currentTime);
                let range = document.querySelector("input#musicProgress").setAttribute("value", audioLector.currentTime);
            }, 1000)
        } else {
            audioLector.pause()
            clearInterval(playerTimeInterval)
        }
    }    
}

function playNext(){
    console.log("Playing next");
}

function playPrevious(){
    console.log("Playing previous");
}

function secondsToTimeString(seconds){
    return Math.floor(seconds/60).toString(10) + ':' + (seconds%60).toFixed(0).toString(10).padStart(2, "0");
}

function setNowPlaying(song){
    document.querySelector(".music-player .image-container img").setAttribute("src", song.image)
    document.querySelector(".music-player .song-description .title").innerHTML = song.title;
    document.querySelector(".music-player .song-description .artist").innerHTML = song.author;
    audioLector.setAttribute("src", song.data)
    audioLector.load()
    document.querySelector(".progress-controller .current-time").innerHTML = "0:00";
    audioLector.addEventListener("loadeddata", (event) => {
        let range = document.querySelector("input#musicProgress");
        range.setAttribute("min", 0)
        range.setAttribute("max", audioLector.duration)
        document.querySelector(".progress-controller .total-time").innerHTML = secondsToTimeString(audioLector.duration);
        if(!audioLector.paused){
            playerTimeInterval = setInterval(() => {
                document.querySelector(".progress-controller .current-time").innerHTML = secondsToTimeString(audioLector.currentTime);
                let range = document.querySelector("input#musicProgress").setAttribute("value", audioLector.currentTime);
            }, 1000)
        }
    });  
}

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