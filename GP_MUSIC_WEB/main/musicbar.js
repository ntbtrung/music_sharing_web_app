
const song = document.getElementById("song");
const playBtn = document.querySelector(".player-inner");
const nextBtn = document.querySelector(".play-forward");
const prevBtn = document.querySelector(".play-back");
const durationTime = document.querySelector(".duration");
const playTime = document.querySelector(".playtime");
const rangeBar = document.querySelector(".range");
const musicName = document.querySelector(".music-name");
const singerName = document.querySelector(".singer-name");
const musicImage = document.querySelector(".music-thumb img");
const playRepeat = document.querySelector(".play-repeat");
const playRandom = document.querySelector(".play-random")

//list music here
const musics = [
    {
        id: 1,
        name: "Memes",
        singer: "NIVIRO",
        file: "memes.mp3",
        image:
            "https://avatar-ex-swe.nixcdn.com/song/2018/05/04/c/0/e/0/1525423206353_640.jpg",
    },
    {
        id: 2,
        name: "Never be alone",
        singer: "ThefatRat",
        file: "neverbealone.mp3",
        image:
            "https://i1.sndcdn.com/artworks-000104960955-urm1jm-t500x500.jpg",
    },
    {
        id: 3,
        name: "See you again",
        singer: "Charlie puth",
        file: "seeyouagain.mp3",
        image:
            "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTLndv1ULQ_r1wftMh9_E4qoljiMrgAGHD0Iw&usqp=CAU"
    },

];
// set to play a song and nex, prev button
let isPlaying = true;
let indexSong = 0;
function changeSong(dir) {
    if (dir === 1) {
        indexSong++;
        if (indexSong >= musics.length) {
            indexSong = 0;
        }
        isPlaying = true;
    }
    else if (dir === -1) {
        indexSong--;
        if (indexSong < 0) {
            indexSong = musics.length - 1;
        }
        isPlaying = true;
    }
    init(indexSong);
    playPause();
}
nextBtn.addEventListener('click', function () {
    changeSong(1)
});
prevBtn.addEventListener("click", function () {
    changeSong(-1);
});

playBtn.addEventListener("click", playPause);
function playPause() {
    if (isPlaying) {
        song.play();
        playBtn.setAttribute('src', 'assets/icons/pause.svg')
        isPlaying = false;
        timer = setInterval(displayTimer, 500);

    } else {
        song.pause();
        playBtn.setAttribute('src', 'assets/icons/continue.svg')
        isPlaying = true;
        clearInterval(timer);
    }
}

// Set and change Time from second to Minute and time play music
let timer;
function displayTimer() {
    const { duration, currentTime } = song;
    rangeBar.max = duration;
    rangeBar.value = currentTime;
    playTime.textContent = formatTimer(currentTime);
    if (!duration) {
        durationTime.textContent = "00:00";
    } else {
        durationTime.textContent = formatTimer(duration);
    }
}
function formatTimer(number) {
    const minutes = Math.floor(number / 60);
    const seconds = Math.floor(number - minutes * 60);
    return `${minutes < 10 ? "0" + minutes : minutes}:${seconds < 10 ? "0" + seconds : seconds
        }`;
}
rangeBar.addEventListener("change", handleChangeBar);
function handleChangeBar() {
    song.currentTime = rangeBar.value;
}
displayTimer();


// set to repeat a song
let isRepeat = false;
playRepeat.addEventListener("click", function () {
    if (isRepeat) {
        isRepeat = false;
        playRepeat.setAttribute('src', 'assets/icons/repeat-off.svg')
    } else {
        playRepeat.setAttribute('src', 'assets/icons/repeat-on.svg')
        isRepeat = true;
    }
});

song.addEventListener("ended", handleEndedSong);
function handleEndedSong() {
    if (isRepeat) {
        isPlaying = true;
        playPause();
    }
    else {
        changeSong(1)
    }
}

let isRandom = false;
playRandom.addEventListener("click", function () {
    if (isRandom) {
        isRandom = false;
        playRandom.setAttribute('src', 'assets/icons/random-off.svg')
    } else {
        playRandom.setAttribute('src', 'assets/icons/random-on.svg')
        isRandom = true;
    }
});

song.addEventListener("ended", handleEndedSong);
function handleEndedSong() {
    if (isRandom) {
        changeSong(-1);
        isPlaying = true;
        playPause();
    }
    else {
        changeSong(1);
    }
}

//set to change name , singer, avt music
function init(indexSong) {
    song.setAttribute('src', `./assets/upload/musics/${musics[indexSong].file}`);
    musicName.textContent = musics[indexSong].name;
    singerName.textContent = musics[indexSong].singer;
    musicImage.setAttribute("src", musics[indexSong].image);
}
init(indexSong);


let vol = document.querySelector("#volume-control");
vol.addEventListener("input", function () {
    song.volume = vol.value / 100;
});


