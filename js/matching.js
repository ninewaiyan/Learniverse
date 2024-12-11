// const letterSound = new Audio('../sounds/move.mp3')
// const imageSound = new Audio("../sounds/hit.wav");
// const finishSound = new Audio("../sounds/gameover.wav");

// let challenges = [
//     { pairs: { Ant: "ant.jpg", Bus: "bus.jpg", Cat: "cat.jpg", Dog: "dog.jpg", Elephant: "elephant.jpg", Fish: "fish.jpg", } },
//     { pairs: { Goat: "goat.jpg", Hat: "hat.jpg", Ice: "ice.jpg", Jacket: "jacket.jpg", Kite: "kite.jpg", Leaf: "leaf.jpg" } }
// ];

// let currentChallenge = 0;
// let selectedLetter = null;
// let score = 0;
// let matches = 0;

// function shuffleArray(array) {
//     const shuffled = array.slice();
//     for (let i = shuffled.length - 1; i > 0; i--) {
//         const j = Math.floor(Math.random() * (i + 1));
//         [shuffled[i], shuffled[j]] = [shuffled[j], shuffled[i]];
//     }
//     return shuffled;
// }

// function loadChallenge(index) {
//     const challenge = challenges[index];
//     const lettersContainer = document.getElementById('letters');
//     const photosContainer = document.getElementById('photos');


//     lettersContainer.innerHTML = '';
//     photosContainer.innerHTML = '';
//     score = 0;
//     matches = 0;
//     selectedLetter = null;

//     const letters = Object.keys(challenge.pairs);
//     const photos = Object.entries(challenge.pairs);

//     const shuffledLetters = shuffleArray(letters);
//     const shuffledPhotos = shuffleArray(photos);

//     shuffledLetters.forEach((letter) => {
//         const card = document.createElement('div');
//         card.className = 'col';
//         card.innerHTML = `
//             <div class="card text-center">
//                 <div class="card-body">
//                     <h5 class="card-title">${letter}</h5>
//                 </div>
//             </div>`;
//         card.onclick = () => selectLetter(card, letter);
//         lettersContainer.appendChild(card);
//     });

//     shuffledPhotos.forEach(([letter, photo]) => {
//         const card = document.createElement('div');
//         card.className = 'col';
//         card.innerHTML = `
//             <div class="card">
//                 <img src="../images/matching/${photo}" class="card-img-top img-fluid" alt="${letter}" style="max-width: 100%; height: auto;"/>
//             </div>`;
//         card.dataset.letter = letter;
//         card.onclick = () => matchPhoto(card, letter);
//         photosContainer.appendChild(card);
//     });

//     document.getElementById('nextChallenge').disabled = true;
//     document.getElementById('scoreDisplay').textContent = '';
// }

// function selectLetter(card, letter) {
//     selectedLetter = letter;

//     // Remove styles from all letter cards
//     document.querySelectorAll('#letters .card').forEach(item => {
//         item.classList.remove('bg-secondary', 'text-muted'); // Remove selected styles
//         item.classList.add('border-white'); // Reset to selected styles
//         letterSound.play();
//     });

//     // Apply styles to the selected letter card
//     card.querySelector('.card').classList.add('bg-primary', 'text-white'); // Apply secondary styles
//     card.querySelector('.card').classList.remove('bg-secondary', 'text-muted'); // Remove default selected styles
    
//     card.onclick = null;
// }


// function matchPhoto(card, letter) {
//     if (!selectedLetter) {
//         alert('Select a letter first!');
//         return;
//     }

//     document.querySelectorAll('#letters .card').forEach(item => item.onclick = null);

//     if (letter === selectedLetter) {
//         card.querySelector('.card').classList.add('border-success');
//         score += 10;
//         imageSound.play();

//     } else {
//         card.querySelector('.card').classList.add('border-danger');
//         // alert(`Wrong match! You selected ${letter} for ${selectedLetter}.`);
//         imageSound.play();
//     }

//     // Disable further clicks on the matched photo
//     card.onclick = null;
//     // Increase matched pairs
//     matches++;
//     // Reset the selected letter for the next round
//     selectedLetter = null;

//     // Check if all matches are found
//     // const totalPairs = Object.keys(challenges[currentChallenge].pairs).length;

//     // // Check if all pairs matched to allow moving to next challenge
//     // if (matches === totalPairs) {
//     //     // Provide feedback or any additional logic if needed
//     //     alert('All matches found! Proceeding to next challenge.'); 
//     //     finishChallenge();
//     // }
//     if (matches === 6) {
//         finishChallenge();
//         finishSound.play();
//     }
// }

// function finishChallenge() {
//     let badge = '';
//     let note = '';
//     let note1 = '';
//     if (score >= 60) {
//         badge = '👑 Crown';
//         document.getElementById('nextChallenge').disabled = false;
//         note = 'go to the next challenge.';
//     } else if (score >= 40) {
//         badge = '🥇 Gold';
//         document.getElementById('nextChallenge').disabled = false;
//         note = 'go to the next challenge.';
//     } else if (score >= 20) {
//         badge = '🥈 Silver';
//         note1 = 'You must score at least 40 marks to go to the next challenge.';
//     } else {
//         badge = 'Keep Trying!';
//         note1 = 'You must score at least 40 marks to go to the next challenge.';
//     }

//     document.getElementById('scoreDisplay').innerHTML = `<h4>Score: ${score} - ${badge}</h4>`;
//     if (note) {
//         document.getElementById('scoreDisplay').innerHTML += `<small class="text-success">${note}</small>`;
//     }
//     if (note1) {
//         document.getElementById('scoreDisplay').innerHTML += `<small class="text-danger">*${note1}</small>`;
//     }

//     // Enable the Next Challenge button if there are more challenges
//     // document.getElementById('nextChallenge').disabled = currentChallenge >= challenges.length - 1;
// }

// document.getElementById('nextChallenge').onclick = () => {
//     if (currentChallenge < challenges.length - 1) {
//         currentChallenge++;
//         loadChallenge(currentChallenge);
//         document.getElementById('prevChallenge').disabled = false;
//     }
//     if (currentChallenge === challenges.length - 1) {
//         document.getElementById('nextChallenge').disabled = true;
//     }
// };

// document.getElementById('prevChallenge').onclick = () => {
//     if (currentChallenge > 0) {
//         currentChallenge--;
//         loadChallenge(currentChallenge);
//         document.getElementById('nextChallenge').disabled = false;
//     }
//     if (currentChallenge === 0) {
//         document.getElementById('prevChallenge').disabled = true;
//     }
// };

// document.getElementById('retryButton').onclick = () => {
//     loadChallenge(currentChallenge);
// };

// loadChallenge(currentChallenge);

// //sound start
// document.addEventListener('DOMContentLoaded', () => {
//     const bgSound = document.getElementById('bgSound');
//     const toggleButton = document.getElementById('toggleSound');
    
//     bgSound.volume = 1.0;
//     //bgSound.play();
//     bgSound.muted = false;

//     let isPlaying = true;

//     toggleButton.addEventListener('click', () => {
//         if (isPlaying) {
//             bgSound.pause();
//             toggleButton.textContent = '🔇';
//         } else {
//             bgSound.play().catch(error => console.error('Playback failed:', error));
//             toggleButton.textContent = '🔊';
//         }
//         isPlaying = !isPlaying;
//     });

//     window.addEventListener('click', () => {
//         if (!isPlaying) {
//             bgSound.play().catch(error => console.error('Initial play failed:', error));
//             isPlaying = true;
//             toggleButton.textContent = '🔊';
//         }
//     }, { once: true });
// });

const selectSound = new Audio('../sounds/select.mp3')
const wrongSound = new Audio("../sounds/wrongselect.mp3");
const finishSound = new Audio("../sounds/finish.mp3");
const failSound = new Audio("../sounds/fail.mp3");
let currentChallenge = 0; // Track the current challenge index
let score = 0;
let matches = 0;
let selectedLetter = null;

// Sample challenges (replace with your data)
const challenges = [
    { pairs: { Ant: "ant.jpg", Bus: "bus.jpg", Cat: "cat.jpg", Dog: "dog.jpg", Elephant: "elephant.jpg", Fish: "fish.jpg", } },
    { pairs: { Goat: "goat.jpg", Hat: "hat.jpg", Ice: "ice.jpg", Jacket: "jacket.jpg", Kite: "kite.jpg", Leaf: "leaf.jpg" } }
];

// Initialize the first challenge on page load
window.onload = function () {
    loadChallenge(currentChallenge);
};

// Load a specific challenge
function loadChallenge(index) {
    const challenge = challenges[index];
    const lettersContainer = document.getElementById('letters');
    const photosContainer = document.getElementById('photos');

    lettersContainer.innerHTML = '';
    photosContainer.innerHTML = '';
    score = 0;
    matches = 0;
    selectedLetter = null;

    // Shuffle and display letters
    const letters = Object.keys(challenge.pairs);
    shuffleArray(letters).forEach(letter => {
        const card = document.createElement('div');
        card.className = 'col';
        card.innerHTML = `
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">${letter}</h5>
                </div>
            </div>`;
        card.onclick = () => selectLetter(card, letter);
        lettersContainer.appendChild(card);
    });

    // Shuffle and display photos
    const photos = Object.entries(challenge.pairs);
    shuffleArray(photos).forEach(([letter, photo]) => {
        const card = document.createElement('div');
        card.className = 'col';
        card.innerHTML = `
            <div class="card">
                <img src="../images/matching/${photo}" class="card-img-top img-fluid" alt="${letter}" />
            </div>`;
        card.dataset.letter = letter;
        card.onclick = () => matchPhoto(card, letter);
        photosContainer.appendChild(card);
    });

    // updateScoreDisplay();
}

// Shuffle array function
function shuffleArray(array) {
    for (let i = array.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [array[i], array[j]] = [array[j], array[i]];
    }
    return array;
}

// Handle letter selection
function selectLetter(card, letter) {
    selectedLetter = letter;
    Array.from(document.getElementsByClassName('selected')).forEach(el => el.classList.remove('selected'));
    card.classList.add('selected');
    selectSound.play();
}

// Handle photo selection and matching logic
function matchPhoto(card, letter) {
    if (!selectedLetter) return;

    const letterCard = Array.from(document.getElementsByClassName('card-title'))
        .find(el => el.textContent.trim() === letter);

    if (letterCard) {
        if (letter === selectedLetter) {
            // Add 'matched' styles to both letter and photo cards
            card.classList.add('matched');
            letterCard.parentElement.parentElement.classList.add('matched');
            
            matches++;
            score += 10;

            // Add success animation
            card.classList.add('animate-match');
            letterCard.parentElement.parentElement.classList.add('animate-match');
            selectSound.play();
        } else {
            score -= 10;
            wrongSound.play();
            // Add 'mismatch' animation
            card.classList.add('animate-mismatch');
            letterCard.parentElement.parentElement.classList.add('animate-mismatch');

            // Remove the animation after 1 second
            setTimeout(() => {
                card.classList.remove('animate-mismatch');
                letterCard.parentElement.parentElement.classList.remove('animate-mismatch');
            }, 1000);
        }
    }
    selectedLetter = null;
    updateScoreDisplay();
    checkCompletion();
}



// Update score display
function updateScoreDisplay() {
    //document.getElementById('scoreDisplay').textContent = `Score: ${score}`;
    document.getElementById('scoreDisplayOverlay').textContent = `Score: ${score}`;
}

// Check if the challenge is completed
function checkCompletion() {
    const requiredScore = 40; // Minimum score required to progress to the next challenge

    if (matches === Object.keys(challenges[currentChallenge].pairs).length) {
        document.getElementById('overlayMessage').textContent = 'Challenge Completed!';
        
        if (score >= requiredScore) {
            document.getElementById('nextOverlayButton').disabled = currentChallenge >= challenges.length - 1;
            document.getElementById('overlayMessage').textContent += ' You can proceed to the next challenge!';
            finishSound.play();
        } else {
            document.getElementById('nextOverlayButton').disabled = true;
            document.getElementById('overlayMessage').textContent += ' Try to reach at least 40 points to unlock the next challenge!';
            failSound.play();
        }
        
        document.getElementById('messageOverlay').style.display = 'block';
        
    }
}

// Retry button inside the overlay reloads the current challenge
document.getElementById('retryOverlayButton').onclick = function () {
    resetGame();
};

// Reload button outside reshuffles the same challenge
document.getElementById('reloadButton').onclick = function () {
    loadChallenge(currentChallenge);
};

// Next challenge button inside the overlay
document.getElementById('nextOverlayButton').onclick = function () {
    if (currentChallenge < challenges.length - 1) {
        currentChallenge++;
        loadChallenge(currentChallenge);
        document.getElementById('messageOverlay').style.display = 'none';
    }
};

// Close the overlay
document.getElementById('closeOverlay').onclick = function () {
    document.getElementById('messageOverlay').style.display = 'none';
};

// Reset the game to the current challenge
function resetGame() {
    loadChallenge(currentChallenge);
    document.getElementById('messageOverlay').style.display = 'none';
}

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





