const board = ['', '', '', '', '', '', '', '', ''];
let currentPlayer = 'X';
let gameMode = ''; // 'player', 'bot'
let botDifficulty = ''; // 'easy', 'medium', 'hard'
let gameActive = true;
const winningConditions = [
    [0, 1, 2],
    [3, 4, 5],
    [6, 7, 8],
    [0, 3, 6],
    [1, 4, 7],
    [2, 5, 8],
    [0, 4, 8],
    [2, 4, 6]
];

const statusDisplay = document.getElementById('game-status');
const cells = document.querySelectorAll('.cell');
const difficultyButtons = document.getElementById('difficulty-buttons');

// Load sound effects
const winSound = new Audio('../sounds/winner.wav');
const placeXSound = new Audio('../sounds/xTone.mp3');
const placeOSound = new Audio('../sounds/OTone.mp3');

// Start Game based on the mode and difficulty
function startGame(mode, difficulty = '') {
    gameMode = mode;
    botDifficulty = difficulty;
    difficultyButtons.style.display = 'none';
    resetBoard();
    statusDisplay.textContent = `${currentPlayer}'s Turn`;
    cells.forEach(cell => cell.addEventListener('click', handleCellClick));
}
function showDifficulty() {
    difficultyButtons.style.display = 'flex';
}

// Reset the board
function resetBoard() {
    board.fill('');
    currentPlayer = 'X'; // Always start with 'X'
    gameActive = true;
    statusDisplay.textContent = `${currentPlayer}'s Turn`;
    cells.forEach(cell => {
        cell.textContent = '';
        cell.style.pointerEvents = 'auto';
    });
}

// Handle cell click
function handleCellClick(event) {
    const clickedCell = event.target;
    const clickedIndex = clickedCell.getAttribute('data-index');

    if (board[clickedIndex] !== '' || !gameActive) return; // Prevent clicking on filled or inactive cells

    board[clickedIndex] = currentPlayer;
    clickedCell.textContent = currentPlayer;

    // Play sound for placing X or O
    if (currentPlayer === 'X') {
        placeXSound.play();
    } else {
        placeOSound.play();
    }

    checkResult(); // Check result after player move

    if (gameMode === 'bot' && gameActive) {
        // Only make the bot move if the game is still active
        setTimeout(botMove, 500); // Bot plays after a short delay
    } else if (gameActive) {
        changePlayer(); // Switch to the next player only if it's a 2-player game
    }
}

// Change the player
function changePlayer() {
    currentPlayer = currentPlayer === 'X' ? 'O' : 'X';
    statusDisplay.textContent = `${currentPlayer}'s Turn`;
}

// Bot Move based on difficulty
function botMove() {
    let bestMove;
    if (botDifficulty === 'easy') {
        bestMove = easyBotMove();
    } else if (botDifficulty === 'medium') {
        bestMove = mediumBotMove();
    } else if (botDifficulty === 'hard') {
        bestMove = minimax(board, 'O').index;
    }
    
    if (bestMove !== undefined) {
        board[bestMove] = 'O';
        document.querySelector(`[data-index="${bestMove}"]`).textContent = 'O';
        placeOSound.play(); // Play sound for bot move
        checkResult(); // Check result after the bot's move

        if (gameActive) {
            currentPlayer = 'X'; // Switch back to the player after the bot move
            statusDisplay.textContent = `${currentPlayer}'s Turn`;
        }
    }
}

// Easy Bot Move (Random AI)
function easyBotMove() {
    let availableCells = board.map((val, idx) => (val === '' ? idx : null)).filter(val => val !== null);
    return availableCells[Math.floor(Math.random() * availableCells.length)];
}

// Medium Bot Move (Random AI with some strategic moves)
function mediumBotMove() {
    let availableCells = board.map((val, idx) => (val === '' ? idx : null)).filter(val => val !== null);
    let winningMove = findWinningMove('O');
    let blockingMove = findWinningMove('X');
    
    if (winningMove !== undefined) return winningMove;
    if (blockingMove !== undefined) return blockingMove;

    // If no immediate win or block, pick randomly
    return availableCells[Math.floor(Math.random() * availableCells.length)];
}

// Find a winning move for a given player
function findWinningMove(player) {
    return winningConditions
        .map(([a, b, c]) => {
            if (board[a] === player && board[b] === player && board[c] === '') return c;
            if (board[a] === player && board[c] === player && board[b] === '') return b;
            if (board[b] === player && board[c] === player && board[a] === '') return a;
            return undefined;
        })
        .find(move => move !== undefined);
}

// Minimax Algorithm
function minimax(board, player) {
    const availableCells = board.map((val, idx) => (val === '' ? idx : null)).filter(val => val !== null);

    if (checkWin(board, 'X')) return { score: -10 };
    if (checkWin(board, 'O')) return { score: 10 };
    if (availableCells.length === 0) return { score: 0 };

    let bestMove;
    let bestScore = player === 'O' ? -Infinity : Infinity;

    for (const cell of availableCells) {
        board[cell] = player;
        const score = minimax(board, player === 'O' ? 'X' : 'O').score;
        board[cell] = ''; // Undo the move

        if (player === 'O') {
            if (score > bestScore) {
                bestScore = score;
                bestMove = cell;
            }
        } else {
            if (score < bestScore) {
                bestScore = score;
                bestMove = cell;
            }
        }
    }

    return { score: bestScore, index: bestMove };
}

// Check for a win
function checkWin(board, player) {
    return winningConditions.some(([a, b, c]) => board[a] === player && board[a] === board[b] && board[a] === board[c]);
}

// Check for win or draw
function checkResult() {
    if (checkWin(board, 'X')) {
        statusDisplay.textContent = 'X Wins!';
        winSound.play(); // Play win sound
        gameActive = false;
        return;
    }
    if (checkWin(board, 'O')) {
        statusDisplay.textContent = 'O Wins!';
        winSound.play(); // Play win sound
        gameActive = false;
        return;
    }
    if (!board.includes('')) { // All cells filled, game is a draw
        statusDisplay.textContent = 'Draw!';
        gameActive = false;
        return;
    }
}

// Restart the game
function restartGame() {
    resetBoard();
}
