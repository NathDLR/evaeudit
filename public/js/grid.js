let note = document.getElementById('note_' + id);
const lettersTr = document.getElementsByClassName('letters');
let thead = document.getElementById('');

let selectLetter = note.getElementsByTagName('option')[note.selectedIndex].innerHTML;
let selectValue = note.getElementsByTagName('option')[note.selectedIndex].value;

let points = document.getElementById('points_' + id);

console.log(points);
console.log(selectLetter);
console.log(selectValue);

const lettersTd = document.getElementsByClassName('letter_' + id);
let commentSection = document.getElementsByClassName('comment_' + id);
let commentHead = document.getElementsByClassName('comment');

console.log(commentSection);

for (let i = 0; i < lettersTr.length; i++) {
    if (lettersTr[i].innerHTML.substr(0, 1) != selectLetter && (selectLetter != 'Cliquez-ici' && selectLetter != 'Click-here')) {
        lettersTr[i].setAttribute('class', 'letters hidden');
        lettersTd[i].setAttribute('class', 'letter_' + id + ' hidden');
    } else {
        lettersTr[i].setAttribute('class', 'letters');
        lettersTd[i].setAttribute('class', 'letter_' + id);
    }
}

for (let i = 0; i < commentSection.length; i++) {
    if (selectLetter == 'Cliquez-ici' || selectLetter == 'Click-here'){
        commentSection[i].setAttribute('class', 'comment_' + id + ' hidden');
        commentHead[i].setAttribute('class', 'comment hidden');
    }else{
        commentSection[i].setAttribute('class', 'comment_' + id);
        commentHead[i].setAttribute('class', 'comment');
    }
}

points.innerHTML = selectValue;