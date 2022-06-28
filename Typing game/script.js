const word = document.getElementById("word");
const text = document.getElementById("text");
const scoreEl = document.getElementById("score");
const timeEl = document.getElementById("time");
const endgameEl = document.getElementById("end-game-container");
const settingsBtn = document.getElementById("settings-btn");
const settings = document.getElementById("settings");
const settingsForm = document.getElementById("settings-form");
const difficultySelect = document.getElementById("difficulty");

const words = [
  "karim",
  "benzema",
  "steven",
  "gerrard",
  "real",
  "madrid",
  "liverpool",
  "champions",
  "league",
  "ballon",
  "d'or",
];

let randomWord;

let score = 0;

let time = 10;

let difficulty =
  localStorage.getItem("difficulty") !== null
    ? localStorage.getItem("difficulty")
    : "easy";

difficultySelect.value = difficulty;

const timeInterval = setInterval(updateTime, 1000);

function getRandomWord() {
  return words[Math.floor(Math.random() * words.length)];
}

function addWordToDOM() {
  randomWord = getRandomWord();
  word.innerHTML = randomWord;
}

function updateScore() {
  score++;
  scoreEl.innerHTML = score;
}

function updateTime() {
  time--;
  timeEl.innerHTML = time + "s";

  if (time === 0) {
    clearInterval(timeInterval);

    gameOver();
  }
}

function gameOver() {
  endgameEl.innerHTML = `
    <h1>Time's up!⌚</h1>
    <p>Your final score is ${score}</p>
    <button onclick="location.reload()">Play again</button>
    `;

  endgameEl.style.display = "flex";
}

addWordToDOM();

text.addEventListener("input", (e) => {
  const insertedText = e.target.value;

  if (insertedText === randomWord) {
    addWordToDOM();

    updateScore();

    e.target.value = "";

    if (difficulty === "easy") {
      time += 5;
    } else if (difficulty === "medium") {
      time += 3;
    } else {
      time += 1;
    }

    updateTime();
  }
});

settingsBtn.addEventListener("click", () => settings.classList.toggle("hide"));

settingsForm.addEventListener("change", (e) => {
  difficulty = e.target.value;
  localStorage.setItem("difficulty", difficulty);
});
