function jsonToFormdata(data){
    let form_data = new FormData();
    for (let key in data) {
        form_data.append(key, item[key]);
    }
    return form_data
}

function getUserId(callback){
    callback(1);
    //ajaxRequest('get', `/users/logged_id`, callback);
}

function getUser(userId, callback){
    callback({
        image:"../Ressources/pat.png",
        name:"Cueff",
        surname:"Allan",
        username: "allan_cff",
        mail: "blabla"
    })
//    ajaxRequest('get', `/users/${userId}`, callback);
}

function modifyUser(userId, body, callback){
    ajaxRequest('put', `/users/${userId}`, callback, jsonToFormdata(body));
}

function deleteUser(userId, callback){
    ajaxRequest('delete', `/users/${userId}`, callback);
}

function getNowListening(userId, callback){
    callback({author:"Allan", title:"Bon son", image:"../Ressources/alpha.png", data:"../Ressources/song.mp3"})
    //ajaxRequest('get', `/users/${userId}/nowlistening`, callback);
}

function getNextSong(userId, callback){
    callback({author:"Allan", title:"Bon son", image:"../Ressources/alpha.png", data:"../Ressources/song.mp3"})
    //ajaxRequest('get', `/users/${userId}/nextsong`, callback);
}

function getRecentSongs(userId, callback){
    callback([
        {id:1, author:"Allan", title:"Bon son", image:"../Ressources/alpha.png"},
        {id:2, author:"Allan", title:"Bon son1", image:"../Ressources/alpha.png"},
        {id:3, author:"Allan", title:"Bon son2", image:"../Ressources/alpha.png"},
        {id:4, author:"Allan", title:"Bon son3", image:"../Ressources/alpha.png"},
        {id:5, author:"Allan", title:"Bon son4", image:"../Ressources/alpha.png"},
        {id:6, author:"Allan", title:"Bon son5", image:"../Ressources/alpha.png"},
        {id:7, author:"Allan", title:"Bon son6", image:"../Ressources/alpha.png"},
        {id:8, author:"Allan", title:"Bon son7", image:"../Ressources/alpha.png"},
        {id:9, author:"Allan", title:"Bon son8", image:"../Ressources/alpha.png"},
        {id:10, author:"Allan", title:"Bon son9", image:"../Ressources/alpha.png"}
    ])
    //ajaxRequest('get', `/users/${userId}/recents`, callback);
}

function addRecentSong(userId, body, callback){
    ajaxRequest('post', `/users/${userId}/recents`, callback, jsonToFormdata(body));
}

function deleteRecentSong(userId, songId, callback){
    ajaxRequest('delete', `/users/${userId}/recents/${songId}`, callback);
}

function getWaitList(userId, callback){
    callback([
        {id:1, author:"Allan", title:"Bon son", image:"../Ressources/alpha.png"},
        {id:2, author:"Allan", title:"Bon son1", image:"../Ressources/alpha.png"},
        {id:3, author:"Allan", title:"Bon son2", image:"../Ressources/alpha.png"},
        {id:4, author:"Allan", title:"Bon son3", image:"../Ressources/alpha.png"},
        {id:5, author:"Allan", title:"Bon son4", image:"../Ressources/alpha.png"},
        {id:6, author:"Allan", title:"Bon son5", image:"../Ressources/alpha.png"},
        {id:7, author:"Allan", title:"Bon son6", image:"../Ressources/alpha.png"},
        {id:8, author:"Allan", title:"Bon son7", image:"../Ressources/alpha.png"},
        {id:9, author:"Allan", title:"Bon son8", image:"../Ressources/alpha.png"},
        {id:10, author:"Allan", title:"Bon son9", image:"../Ressources/alpha.png"}
    ])
    //ajaxRequest('get', `/users/${userId}/waitlist`, callback);
}

function addToWaitlist(userId, body, callback){
    ajaxRequest('put', `/users/${userId}/waitlist`, callback, jsonToFormdata(body));
}

function getFavorites(userId, callback){
    ajaxRequest('get', `/users/${userId}/favorites`, callback);
}

function addFavorite(userId, body, callback){
    ajaxRequest('put', `/users/${userId}/favorites`, callback, jsonToFormdata(body));
}

function deleteFavorite(userId, songId, callback){
    ajaxRequest('delete', `/users/${userId}/favorites/${songId}`, callback);
}

function listPlaylists(userId, callback){
    ajaxRequest('get', `/users/${userId}/playlists`, callback);
}

function addPlaylist(userId, body, callback){
    ajaxRequest('post', `/users/${userId}/playlists`, callback, jsonToFormdata(body));
}

function getPlaylist(userId, playlistId, callback){
    ajaxRequest('delete', `/users/${userId}/playlists/${playlistId}`, callback);
}

function addToPlaylist(userId, playlistId, body, callback){
    ajaxRequest('post', `/users/${userId}/playlists/${playlistId}/tracks`, callback, jsonToFormdata(body));
}

function deleteFromPlaylist(userId, playlistId, songId, callback){
    ajaxRequest('delete', `/users/${userId}/playlists/${playlistId}/tracks/${songId}`, callback);
}

function listArtists(callback){
    ajaxRequest('get', `/artists`, callback);
}

function getArtist(artistId, callback){
    ajaxRequest('get', `/artists/${artistId}`, callback);
}

function listArtistAlbums(artistId, callback){
    ajaxRequest('get', `/artists/${artistId}/albums`, callback);
}

function getRecentAlbums(callback){
    callback([
        {id:1, title:"good album", author:"JackUzi", image:"../Ressources/j.png"},
        {id:2, title:"good album1", author:"JackUzi", image:"../Ressources/j.png"},
        {id:3, title:"good album2", author:"JackUzi", image:"../Ressources/j.png"},
        {id:4, title:"good album3", author:"JackUzi", image:"../Ressources/j.png"},
        {id:5, title:"good album4", author:"JackUzi", image:"../Ressources/j.png"},
        {id:6, title:"good album5", author:"JackUzi", image:"../Ressources/j.png"},
        {id:7, title:"good album6", author:"JackUzi", image:"../Ressources/j.png"},
        {id:8, title:"good album7", author:"JackUzi", image:"../Ressources/j.png"},
        {id:9, title:"good album8", author:"JackUzi", image:"../Ressources/j.png"},
        {id:10, title:"good album9", author:"JackUzi", image:"../Ressources/j.png"},
    ])
    //ajaxRequest('get', `/albums/recents`, callback);
}

function getAlbum(albumId, callback){
    callback({
        cover: "../Ressources/alpha.png",
        title: "Added by JS",
        author: "Hey",
        duration: 1268,
        tracksList: [
            {id:1, author:"Allan", title:"Bon son", duration:150},
            {id:2, author:"Allan", title:"Bon son1", duration:150},
            {id:3, author:"Allan", title:"Bon son2", duration:150},
            {id:4, author:"Allan", title:"Bon son3", duration:150},
            {id:5, author:"Allan", title:"Bon son4", duration:150},
            {id:6, author:"Allan", title:"Bon son5", duration:150},
            {id:7, author:"Allan", title:"Bon son6", duration:150},
            {id:8, author:"Allan", title:"Bon son7", duration:150},
            {id:9, author:"Allan", title:"Bon son8", duration:150},
            {id:10, author:"Allan", title:"Bon son9", duration:150}
        ]
    })
  //  ajaxRequest('get', `/albums/${albumId}`, callback);
}

function listMusics(callback){
    ajaxRequest('get', `/musics`, callback);
}

function getMusic(trackId, callback){
    console.log("Getting music ", trackId)
    callback({author:"Allan", title:"Bon son", image:"../Ressources/alpha.png", data:"../Ressources/song.mp3"})
//    ajaxRequest('get', `/musics/${trackId}`, callback);
}