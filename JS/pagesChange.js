function moveToIndex(callback){
    let previousStyles = document.querySelectorAll('link.current-media-style')
    previousStyles.forEach(elem => {
        elem.remove();
    })
    let head = document.querySelector('head');
    let style = document.createElement('link');
    style.setAttribute("href", '../CSS/index.css');
    style.setAttribute("type", 'text/css');
    style.setAttribute("rel", 'stylesheet');
    style.classList.add("current-media-style")
    head.append(style);
    const template = document.querySelector('#affichage-index');
    const clone = template.content.cloneNode(true);
    const content = document.querySelector('#main-content');
    console.log(content)
    console.log(clone.querySelector('#main-content'))
    content.replaceWith(clone.querySelector('#main-content'));
    callback;
}

function moveToAlbum(callback){
    let previousStyles = document.querySelectorAll('link.current-media-style')
    previousStyles.forEach(elem => {
        elem.remove();
    })
    let head = document.querySelector('head');
    let style = document.createElement('link');
    style.setAttribute("href", '../CSS/album.css');
    style.setAttribute("type", 'text/css');
    style.setAttribute("rel", 'stylesheet');
    style.classList.add("current-media-style")
    head.append(style);
    const template = document.querySelector('#affichage-album');
    const clone = template.content.cloneNode(true);
    const content = document.querySelector('#main-content');
    console.log(content)
    console.log(clone.querySelector('#main-content'))
    content.replaceWith(clone.querySelector('#main-content'));
    callback;
}

function moveToArtist(callback){
    let previousStyles = document.querySelectorAll('link.current-media-style')
    previousStyles.forEach(elem => {
        elem.remove();
    })
    let head = document.querySelector('head');
    let style = document.createElement('link');
    style.setAttribute("href", '../CSS/artiste.css');
    style.setAttribute("type", 'text/css');
    style.setAttribute("rel", 'stylesheet');
    style.classList.add("current-media-style")
    head.append(style);
    const template = document.querySelector('#affichage-artiste');
    const clone = template.content.cloneNode(true);
    const content = document.querySelector('#main-content');
    console.log(content)
    console.log(clone.querySelector('#main-content'))
    content.replaceWith(clone.querySelector('#main-content'));
    callback;
}

function moveToProfile(callback){
    let previousStyles = document.querySelectorAll('link.current-media-style')
    previousStyles.forEach(elem => {
        elem.remove();
    })
    let head = document.querySelector('head');
    let style = document.createElement('link');
    style.setAttribute("href", '../CSS/info_profil.css');
    style.setAttribute("type", 'text/css');
    style.setAttribute("rel", 'stylesheet');
    style.classList.add("current-media-style")
    head.append(style);
    const template = document.querySelector('#affichage-profil');
    const clone = template.content.cloneNode(true);
    const content = document.querySelector('#main-content');
    console.log(content)
    console.log(clone.querySelector('#main-content'))
    content.replaceWith(clone.querySelector('#main-content'));
    callback;
}

function moveToSearch(callback){
    let previousStyles = document.querySelectorAll('link.current-media-style')
    previousStyles.forEach(elem => {
        elem.remove();
    })
    let head = document.querySelector('head');
    let style = document.createElement('link');
    style.setAttribute("href", '../CSS/recherche.css');
    style.setAttribute("type", 'text/css');
    style.setAttribute("rel", 'stylesheet');
    style.classList.add("current-media-style")
    head.append(style);
    const template = document.querySelector('#affichage-recherche');
    const clone = template.content.cloneNode(true);
    const content = document.querySelector('#main-content');
    console.log(content)
    console.log(clone.querySelector('#main-content'))
    content.replaceWith(clone.querySelector('#main-content'));
    callback;
}

function moveToPlaylist(callback){
    let previousStyles = document.querySelectorAll('link.current-media-style')
    previousStyles.forEach(elem => {
        elem.remove();
    })
    let head = document.querySelector('head');
    let style = document.createElement('link');
    style.setAttribute("href", '../CSS/playlist.css');
    style.setAttribute("type", 'text/css');
    style.setAttribute("rel", 'stylesheet');
    style.classList.add("current-media-style")
    head.append(style);
    const template = document.querySelector('#affichage-playlist');
    const clone = template.content.cloneNode(true);
    const content = document.querySelector('#main-content');
    console.log(content)
    console.log(clone.querySelector('#main-content'))
    content.replaceWith(clone.querySelector('#main-content'));
    callback;
}

function moveToPlaylistsList(callback){
    let previousStyles = document.querySelectorAll('link.current-media-style')
    previousStyles.forEach(elem => {
        elem.remove();
    })
    let head = document.querySelector('head');
    let style = document.createElement('link');
    style.setAttribute("href", '../CSS/menu_playlist.css');
    style.setAttribute("type", 'text/css');
    style.setAttribute("rel", 'stylesheet');
    style.classList.add("current-media-style")
    head.append(style);
    const template = document.querySelector('#affichage-liste-playlists');
    const clone = template.content.cloneNode(true);
    const content = document.querySelector('#main-content');
    console.log(content)
    console.log(clone.querySelector('#main-content'))
    content.replaceWith(clone.querySelector('#main-content'));
    callback;
}

function moveToSettings(callback){
    let previousStyles = document.querySelectorAll('link.current-media-style')
    previousStyles.forEach(elem => {
        elem.remove();
    })
    let head = document.querySelector('head');
    let style = document.createElement('link');
    style.setAttribute("href", '../CSS/profil.css');
    style.setAttribute("type", 'text/css');
    style.setAttribute("rel", 'stylesheet');
    style.classList.add("current-media-style")
    head.append(style);
    const template = document.querySelector('#affichage-reglages');
    const clone = template.content.cloneNode(true);
    const content = document.querySelector('#main-content');
    console.log(content)
    console.log(clone.querySelector('#main-content'))
    content.replaceWith(clone.querySelector('#main-content'));
    callback;
}