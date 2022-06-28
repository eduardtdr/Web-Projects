'use strict';

//define an array of names wich represent the names of pictures
//with math.random get a random name from the array
//submit button

const array = [1, 2, 3];

const selectImage = document.querySelector('.image');
const selectCategory = document.querySelector('.btn--category');
const player0Input = document.querySelector('.input--0');
const player1Input = document.querySelector('.input--1');

const init = function () {
  selectImage.classList.add('hidden');
};

init();

const categories = {
  st: `Choose one of the categories by tiping the equivalent number`,
  selections: ['0: small', '1: big'],
  registerAnswer() {
    const answer = Number(prompt(`${this.st}\n${this.selections.join('\n')}`));
    return answer;
  },
};

selectCategory.addEventListener('click', function () {
  const value = array[Math.floor(Math.random() * array.length) + 1];
  selectImage.classList.remove('hidden');
  selectImage.src = `category${
    categories.registerAnswer() + 1
  }/dice-${value}.png`;
});
