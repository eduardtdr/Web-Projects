'use strict';

// console.log(document.querySelector('.message').textContent);

// document.querySelector('.message').textContent = 'Correct Number!♿';

// console.log(document.querySelector('.message').textContent);

// document.querySelector('.number').textContent = 13;

// document.querySelector('.score').textContent = 13;

// document.querySelector('.guess').value = 23;

// console.log(document.querySelector('.guess').value);

let secretNumber = Math.trunc(Math.random() * 20) + 1;
//console.log(secretNumber);
let score = 20;
let highscore = 0;

function displayMessage(message) {
  document.querySelector('.message').textContent = message;
}

document.querySelector('.check').addEventListener('click', function () {
  const guess = Number(document.querySelector('.guess').value);

  //no input
  if (!guess) {
    document.querySelector('.message').textContent =
      'You did not enter any guess♿';

    //correct guess
  } else if (guess == secretNumber) {
    // document.querySelector('.message').textContent =
    //   'Congrats, you guessed it!😒';
    displayMessage('Congrats, you guessed it!😒');
    document.querySelector('.score').textContent = score;
    document.querySelector('.number').textContent = guess;
    document.querySelector('body').style.backgroundColor = 'green';
    document.querySelector('.number').style.width = '35rem';
    if (score > highscore) highscore = score;
    //low number
  } else if (guess != secretNumber) {
    if (score > 1) {
      //   document.querySelector('.message').textContent =
      //     guess < secretNumber ? 'Try a higher number!' : 'Try a lower number!';
      displayMessage(
        guess < secretNumber ? 'Try a higher number!' : 'Try a lower number!'
      );
      score--;
      document.querySelector('.score').textContent = score;
    } else {
      //   document.querySelector('.message').textContent = 'You lost!😘';
      displayMessage('You lost!😘');
      document.querySelector('body').style.backgroundColor = 'red';
      document.querySelector('.score').textContent = score - 1;
    }
  }
  //   } else if (guess < secretNumber) {
  //     if (score > 1) {
  //       document.querySelector('.message').textContent = 'Try a higher number!';
  //       score--;
  //       document.querySelector('.score').textContent = score;
  //     } else {
  //       document.querySelector('.message').textContent = 'You lost!😘';
  //       document.querySelector('body').style.backgroundColor = 'red';
  //       document.querySelector('.score').textContent = score - 1;
  //     }

  //     //high number
  //   } else if (guess > secretNumber) {
  //     if (score > 1) {
  //       document.querySelector('.message').textContent = 'Try a lower number!';
  //       score--;
  //       document.querySelector('.score').textContent = score;
  //     } else {
  //       document.querySelector('.message').textContent = 'You lost!😘';
  //       document.querySelector('body').style.backgroundColor = 'red';
  //       document.querySelector('.score').textContent = score - 1;
  //     }
  //   }
  // }
});

document.querySelector('.again').addEventListener('click', function () {
  score = 20;
  secretNumber = Math.trunc(Math.random() * 20) + 1;
  document.querySelector('.score').textContent = score;
  document.querySelector('.number').style.width = '15rem';
  document.querySelector('.number').textContent = '?';
  document.querySelector('body').style.backgroundColor = '#222';
  //   document.querySelector('.message').textContent = 'Start guessing...';
  displayMessage('Start guessing...');
  document.querySelector('.guess').value = '';
  document.querySelector('.highscore').textContent = highscore;
  console.log(secretNumber);
});
