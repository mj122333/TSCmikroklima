$(document).ready(function() {
    naziviAktivnihProstorija.forEach(function (prost){
        let prostorijaSVG = document.getElementById("_" + prost).firstChild;
        prostorijaSVG.style.fill = "#0f0";
    });

    //sve prostorije koje su pravokutnici (ucionice i kabineti)
    let prostorijeRects = document.querySelectorAll('svg > g > rect');
    //prolazimo po svim pravokutnim prostorjama i dodavamo naziv prostorije u centar pravokutnika
    prostorijeRects.forEach(function (rect) {
        let text = document.createElementNS('http://www.w3.org/2000/svg', 'text');

        let x = parseFloat(rect.getAttributeNS(null, "x"));
        let y = parseFloat(rect.getAttributeNS(null, "y"));
        let deltaX = parseFloat(rect.getAttributeNS(null, "width")) * 0.5;
        let deltaY = parseFloat(rect.getAttributeNS(null, "height")) * 0.5;
        text.setAttributeNS(null, "x", ""+(x + deltaX));
        text.setAttributeNS(null, "y", ""+(y + deltaY));

        text.setAttributeNS(null, "class", "ucionice-text");
        text.setAttributeNS(null, "dominant-baseline", "middle");
        text.setAttributeNS(null, "text-anchor", "middle");
        text.appendChild(document.createTextNode(rect.parentElement.id.substring(1, rect.parentElement.id.length)));

        rect.parentElement.appendChild(text);
    });

    let grafIframe = $("#graf");
    $("[id^='_']").each( function (){
        $(this).click(function (mouse){
            /*grafIframe.css.left = mouse.clientX;
            grafIframe.css.top = mouse.clientY;
            grafIframe.css.height = 100;
            grafIframe.css.width = 200;*/
            grafIframe.addClass("graf-on");
            grafIframe.removeClass("graf-off");
            grafIframe.attr("src", "display/main-graph.php?prostorija=" + $(this).attr("id").substring(1));
            $(this).siblings().children(0).css("stroke-width", "2px");
            $(this).children(0).css("stroke-width", "6px");
        });
    });
});