const cardsArray = [
    { name: 'apple', img: '../images/memory/apple.png' },
    { name: 'banana', img: '../images/memory/banana.png' },
    { name: 'cherry', img: '../images/memory/cherry.png' },
    { name: 'grape', img: '../images/memory/grape.png' },
    { name: 'lemon', img: '../images/memory/lemon.png' },
    { name: 'watermelon', img: '../images/memory/watermelon.png' },
    { name: 'bicycle', img: '../images/memory/bicycle.png' },
    { name: 'car', img: '../images/memory/car.png' },
    { name: 'motorcycle', img: '../images/memory/motorcycle.png' },
    { name: 'plane', img: '../images/memory/plane.png' },
    { name: 'helicopter', img: '../images/memory/helicopter.png' },
    { name: 'ship', img: '../images/memory/ship.png' },
];

const MAX_LEVELS = 10;

let gameBoard = document.getElementById('gameBoard');
let timerElement = document.getElementById('timer');
let levelElement = document.getElementById('level');
let nextLevelButton = document.getElementById('nextLevel');
let startGameButton = document.getElementById('startGameButton');

let firstCard = null;
let lockBoard = false;
let level = 1;
let timer;
let timeElapsed = 0;

// Start the timer
function startTimer() {
    console.log("Timer started");
    timer = setInterval(() => {
        timeElapsed++;
        console.log("Time Elapsed: ", timeElapsed); 
        timerElement.textContent = timeElapsed;
    }, 1000);
}


// Reset the timer
function resetTimer() {
    clearInterval(timer);
    timeElapsed = 0;
    timerElement.textContent = timeElapsed;
}

// Initialize game with shuffled cards
function initGame() {
    resetTimer();
    startTimer();
    gameBoard.innerHTML = '';
    lockBoard = false;
    firstCard = null;

    let levelCards = cardsArray.slice(0, level + 2);
    let cards = [...levelCards, ...levelCards];
    cards.sort(() => 0.5 - Math.random());

    cards.forEach((card) => {
        const cardElement = document.createElement('div');
        cardElement.classList.add('card');
        cardElement.dataset.name = card.name;

        const imgElement = document.createElement('img');
        imgElement.src = card.img;
        cardElement.appendChild(imgElement);

        cardElement.addEventListener('click', flipCard);
        gameBoard.appendChild(cardElement);
    });

    adjustGridSize();
    // nextLevelButton.disabled = true;
}

// Adjust the grid size based on the number of cards
function adjustGridSize() {
    let columns = Math.ceil(Math.sqrt(gameBoard.children.length));
    gameBoard.style.gridTemplateColumns = `repeat(${columns}, 100px)`;
}

// Flip card function
function flipCard() {
    if (lockBoard) return;
    if (this === firstCard) return;

    playSound('flip');
    this.classList.add('flip');

    if (!firstCard) {
        firstCard = this;
        return;
    }

    checkMatch(this, firstCard);
    firstCard = null;
}

// Check if two cards match
function checkMatch(card1, card2) {
    if (card1.dataset.name === card2.dataset.name) {
        playSound('match');
        card1.removeEventListener('click', flipCard);
        card2.removeEventListener('click', flipCard);

        if (checkWin()) {
            playSound('lvlComplete');
            clearInterval(timer);
            showCongratulations();
            // nextLevelButton.disabled = false;
        }
    } else {
        lockBoard = true;
        setTimeout(() => {
            card1.classList.remove('flip');
            card2.classList.remove('flip');
            lockBoard = false;
        }, 1000);
    }
}

// Check if all cards are matched
function checkWin() {
    return [...gameBoard.children].every((card) =>
        card.classList.contains('flip')
    );
}

function playSound(type) {
    const sound = document.getElementById(type + 'Sound');
    sound.currentTime = 0;
    sound.play();
}

// // Move to the next level
// nextLevelButton.addEventListener('click', () => {
//     if (level < MAX_LEVELS) {
//         level++;
//         levelElement.textContent = level;
//         nextLevelButton.disabled = true; 
//         initGame();
//     } else {
//         alert("Congratulations! You've completed all levels!");
//         resetGame();
//     }
// });

// Reset game function
function resetGame() {
    level = 1;
    levelElement.textContent = level;
    nextLevelButton.disabled = true; 
    initGame();
}

// Start game button click event
startGameButton.addEventListener('click', () => {
    console.log("Start button clicked");
    startTimer();
    initGame();  
   
});

// Start the game when the page loads
window.onload = () => {
    timerElement.textContent = '0';
    levelElement.textContent = '1'; 
    hideCongratulations();
};

//sound start
document.addEventListener('DOMContentLoaded', () => {
    const bgSound = document.getElementById('bgSound');
    const toggleButton = document.getElementById('toggleSound');
    
    bgSound.volume = 1.0;
    //bgSound.play();
    bgSound.muted = false;

    let isPlaying = true;

    toggleButton.addEventListener('click', () => {
        if (isPlaying) {
            bgSound.pause();
            toggleButton.textContent = '🔇';
        } else {
            bgSound.play().catch(error => console.error('Playback failed:', error));
            toggleButton.textContent = '🔊';
        }
        isPlaying = !isPlaying;
    });

    window.addEventListener('click', () => {
        if (!isPlaying) {
            bgSound.play().catch(error => console.error('Initial play failed:', error));
            isPlaying = true;
            toggleButton.textContent = '🔊';
        }
    }, { once: true });
});

// Show the congratulations message
function showCongratulations() {
    const congratulationsDiv = document.getElementById('congratulations');
    const completedLevel = document.getElementById('completedLevel');
    completedLevel.textContent = level; // Show the completed level
    congratulationsDiv.style.display = 'flex'; // Show the overlay

    // Add event listener for the next level button
    document.getElementById('nextLevelButton').onclick = () => {
        level++;
        if (level > MAX_LEVELS) {
            alert("Congratulations! You've completed all levels!");
            return; // Optionally, you can reset the game or display a final message
        }
        levelElement.textContent = level; // Update the displayed level
        hideCongratulations(); // Hide the congratulatory message
        initGame(); // Restart the game for the next level
    };
}

// Hide the congratulations message
function hideCongratulations() {
    const congratulationsDiv = document.getElementById('congratulations');
    congratulationsDiv.style.display = 'none'; // Hide the overlay
}


