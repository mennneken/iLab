"use strict";

if (document.querySelector('nav')) {
  const navClosed = document.querySelector('.nav--close');
  const navOpened = document.querySelector('.link--menu');
  const supprimer = document.querySelector('.nav__icn-close');

  if (navClosed) {
    navOpened.addEventListener('click', function() {
      navClosed.classList.add('nav--close');
      navClosed.classList.toggle('nav--open');
    });
  }

  supprimer.addEventListener('click', function() {
    navClosed.classList.remove('nav--close');
    navClosed.classList.toggle('nav--open');
  });
}
