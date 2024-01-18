
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
        name: "Anh Nhớ Ra",
        Artis: "Vũ",
        url: "assets/library/musics-library/Anh Nhớ Ra.mp3",
        avatar_music_url: "assets/library/avt-music-library/anh_nho_ra.jpg"
    },
    {
        id: 2,
        name: "Bao Tiền",
        Artis: "14Cosper ft Bon",
        url: "assets/library/musics-library/Bao Tiền.mp3",
        avatar_music_url: "assets/library/avt-music-library/bao_tien_mot_mo_binh_yen.jpg"
    },
    {
        id: 3,
        name: "Có Em",
        Artis: "Madihu ft LowG",
        url: "assets/library/musics-library/Có Em.mp3",
        avatar_music_url: "assets/library/avt-music-library/co_em.jpg"
    },
    {
        id: 4,
        name: "Thang Dien",
        Artis: "Justatee ft Andree",
        url: "assets/library/musics-library/Thang Dien.mp3",
        avatar_music_url: "assets/library/avt-music-library/thang_dien.jpg"
    },
    {
        id: 5,
        name: "Thích Em Hơi Nhiều",
        Artis: "Wren Evan",
        url: "assets/library/musics-library/Thích Em Hơi Nhiều.mp3",
        avatar_music_url: "assets/library/avt-music-library/thich_em_hoi_nhieu.jpg"
    },
    {
        id: 6,
        name: "See You Again",
        Artis: "Chalie Puth",
        url: "assets/library/musics-library/See You Again.mp3",
        avatar_music_url: "assets/library/avt-music-library/see_you_again.jpg"
    },
    {
        id: 7,
        name: "Something Just Like This",
        Artis: "Coldplay",
        url: "assets/library/musics-library/Something Just Like This.mp3",
        avatar_music_url: "assets/library/avt-music-library/something_just_like_this.jpg"
    },
    {
        id: 8,
        name: "Sugar",
        Artis: "Marron 5",
        url: "assets/library/musics-library/Sugar.mp3",
        avatar_music_url: "assets/library/avt-music-library/sugar.jpg"
    },
    {
        id: 9,
        name: "What You Came For",
        Artis: "Rihanna",
        url: "assets/library/musics-library/This Is What You Came For.mp3",
        avatar_music_url: "assets/library/avt-music-library/this_is_what_you_came_for.jpg"
    },
    {
        id: 10,
        name: "What Do You Mean",
        Artis: "Justin Bieber",
        url: "assets/library/musics-library/What Do You Mean.mp3",
        avatar_music_url: "assets/library/avt-music-library/what_do_you_mean.jpg"
    }
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
        changeSong(-1);
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
    song.setAttribute('src', `${musics[indexSong].url}`);
    musicName.textContent = musics[indexSong].name;
    singerName.textContent = musics[indexSong].Artis;
    musicImage.setAttribute("src", `${musics[indexSong].avatar_music_url}`);
}
init(indexSong);


let vol = document.querySelector("#volume-control");
vol.addEventListener("input", function () {
    song.volume = vol.value / 100;
});




