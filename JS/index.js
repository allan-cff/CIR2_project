/*
var carouselWidth = $('.carousel-inner')[0].scrollWidth;
var cardWidth = $('.carousel-item');

var scrollPosition = 0;

$('.carousel-control-next').on('click', function (){
    console.log('next');
    scrollPosition = scrollPosition + cardWidth;
    $('.carousel-inner').animate({scrollLeft: scrollPosition},
    600);
});
*/

//init global variables
audioLector = new Audio();
audioLector.addEventListener("ended", playNext);

playerTimeInterval = null;


getUserId((userId) => {
    localStorage.setItem('userId', userId);
    //show left bar infos
    showUser(userId);
    //show footer info
    initPreviousNextButtons();
    initPlayPauseButton();
    initLikeButton();
    initMusicProgress();
    initMusicVolume();
    getNowListening(userId, setNowPlaying);
    //show index page info
    showLastListened(userId);
    showLastAlbums();
});

document.querySelector('.logo img').addEventListener("click", (e)=>{
    moveToIndex(()=>{
        userId = localStorage.getItem('userId');
        showLastListened(userId);
        showLastAlbums();
    });
});

document.querySelector('nav button#liked-titles').addEventListener("click", (e)=>{
    moveToPlaylist(()=>{
        userId = localStorage.getItem('userId');
        getFavorites(userId, (playlist)=>{showPlaylist(playlist)})
    });
});

document.querySelector('nav button#playlist-list').addEventListener("click", (e)=>{
    moveToPlaylistsList(()=>{
        userId = localStorage.getItem('userId');
        listPlaylists(userId, (playlistList)=>{showPlaylistList(playlistList)})
    });
});

document.querySelector('#go-to-profile').addEventListener("click", () => {
    moveToProfile(()=>{
        userId = localStorage.getItem('userId');
        getUser(userId, (user)=>{
            showProfile(user)
        })
    });
});

document.querySelector('#go-to-settings').addEventListener("click", () => {
    moveToSettings(()=>{
        userId = localStorage.getItem('userId');
        getUser(userId, (user)=>{
            showSettings(user)
        })
    });
});

document.querySelector('#main-search').addEventListener("submit", (e) => {
    e.preventDefault();
    moveToSearch(() => {
        showRecherche();
    });
    console.log(e)
})