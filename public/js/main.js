'use strict';

//SEARCHBAR

let input = document.querySelector("#search");

input.addEventListener('keyup', () => { 
    let textFind = document.querySelector('#search').value;
    if(textFind.length != 0) {
        let myRequest = new Request('/Projet/app/Services/ajax.php', {
            method  : 'POST',
            body    : JSON.stringify({ textToFind : textFind })
        })
        fetch(myRequest)
            .then(res => res.text())
            .then(res => {
                document.getElementById("target").innerHTML = res;
            })
    } else {
        document.getElementById("target").innerHTML = "";
    }
})

//SLIDER===================================

let imgSlider = document.getElementsByClassName('slider__img');
let step = 0;
let nbImg = imgSlider.length;
let previous = document.querySelector('.slider__previous');
let next = document.querySelector('.slider__next');

function removeActiveImages(){
    for(let i = 0; i < nbImg; i++){
        imgSlider[i].classList.remove('slider__img--active');
    }
}

if(next != null){
    next.addEventListener('click', function(){
        step++;
        if(step >= nbImg){
            step = 0;
        }
        removeActiveImages();
        imgSlider[step].classList.add('slider__img--active');
    });
}

if(previous != null){
    previous.addEventListener('click', function(){
        step--;
        if(step < 0 ){
            step = nbImg - 1;
        }
        removeActiveImages();
        imgSlider[step].classList.add('slider__img--active');
    });
}

if(imgSlider != null && next != null && previous != null){
    setInterval(function(){
      step++;
      if(step >= nbImg){
          step = 0;
      }
      removeActiveImages();
      imgSlider[step].classList.add('slider__img--active');  
    }, 4000);
}
