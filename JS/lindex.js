pauseButton = document.querySelector('footer .music_player .progress_controller .control_buttons .play-pause-button');
pauseButton.addEventListener('click', (e) => {
    let icon;
    if(e.target.tagName === "BUTTON"){
        icon = e.target.firstElementChild
    } else {
        icon = e.target
    }
    icon.classList.toggle("fa-play")
    icon.classList.toggle("fa-pause")
})

likeButton = document.querySelector('footer .music_player .song_bar .icons button');
likeButton.addEventListener('click', (e) => {
    let icon;
    if(e.target.tagName === "BUTTON"){
        icon = e.target.firstElementChild
    } else {
        icon = e.target
    }
    icon.classList.toggle("far")
    icon.classList.toggle("fas")
})

