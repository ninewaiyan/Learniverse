let move_speed = 3, grativy = 0.5;
let bird = document.querySelector('.bird');
let img = document.getElementById('bird-1');
let sound_point = new Audio('../sounds/flappy_bird_sounds/point.mp3');
let sound_die = new Audio('../sounds/flappy_bird_sounds/hit.mp3');
let sound_fly = new Audio('../sounds/flappy_bird_sounds/fly.mp3')
let sound_fall = new Audio('../sounds/flappy_bird_sounds/fall.mp3');

// getting bird element properties
let bird_props = bird.getBoundingClientRect();

// This method returns DOMReact -> top, right, bottom, left, x, y, width and height
let background = document.querySelector('.background').getBoundingClientRect();

let score_val = document.querySelector('.score_val');
let message = document.querySelector('.message');
let score_title = document.querySelector('.score_title');

let game_state = 'Start';
img.style.display = 'none';
message.classList.add('messageStyle');

// Get a reference to the audio element
const backgroundMusic = document.getElementById("backgroundMusic");

// Function to start the music
function startMusic() {
    backgroundMusic.play();
}

// Function to pause the music
function pauseMusic() {
    backgroundMusic.pause();
}

// Call the startMusic function when the game starts

document.addEventListener('keydown', (e) => {
    
    if(e.key == 'Enter' && game_state != 'Play'){
        document.querySelectorAll('.pipe_sprite').forEach((e) => {
            e.remove();
        });
        img.style.display = 'block';
        bird.style.top = '40vh';
        game_state = 'Play';
        message.innerHTML = '';
        score_title.innerHTML = 'Score : ';
        score_val.innerHTML = '0';
        message.classList.remove('messageStyle');
        play();
    }
});

function play(){
    startMusic();
    function move(){
        if(game_state != 'Play') return;
        
        let pipe_sprite = document.querySelectorAll('.pipe_sprite');
        pipe_sprite.forEach((element) => {
            let pipe_sprite_props = element.getBoundingClientRect();
            bird_props = bird.getBoundingClientRect();

            if(pipe_sprite_props.right <= 0){
                element.remove();
            }else{
                if(bird_props.left < pipe_sprite_props.left + pipe_sprite_props.width && bird_props.left + bird_props.width > pipe_sprite_props.left && bird_props.top < pipe_sprite_props.top + pipe_sprite_props.height && bird_props.top + bird_props.height > pipe_sprite_props.top){
                    game_state = 'End';
                    const finalScore = score_val.innerHTML; // Get the final score value
                    message.innerHTML =
                        'Game Over'.fontcolor('red') +
                        `<br> Score: <span class="score_val">${finalScore}</span><br>` +
                        '<p class="gOver">Press Enter To Restart</p>' +
                        ' <a href="../views/game_index.php"><i class="fa-solid fa-house"></i></a>';
                    message.classList.add('messageStyle');
                    img.style.display = 'none';
                    sound_die.play();
                    pauseMusic();
                    console.log(finalScore);
                    
                       saveScore(finalScore);
                    
                    return;              
                }else {
                    if (pipe_sprite_props.right < bird_props.left && pipe_sprite_props.right + move_speed >= bird_props.left && element.increase_score == '1') {
                        score_val.innerHTML = parseInt(score_val.innerHTML) + 1;
                        sound_point.play();
                    }
                    element.style.left = pipe_sprite_props.left - move_speed + 'px';
                }
            }
        });
        requestAnimationFrame(move);
    }
    requestAnimationFrame(move);

    let bird_dy = 0;
    function apply_gravity(){
        if(game_state != 'Play') return;
        bird_dy = bird_dy + grativy;
        document.addEventListener('keydown', (e) => {
            if(e.key == 'ArrowUp' || e.key == ' '){
                sound_fly.play();
                img.src = '../images/flappy_bird/Bird-2.png';
                bird_dy = -7.6;
            }
        });

        document.addEventListener('keyup', (e) => {
            if(e.key == 'ArrowUp' || e.key == ' '){
                sound_fly.play();
                img.src = '../images/flappy_bird/Bird.png';
            }
        });

        if(bird_props.top <= 0 || bird_props.bottom >= background.bottom){
            game_state = 'End';
            sound_fall.play();
            pauseMusic();
            message.style.left = '28vw';
           // Restart after a short delay (e.g., 1 second)
           setTimeout(() => {
            window.location.reload();
        }, 1000);
            message.classList.remove('messageStyle');
            return;
        }
        bird.style.top = bird_props.top + bird_dy + 'px';
        bird_props = bird.getBoundingClientRect();
        requestAnimationFrame(apply_gravity);
    }
    requestAnimationFrame(apply_gravity);

    let pipe_seperation = 0;
    let pipe_gap = 35;

    function create_pipe(){
        if(game_state != 'Play') return;

        if(pipe_seperation > 115){
            pipe_seperation = 0;

            let pipe_posi = Math.floor(Math.random() * 43) + 8;
            let pipe_sprite_inv = document.createElement('div');
            pipe_sprite_inv.className = 'pipe_sprite';
            pipe_sprite_inv.style.top = pipe_posi - 70 + 'vh';
            pipe_sprite_inv.style.left = '100vw';

            document.body.appendChild(pipe_sprite_inv);
            let pipe_sprite = document.createElement('div');
            pipe_sprite.className = 'pipe_sprite';
            pipe_sprite.style.top = pipe_posi + pipe_gap + 'vh';
            pipe_sprite.style.left = '100vw';
            pipe_sprite.increase_score = '1';

            document.body.appendChild(pipe_sprite);
        }
        pipe_seperation++;
        requestAnimationFrame(create_pipe);
    }
    requestAnimationFrame(create_pipe);

    function saveScore(score) {
        fetch('../games/flappy_bird.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ 
                quizz_name: 'flappy-birds',
                achievement: 'Reached Score ' + score,
                score: score,
                //user_id: userId
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                console.log("Score saved successfully!");
            } else {
                console.error("Failed to save score:", data.message);
            }
        })
        .catch(error => console.error("Error:", error));
    }
    
}



// function gameover(){
//     const score = document.getElementById("score_val").innerText;
//     if(userId){
//         saveScore(score,userId);
//     } 
// }



// if (game_state === 'End') {
//     const score = parseInt(score_val.innerHTML, 10);
//     saveScore(score);
//     message.innerHTML = 'Game Over'.fontcolor('red') + '<br> <p class="gOver">Press Enter To Restart <p>  <a href="../views/game_index.php"><i class="fa-solid fa-house"></i></a>';
//     message.classList.add('messageStyle');
//     img.style.display = 'none';
//     sound_die.play();
//     pauseMusic();
//     return;
// }