
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
        name: "Anh Nho Ra",
        singer: "Vũ.",
        file: "Anh Nhớ Ra.mp3",
        image:
            "Anh_nho_ra.jpg"
    },
    {
        id: 2,
        name: "Bao Tien Mo Binh Yen",
        singer: "14Cosper ft Bon",
        file: "Bao Tiền.mp3",
        image:
            "baotien.jpg",
    },
    {
        id: 3,
        name: "Có em",
        singer: "Madihu ft LowG",
        file: "Có Em.mp3",
        image:
            "co_em.jpg"
    },
    {
        id: 4,
        name: "Thang Dien",
        singer: "Justasuy ft AndreeLeftHand",
        file: "Thang Dien.mp3",
        image:
            "thangdien.jpg"
    },
    {
        id: 5,
        name: "Thich Em Hoi Nhieu",
        singer: "Wren Evan",
        file: "Thích Em Hơi Nhiều.mp3",
        image:
            "thichem.jpg"
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
    musicImage.setAttribute("src", `./assets/upload/avt-music/${musics[indexSong].image}`);
}
init(indexSong);


let vol = document.querySelector("#volume-control");
vol.addEventListener("input", function () {
    song.volume = vol.value / 100;
});


