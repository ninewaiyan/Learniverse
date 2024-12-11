const boardSize = 30;
const squareSize = 15;
const board = document.getElementById('snake-board');
const snakeSound = new Audio('../sounds/move.mp3');
const fruitSound = new Audio('../sounds/eat.mp3');
const boneSound = new Audio('../sounds/hit.wav');
const hitSound = new Audio('../sounds/gameover.wav');  
const bgMusic = document.getElementById('.bg-music');
// bgMusic.volume = 0.5; 

let snake = [];
let direction = 'RIGHT';
let fruit = {};
let bone = {};
let hearts = 3;
let score = 0;
let time = 0;
let gameInterval, timeInterval;

document.getElementById('hearts').innerHTML = '❤❤❤';

function initializeBoard() {
    board.style.width = `${boardSize * squareSize}px`;
    board.style.height = `${boardSize * squareSize}px`;
    board.classList.add('border', 'border-warning', 'rounded');
    board.innerHTML = '';
}

function updateHearts() {
    const heartElem = document.getElementById('hearts');
    heartElem.innerHTML = '❤'.repeat(hearts);
}

function createFruit() {
    const x = Math.floor(Math.random() * boardSize);
    const y = Math.floor(Math.random() * boardSize);
    fruit = { x, y };
    updateFruitPosition();
}

function createBone() {
    const x = Math.floor(Math.random() * boardSize);
    const y = Math.floor(Math.random() * boardSize);
    bone = { x, y };
    updateBonePosition();
}

function updateFruitPosition() {
    const fruitElem = document.querySelector('.fruit');
    if (fruitElem) fruitElem.remove();
    
    const fruitDiv = document.createElement('div');
    fruitDiv.classList.add('fruit');
    fruitDiv.style.top = `${fruit.y * squareSize}px`;
    fruitDiv.style.left = `${fruit.x * squareSize}px`;
    board.appendChild(fruitDiv);
}

function updateBonePosition() {
    const boneElem = document.querySelector('.bone');
    if (boneElem) boneElem.remove();
    
    const boneDiv = document.createElement('div');
    boneDiv.classList.add('bone');
    boneDiv.style.top = `${bone.y * squareSize}px`;
    boneDiv.style.left = `${bone.x * squareSize}px`;
    board.appendChild(boneDiv);
}

function drawSnake() {
    board.innerHTML = '';
    snake.forEach(segment => {
        const snakeDiv = document.createElement('div');
        snakeDiv.classList.add('snake');
        snakeDiv.style.top = `${segment.y * squareSize}px`;
        snakeDiv.style.left = `${segment.x * squareSize}px`;
        board.appendChild(snakeDiv);
    });
    updateFruitPosition();
    updateBonePosition();
}

function moveSnake() {
    let head = { ...snake[0] };
    if (direction === 'UP') head.y--;
    if (direction === 'DOWN') head.y++;
    if (direction === 'LEFT') head.x--;
    if (direction === 'RIGHT') head.x++;

    // Check if the snake hits the border
    if (head.x < 0 || head.x >= boardSize || head.y < 0 || head.y >= boardSize) {
        hitSound.play();  
        snakeSound.pause();
        return gameOver();
    }

    // Check if the snake eats itself
    if (snake.some(segment => segment.x === head.x && segment.y === head.y)) {
        hitSound.play(); 
        snakeSound.pause();
        return gameOver();
    }

    snake.unshift(head);

    // Check if the snake eats the fruit
    if (head.x === fruit.x && head.y === fruit.y) {
        createFruit();
        score += 10;
        fruitSound.play();
    } 
    // Check if the snake eats the bone (lose heart)
    else if (head.x === bone.x && head.y === bone.y) {
        createBone();
        hearts--;
        updateHearts();
        boneSound.play();
        if (hearts === 0) return gameOver();
    } else {
        snake.pop();
    }

    drawSnake();
    snakeSound.play();
    document.getElementById('score').innerText = score;
}

function gameOver() {
    clearInterval(gameInterval);
    clearInterval(timeInterval);
    document.getElementById('game-over').style.display = 'block';
    // bgMusic.pause();
    snakeSound.pause();

    // Display final score
    const finalScore = document.getElementById("score").innerText;
    
    // Optionally, save the score to the server if `userId` is available
    if (userId) {
        saveScore(userId, finalScore);
    }
}

function saveScore(userId, score) {
    fetch('../games/snake.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            quizz_name: 'Snake Game',
            achievement: 'Reached Score ' + score,
            score: score,
            user_id: userId
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            console.log('Score saved successfully!');
        } else {
            console.log('Failed to save score.');
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

function startSnakeGame() {
    snake = [{ x: 5, y: 5 }];
    direction = 'RIGHT';
    hearts = 3;
    score = 0;
    time = 0;
    document.getElementById('time').innerText = time;
    document.getElementById('score').innerText = score;
    updateHearts();
    createFruit();
    createBone();
    document.getElementById('game-over').style.display = 'none';
    gameInterval = setInterval(moveSnake, 300);
    timeInterval = setInterval(() => {
        time++;
        document.getElementById('time').innerText = time;
    }, 1000);
    
    document.addEventListener('keydown', (event) => {
        if (event.key === 'ArrowUp' && direction !== 'DOWN') direction = 'UP';
        if (event.key === 'ArrowDown' && direction !== 'UP') direction = 'DOWN';
        if (event.key === 'ArrowLeft' && direction !== 'RIGHT') direction = 'LEFT';
        if (event.key === 'ArrowRight' && direction !== 'LEFT') direction = 'RIGHT';
    });

    document.addEventListener('keydown', (event) => {
        if (event.key === 'w' || event.key === 'W') {
            if (direction !== 'DOWN') direction = 'UP';
        }
        if (event.key === 's' || event.key === 'S') {
            if (direction !== 'UP') direction = 'DOWN';
        }
        if (event.key === 'a' || event.key === 'A') {
            if (direction !== 'RIGHT') direction = 'LEFT';
        }
        if (event.key === 'd' || event.key === 'D') {
            if (direction !== 'LEFT') direction = 'RIGHT';
        }
    });
    
}

initializeBoard();
