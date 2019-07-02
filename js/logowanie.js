document.addEventListener("DOMContentLoaded", function() {

    var logowanie = document.querySelector('.logowanie');
    var zarejestruj = document.querySelector('.rejsetrowanie');
    var wybor = document.querySelector('.fwybor');
    var fzaloguj = document.querySelector('.zaloguj');
    var fzarejestruj = document.querySelector('.zarejestruj');
    var cofnij = document.querySelectorAll('.cofnij');

    logowanie.onclick = function(){
        wybor.style.display = "none";
        fzaloguj.style.display = "block";
    }

    zarejestruj.onclick = function(){
        wybor.style.display = "none";
        fzarejestruj.style.display = "block";
    }

    for (const cof of cofnij) {
        cof.onclick = function(){
            fzaloguj.style.display = "none";
            fzarejestruj.style.display = "none";
            wybor.style.display = "block";
        }
    }
});