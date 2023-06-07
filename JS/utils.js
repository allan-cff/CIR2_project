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

function initPreviousNextButtons(){
    document.querySelector('button.forward-button').addEventListener('click', playNext);
    document.querySelector('button.backward-button').addEventListener('click', playPrevious);
}

function secondsToMinutesTimeString(seconds){
    return Math.floor(seconds/60).toString(10) + ':' + (seconds%60).toFixed(0).toString(10).padStart(2, "0");
}

function secondsToHoursTimeString(seconds){
    return Math.floor(seconds/3600).toString(10) + 'h ' + Math.floor((seconds%3600)/60).toString(10) + 'min ' + (seconds%60).toFixed(0).toString(10).padStart(2, "0") + 's';
}

function playNow(songId){
    userId = localStorage.getItem('userId');
    listen(userId, songId, (song) => {
        setNowPlaying(song, true);
    })
}

function playNext(){
    userId = localStorage.getItem('userId');
    getNextSong(userId, (song) => {
        setNowPlaying(song, true);
        showLastListened(userId);
    })
}

function playPrevious(){
    userId = localStorage.getItem('userId');
    getPrevSong(userId, (song) => {
        setNowPlaying(song, true);
        showLastListened(userId);
    })
}

function setNowPlaying(song, forcePlay=false){
    document.querySelector(".music-player .image-container img").setAttribute("src", song.image)
    document.querySelector(".music-player .song-description .title").innerHTML = song.titre;
    document.querySelector(".music-player .song-description .artists-list").innerHTML = "";
    song.artistes.forEach((artist) => {
        let artistButton = document.createElement("button")
        artistButton.classList.add('artist')
        artistButton.setAttribute('data-rythmicid', artist.id)
        artistButton.innerHTML = artist.nom
        artistButton.addEventListener("click", (e) => {
            id = e.target.getAttribute('data-rythmicId');
            moveToArtist((id)=>{
                getArtist(id, (artist) => {
                    showArtist(artist)
                })
            }, id)
        })
        document.querySelector(".music-player .song-description .artists-list").appendChild(artistButton)
    })
    userId = localStorage.getItem('userId');
    showFavorite(userId, song.id)
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
        if(audioLector.paused){
            let icon = document.querySelector('footer .music-player .progress-controller .control-buttons .play-pause-button i');
            icon.classList.toggle("fa-play")
            icon.classList.toggle("fa-pause")
        }
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

function showFavorite(userId, songId){
    getFavorites(userId, (favorite) => {
        icon = document.querySelector('footer .music-player .song-bar .icons button i')
        for(let song of favorite.tracks){
            if(song.id == songId){
                if(icon.classList.contains('far')){
                    icon.classList.toggle("far")
                    icon.classList.toggle("fas")
                }
                return;
            }
        }
        if(icon.classList.contains('fas')){
            icon.classList.toggle("far")
            icon.classList.toggle("fas")
        }
    })
}

function showFavoriteDropdownItem(userId, songId, linkElem){
    getFavorites(userId, (favorite) => {
        for(let song of favorite.tracks){
            if(song.id == songId){
                linkElem.innerHTML = '<i class="fas fa-heart"></i>Retirer des favoris';
                return;
            }
        }
        linkElem.innerHTML = '<i class="fa fa-heart"></i>Ajouter aux favoris';
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
        userId = localStorage.getItem('userId');
        if(icon.classList.contains("fas")){
            getNowListening(userId, song => {
                addToFavorite(userId, song.id)
            })
        } else {
            getNowListening(userId, song => {
                deleteFavorite(userId, song.id)
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
    let wrappers = document.querySelectorAll("#lastListened .carousel-inner .carousel-item .cards-wrapper")
    wrappers.forEach(wrapper => {
        while (wrapper.firstChild) {
            wrapper.removeChild(wrapper.lastChild);
        }
    })
    getRecentSongs(userId, (songsList) => {
        let firstPage = songsList.slice(0, 5);
        let secondPage = songsList.slice(5, 10);
        for(let song of firstPage){
            let p = document.createElement("p");
            p.textContent = song.author;
            wrappers[0].appendChild(createCardElement(song.image, song.titre, song.id, p, (songId) => {playNow(songId)}))
        }
        for(let song of secondPage){
            let p = document.createElement("p");
            p.textContent = song.author;
            wrappers[1].appendChild(createCardElement(song.image, song.titre, song.id, p, (songId) => {playNow(songId)}))
        }
    })
}

function showLastAlbums(){
    let wrappers = document.querySelectorAll("#recentAlbums .carousel-inner .carousel-item .cards-wrapper")
    getRecentAlbums((albumsList) => {
        let firstPage = albumsList.slice(0, 5);
        let secondPage = albumsList.slice(5, 10);
        for(let album of firstPage){
            let p = document.createElement("p");
            p.textContent = album.author;
            wrappers[0].insertAdjacentElement("beforeend", createCardElement(album.image, album.titre, album.id, p, (albumId)=>{moveToAlbum((id)=>{initAlbum(id)}, albumId)}))
        }
        for(let album of secondPage){
            let p = document.createElement("p");
            p.textContent = album.author;
            wrappers[1].insertAdjacentElement("beforeend", createCardElement(album.image, album.titre, album.id, p, (albumId)=>{moveToAlbum((id)=>{initAlbum(id)}, albumId)}))
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
                <p class="attente_title">${song.titre}</p>
                <p class="attente_info">${'coucou'}<br>${secondsToMinutesTimeString(song.duree)}</p>
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
        for(let track of album.tracks){
            const template = document.querySelector('#playlist-row-template');
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

function showPlaylist(playlist){
    listPlaylists(userId, (playlistList) => {
        document.querySelector('#playlist-title').innerHTML = playlist.nom
        document.querySelector('.container img').setAttribute('src', playlist.image)
        document.querySelector('#playlist-description').innerHTML = playlist.description
        document.querySelector('.playlist-details .total-duration').innerHTML = 'Durée totale : ' + secondsToHoursTimeString(playlist.duree_totale)
        document.querySelector('.playlist-details .track-count').innerHTML = 'Nombre de titres : ' + playlist.tracks.length;
        for(let track of playlist.tracks){
            const template = document.querySelector('#playlist-row-template');
            const clone = template.content.cloneNode(true);
            clone.querySelector('.play-button').setAttribute('data-rythmicId', track.id)
            clone.querySelector('.play-button').addEventListener("click", (e) => {
                id = e.target.getAttribute('data-rythmicId');
                playNow(id)
            })
            clone.querySelector("td:nth-child(2) img").setAttribute('src', track.image)
            clone.querySelector('td:nth-child(2) img').setAttribute('data-rythmicId', track.id_album)
            clone.querySelector('td:nth-child(2) img').addEventListener("click", (e) => {
                id = e.target.getAttribute('data-rythmicId');
                moveToAlbum((id)=>{initAlbum(id)}, id)
            })
            clone.querySelector("td:nth-child(3)").innerHTML = track.titre;
            for(let artist of track.artistes){
                let bouton = document.createElement("button")
                bouton.innerHTML = artist.nom;
                bouton.setAttribute('data-rythmicId', artist.id)
                clone.querySelector("td:nth-child(4)").appendChild(bouton)
                bouton.addEventListener("click", (e) => {
                    id = e.target.getAttribute('data-rythmicId');
                    moveToArtist((id)=>{
                        getArtist(id, (artist) => {
                            showArtist(artist)
                        })
                    }, id)
                })
            }
            clone.querySelectorAll(".dropdown-menu a").forEach(elem => {
                elem.setAttribute("data-rythmicId", track.id);
            })
            userId = localStorage.getItem('userId');
            playlistSelect = clone.querySelector("#playlist-select");
            for(let playlist of playlistList){
                let option = document.createElement("option");
                option.setAttribute('value', playlist.id);
                option.innerHTML = playlist.nom;
                playlistSelect.appendChild(option);
            }
            clone.querySelector('.modal-content').setAttribute('data-rythmicId', track.id);
            clone.querySelector("#add-to-playlist").addEventListener("click", (e) => {
                let playlistToAddId = e.target.parentElement.parentElement.querySelector('#playlist-select').value;
                console.log(e)
                console.log(e.target)
                console.log(e.target.parentElement)
                console.log(e.target.parentElement.parentElement)
                console.log(e.target.parentElement.parentElement)
                let songId = e.target.parentElement.parentElement.getAttribute('data-rythmicId')
                console.log(playlistToAddId, songId);
                addToPlaylist(userId, playlistToAddId, songId)
            })
            showFavoriteDropdownItem(userId, track.id, clone.querySelector('#toggle-like'))
            clone.querySelector('#toggle-like').setAttribute('data-rythmic', track.id)
            clone.querySelector('#toggle-like').addEventListener("click", (e) => {
                let elem;
                if(e.target.tagName === "A"){
                    elem = e.target
                } else {
                    elem = e.target.parentElement
                }
                if(elem.firstElementChild.classList.contains("far")){
                    addToFavorite(userId, elem.getAttribute('data-rythmic'))
                    elem.innerHTML = '<i class="fas fa-heart"></i>Retirer des favoris';
                } else {
                    deleteFavorite(userId, elem.getAttribute('data-rythmic'))
                    elem.innerHTML = '<i class="far fa-heart"></i>Ajouter aux favoris';
                }
            })
            clone.querySelector("td:nth-child(6)").innerHTML = secondsToMinutesTimeString(track.duree);
            document.querySelector('tbody').appendChild(clone);
        }
    })
}

function showPlaylistList(playlistList){
    carousel = document.querySelector("#playlistsCarousel .carousel-inner")
    pages = []
    for(let i=5; i-5 < playlistList.length; i=i+5){
        end = Math.min(i, playlistList.length)
        pages.push(playlistList.slice(i-5, end))
    }
    for(page of pages){
        item = document.createElement("div")
        item.classList.add("carousel-item")
        wrapper = document.createElement("div")
        wrapper.classList.add("cards-wrapper")
        item.appendChild(wrapper)
        carousel.appendChild(item)
        for(playlist of page){
            let p = document.createElement("p");
            p.textContent = secondsToHoursTimeString(playlist.duree_totale) + " - " + playlist.nb_morceaux + " titres";
            wrapper.appendChild(createCardElement(playlist.image, playlist.nom, playlist.id, p, (playlistId) => {
                moveToPlaylist(()=>{
                    userId = localStorage.getItem('userId');
                    getPlaylist(userId, playlistId, (playlist)=>{
                        showPlaylist(playlist)
                    })
                }, playlistId);
            }))
        }
    }
    carousel.querySelector("#playlistsCarousel .carousel-inner .carousel-item").classList.add("active")
}

function showProfile(profile){
    document.querySelector('#username').innerHTML = profile.username;
    document.querySelector('#name').innerHTML = profile.name;
    document.querySelector('#surname').innerHTML = profile.surname;
    document.querySelector('#mail').innerHTML = profile.mail;
    document.querySelector('#birth').innerHTML = profile.birth;
}

function showSettings(profile){
    let now = new Date()
    let birth = new Date(profile.birth)
    let age = now.getFullYear() - birth.getFullYear()
    if((now.getMonth() < birth.getMonth()) || (now.getMonth() === birth.getMonth()) && (now.getDate() < birth.getDate())){
        age = age - 1;
    }
    document.querySelector('#age').value = age.toString(10) + " ans";
    document.querySelector('#profile-image').setAttribute('src', profile.image)
    document.querySelector('#username').value = profile.username;
    document.querySelector('#name').value = profile.name;
    document.querySelector('#surname').value = profile.surname;
    document.querySelector('#mail').value = profile.mail;
    document.querySelector('#birth').value = profile.birth;
    document.querySelector('#birth').addEventListener('change', (e) => {
        let now = new Date()
        let birth = new Date(e.target.value)
        let age = now.getFullYear() - birth.getFullYear()
        if((now.getMonth() < birth.getMonth()) || (now.getMonth() === birth.getMonth()) && (now.getDate() < birth.getDate())){
            age = age - 1;
        }
        document.querySelector('#age').value = age.toString(10) + " ans";
    })
    document.querySelector('#set-profile').addEventListener("submit", (e) => {
        e.preventDefault();
        let body = new FormData()
        body.append("nom", document.querySelector('#name').value);
        body.append("username", document.querySelector('#username').value)
        body.append("prenom", document.querySelector('#surname').value)
        body.append("mail", document.querySelector('#mail').value)
        body.append("password", document.querySelector('#password').value)
        body.append("age", document.querySelector('#birth').value)
        modifyUser(profile.id, body, () => {
            getUser(userId, (user) => {
                showSettings(user)
            })
        })
    })
}

function showArtist(artist){
    document.querySelector('#nom-artiste').innerHTML = artist.nom
    document.querySelector('#image-artiste').setAttribute('src', artist.image)
    document.querySelector('#description-artiste').innerHTML = "Description : "
    document.querySelector('#nb-listeners-artiste').innerHTML = "Nombre d'auditeur par mois : " + artist.nb_auditeurs;
}