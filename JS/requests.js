function jsonToFormdata(data){
    let form_data = new FormData();
    for (let key in data) {
        console.log(key)
        form_data.append(key, data[key]);
    }
    return form_data
}

function getUserId(callback){
    ajaxRequest('get', `users/loggedId`, (body) => {callback(body.id)});
}

function getUser(userId, callback){
    console.log("Getting user " + userId);
    ajaxRequest('get', `/users/${userId}`, (body) => {callback(body)});
}

function modifyUser(userId, body, callback){
    ajaxRequest('put', `users/${userId}`, (body) => {callback(body)}, body);
}

function deleteUser(userId, callback){
    ajaxRequest('delete', `users/${userId}`, callback);
}

function getNowListening(userId, callback){
    ajaxRequest('get', `users/${userId}/nowlistening`, (body) => {callback(body)});
}

function listen(userId, songId, callback){
    ajaxRequest('get', `users/${userId}/listen/${songId}`, (body) => {callback(body)});
}

function getNextSong(userId, callback){
    ajaxRequest('get', `users/${userId}/nextsong`, (body) => {callback(body)});
}

function getPrevSong(userId, callback){
    ajaxRequest('get', `users/${userId}/prevsong`, (body) => {callback(body)});
}

function getRecentSongs(userId, callback){
    ajaxRequest('get', `users/${userId}/recents`, (body) => {callback(body)});
}

function deleteRecentSong(userId, songId, callback){
    ajaxRequest('delete', `users/${userId}/recents/${songId}`, callback);
}

function getWaitList(userId, callback){
    ajaxRequest('get', `users/${userId}/waitlist`, (body) => {callback(body)});
}

function addToWaitlist(userId, songId, callback){
    ajaxRequest('post', `users/${userId}/waitlist`, callback, `id=${songId}`);
}

function getFavorites(userId, callback){
    ajaxRequest('get', `users/${userId}/favorites`, (body) => {callback(body)});
}

function addToFavorite(userId, songId, callback){
    ajaxRequest('post', `users/${userId}/favorites`, callback, `id=${songId}`);
}

function deleteFavorite(userId, songId, callback){
    ajaxRequest('delete', `users/${userId}/favorites/${songId}`, callback);
}

function listPlaylists(userId, callback){
    ajaxRequest('get', `users/${userId}/playlists`, (body) => {callback(body)});
}

function addPlaylist(userId, body, callback){
    ajaxRequest('post', `users/${userId}/playlists`, callback, jsonToFormdata(body));
}

function getPlaylist(userId, playlistId, callback){
    ajaxRequest('delete', `users/${userId}/playlists/${playlistId}`, (body) => {callback(body)});
}

function addToPlaylist(userId, playlistId, songId, callback){
    ajaxRequest('post', `users/${userId}/playlists/${playlistId}/tracks`, callback, `id=${songId}`);
}

function deleteFromPlaylist(userId, playlistId, songId, callback){
    ajaxRequest('delete', `users/${userId}/playlists/${playlistId}/tracks/${songId}`, callback);
}

function listArtists(callback){
    ajaxRequest('get', `artists`, callback);
}

function getArtist(artistId, callback){
    ajaxRequest('get', `artists/${artistId}`, callback);
}

function listArtistAlbums(artistId, callback){
    ajaxRequest('get', `artists/${artistId}/albums`, callback);
}

function getRecentAlbums(callback){
    ajaxRequest('get', `albums/recents`, (body) => {callback(body)});
}

function getAlbum(albumId, callback){
    ajaxRequest('get', `albums/${albumId}`, (body) => {callback(body)});
}

function listMusics(callback){
    ajaxRequest('get', `/musics`, callback);
}

function search(query, isAdmin, isAlbum, isMusic, callback){
    let include = ''
    if(isAdmin){
        include+='admin'
    }
    if(isAlbum){
        include+='album'
    }
    if(isMusic){
        include+='music'
    }
    ajaxRequest('get', `/search?include=${include}&query=${encodeURI(query)}`, (body)=>{callback(body)});
}