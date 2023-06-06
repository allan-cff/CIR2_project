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
    //show left bar infos
    showWaitingList(userId);
    showUser(userId);
    //show footer info
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
        console.log("index clicked")
        getUserId((userId) => {
            showLastListened(userId);
            showLastAlbums();
        })
    });
})