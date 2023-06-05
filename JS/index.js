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

document.querySelector("input#musicProgress").addEventListener('change', (e) => {
    document.querySelector(".progress-controller .current-time").innerHTML = secondsToTimeString(e.target.value);
    if(e.target.value > audioLector.currentTime + 1 || e.target.value < audioLector.currentTime - 1){
        audioLector.currentTime = e.target.value;
        playerTimeInterval = setInterval(() => {
            document.querySelector(".progress-controller .current-time").innerHTML = secondsToTimeString(audioLector.currentTime);
            let range = document.querySelector("input#musicProgress").setAttribute("value", audioLector.currentTime);
        }, 1000)
    }
})

getUserId(userId => {
    //show left bar infos
    showWaitingList(userId);
    showUser(userId);
    //show footer info
    initPlayPauseButton();
    initLikeButton();
    getNowListening(userId, setNowPlaying)
    //show nav info

    //show index page info
    showLastListened(userId);
    showLastAlbums();
});