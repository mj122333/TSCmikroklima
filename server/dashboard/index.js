document.querySelectorAll('.content').forEach(function (element) {
    var classNames = Array.from(element.classList);
    classNames.forEach(function (className) {
        if (className.startsWith('r')) {
            var rowSpan = parseInt(className.charAt(1));
            var colSpan = parseInt(className.charAt(3));
            element.style.gridRow = "span " + rowSpan;
            element.style.gridColumn = "span " + colSpan;
        }
    });
});




var elem = document.querySelector(".main-container");
var gc = document.querySelector(".green-circle");
function handleResize() {
    elem.style.gridTemplateRows = "repeat(2, " + ((document.body.offsetWidth - 402) / 6) + "px) 70px repeat(2, " + ((document.body.offsetWidth - 402) / 6) + "px) 100px";
    if (gc.parentNode.offsetWidth > gc.parentNode.offsetHeight) {
        gc.style.width = gc.parentNode.offsetHeight - 60 + "px";
        gc.style.height = gc.parentNode.offsetHeight - 60 + "px";
    }
    else {
        gc.style.height = gc.parentNode.offsetWidth - 60 + "px";
        gc.style.width = gc.parentNode.offsetWidth - 60 + "px";
    }
    console.log(gc.offsetHeight);
    console.log(gc.offsetWidth)

}
handleResize();
window.addEventListener('resize', handleResize);




//https://jambrosic.xyz/mikroklima/display/main-graph.php?prostorija=L31&start=2023-03-01&kraj=2023-03-28&max_points=1000

document.querySelector('.prvi-kat').parentNode.addEventListener('click', function () {
    window.open('https://jambrosic.xyz/mikroklima/tlocrt/pc/glavna_kat.php', '_blank');
});

var naslovnica = document.querySelector(".naslovnica");
addEventListener("scroll", (event) => {
    if (naslovnica.offsetHeight < window.scrollY) {

    }
});


// Event listener approach
const dropdownSelect = document.querySelector('#dropdown');
const graf = document.querySelector('#graf');
const pocetakVrijeme = document.querySelector('#time-pocetak');
const krajVrijeme = document.querySelector('#time-kraj');
var dateTime = new Date();
dateTime.setMilliseconds(0);
dateTime.setSeconds(0);
dateTime.setDate(dateTime.getDate() - 1);
dateTime.setHours(dateTime.getHours() + 2);
var formattedDateTime = dateTime.toISOString().slice(0, -1).replace("T", " ");
console.log(formattedDateTime);
pocetakVrijeme.value = formattedDateTime;
dateTime = new Date();
dateTime.setMilliseconds(0);
dateTime.setSeconds(0);

dateTime.setHours(dateTime.getHours() + 2);
krajVrijeme.value = dateTime.toISOString().slice(0, -1).replace("T", " ");
[dropdownSelect, pocetakVrijeme, krajVrijeme].forEach(function (element) {
    element.addEventListener('change', function () {
        graf.src = "../display/main-graph.php?prostorija=" + dropdownSelect.value + "&start=" + pocetakVrijeme.value + "&kraj=" + krajVrijeme.value +"&max_points=1000";
    });
});


var desiredValue = 'L31';

for (var i = 0; i < dropdownSelect.options.length; i++) {
    if (dropdownSelect.options[i].value === desiredValue) {
        dropdownSelect.selectedIndex = i;
        break;
    }
}
graf.src = "../display/main-graph.php?prostorija=" + dropdownSelect.value + "&start=" + pocetakVrijeme.value + "&kraj=" + krajVrijeme.value+"&max_points=1000";
