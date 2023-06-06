function toggleMusic(){
    if(audioLector.src !== ''){
        if(audioLector.paused){
            audioLector.play()
            playerTimeInterval = setInterval(() => {
                document.querySelector(".progress-controller .current-time").innerHTML = secondsToMinutesTimeString(audioLector.currentTime);
                document.querySelector("input#musicProgress").setAttribute("value", audioLector.currentTime);
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

function secondsToMinutesTimeString(seconds){
    return Math.floor(seconds/60).toString(10) + ':' + (seconds%60).toFixed(0).toString(10).padStart(2, "0");
}

function secondsToHoursTimeString(seconds){
    return Math.floor(seconds/3600).toString(10) + 'h ' + Math.floor((seconds%3600)/60).toString(10) + 'min ' + (seconds%60).toFixed(0).toString(10).padStart(2, "0") + 's';
}

function setNowPlaying(song, forcePlay=false){
    document.querySelector(".music-player .image-container img").setAttribute("src", song.image)
    document.querySelector(".music-player .song-description .title").innerHTML = song.title;
    document.querySelector(".music-player .song-description .artist").innerHTML = song.author;
    audioLector.setAttribute("src", song.data)
    audioLector.load()
    document.querySelector(".progress-controller .current-time").innerHTML = "0:00";
    document.querySelector("input#musicProgress").setAttribute("min", 0);
    document.querySelector("input#musicProgress").value = 0;
    audioLector.addEventListener("loadeddata", (event) => {
        document.querySelector("input#musicProgress").setAttribute("max", audioLector.duration)
        document.querySelector(".progress-controller .total-time").innerHTML = secondsToMinutesTimeString(audioLector.duration);
        if(!audioLector.paused){
            playerTimeInterval = setInterval(() => {
                document.querySelector(".progress-controller .current-time").innerHTML = secondsToMinutesTimeString(audioLector.currentTime);
                document.querySelector("input#musicProgress").setAttribute("value", audioLector.currentTime);
            }, 1000)
        }
    });
    if(forcePlay){
        audioLector.play();
    }
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

function initMusicProgress(){
    document.querySelector("input#musicProgress").addEventListener('change', (e) => {
        document.querySelector(".progress-controller .current-time").innerHTML = secondsToMinutesTimeString(e.target.value);
        if(e.target.value > audioLector.currentTime + 1 || e.target.value < audioLector.currentTime - 1){
            audioLector.currentTime = e.target.value;
            playerTimeInterval = setInterval(() => {
                document.querySelector(".progress-controller .current-time").innerHTML = secondsToMinutesTimeString(audioLector.currentTime);
                document.querySelector("input#musicProgress").setAttribute("value", audioLector.currentTime);
            }, 1000)
        }
    })
}

function initMusicVolume(){
    document.querySelector("input#musicVolume").value = audioLector.volume;
    document.querySelector("input#musicVolume").addEventListener('change', (e) => {
        audioLector.volume = e.target.value;
    })
}

function createCardElement(image, title, id, descriptionElement, callbackOnClick){
    let card = document.createElement("table");
    card.classList.add("card");
    let imageWrapper = document.createElement("div");
    imageWrapper.classList.add("image-wrapper");
    let profile = document.createElement("img");
    profile.setAttribute("src", image);
    profile.setAttribute("data-rythmicId", id);
    profile.addEventListener("click", (e) => {
        callbackOnClick(e.target.getAttribute("data-rythmicId"));
    })
    imageWrapper.appendChild(profile);
    card.appendChild(imageWrapper);
    body = document.createElement("div");
    body.classList.add("card-body");
    h5 = document.createElement("h5");
    h5.textContent = title;
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
        firstPage = songsList.slice(0, 5);
        secondPage = songsList.slice(5, 10);
        for(let song of firstPage){
            let p = document.createElement("p");
            p.textContent = song.author;
            let i = document.createElement("i");
            i.classList.add("fas", "fa-ellipsis-vertical");
            p.insertAdjacentElement("beforeend", i);
            wrappers[0].insertAdjacentElement("beforeend", createCardElement(song.image, song.title, song.id, p, (songId) => {getMusic(songId, (song) => {setNowPlaying(song, true)})}))
        }
        for(let song of secondPage){
            let p = document.createElement("p");
            p.textContent = song.author;
            let i = document.createElement("i");
            i.classList.add("fas", "fa-ellipsis-vertical");
            p.insertAdjacentElement("beforeend", i);
            wrappers[1].insertAdjacentElement("beforeend", createCardElement(song.image, song.title, song.id, p, (songId) => {getMusic(songId, (song) => {setNowPlaying(song, true)})}))
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
            i.classList.add("fas", "fa-ellipsis-vertical");
            p.insertAdjacentElement("beforeend", i);
            wrappers[0].insertAdjacentElement("beforeend", createCardElement(album.image, album.title, album.id, p, (albumId)=>{moveToAlbum((id)=>{initAlbum(id)}, albumId)}))
        }
        for(let album of secondPage){
            let p = document.createElement("p");
            p.textContent = album.author;
            let i = document.createElement("i");
            i.classList.add("fas", "fa-ellipsis-vertical");
            p.insertAdjacentElement("beforeend", i);
            wrappers[1].insertAdjacentElement("beforeend", createCardElement(album.image, album.title, album.id, p, (albumId)=>{moveToAlbum((id)=>{initAlbum(id)}, albumId)}))
        }
    })
}               

function showWaitingList(userId){
    waitingList = document.querySelector("#waitingList");
    getWaitList(userId, (songsList) => {
        for(let song of songsList){
            waitingList.insertAdjacentHTML("beforeend", `
            <li class="list-group-item">
                <img src="${song.image}">
                <p class="attente_title">${song.title}</p>
                <p class="attente_info">${song.author}<br>${song.duration}</p>
            </li>
            `);
        }
    })
}

function initAlbum(albumId){
    getAlbum(albumId, (album) => {
        document.querySelector('#album-cover').setAttribute("src", album.cover);
        document.querySelector('.info-sup b').innerHTML = album.title;
        document.querySelector('#album-artist-name').innerHTML = album.author;
        document.querySelector('#album-duration').innerHTML = secondsToHoursTimeString(album.duration);
        document.querySelector('#album-tracks-count').innerHTML = album.tracksList.length;
        for(let track of album.tracksList){
            const template = document.querySelector('#album-row-template');
            const clone = template.content.cloneNode(true);
            clone.querySelector("td:nth-child(2)").innerHTML = track.title;
            clone.querySelector("td:nth-child(3)>button").innerHTML = track.author;
            clone.querySelectorAll(".dropdown-menu a").forEach(elem => {
                elem.setAttribute("data-rythmicId", track.id);
            })
            clone.querySelector("td:nth-child(5)").innerHTML = secondsToMinutesTimeString(track.duration);
            document.querySelector('tbody').appendChild(clone);
        }
    })
}