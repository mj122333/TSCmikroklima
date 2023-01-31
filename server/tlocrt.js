$(document).ready(function() {
    naziviAktivnihProstorija.forEach(function (prost){
        let prostorija = document.getElementById("_" + prost);
        let prostorijaRect = prostorija.firstChild;
        prostorijaRect.style.fill = "#8ee09c";

        let x = parseFloat(prostorijaRect.getAttributeNS(null, "x"));
        let y = parseFloat(prostorijaRect.getAttributeNS(null, "y"));
        const RECT_OFFSET_X = 10;
        const RECT_OFFSET_Y = 10;
        const RECT_WIDTH = 80;
        const RECT_HEIGHT = 40;

        for (var i = 0; i < 3; i++){
            let tempRect = document.createElementNS('http://www.w3.org/2000/svg', 'rect');
            let rectX = (x + RECT_OFFSET_X);
            let rectY = (y + RECT_OFFSET_Y + i * (RECT_OFFSET_Y + RECT_HEIGHT));
            tempRect.setAttributeNS(null, "x", "" + rectX);
            tempRect.setAttributeNS(null, "y", "" + rectY);
            tempRect.setAttributeNS(null, "width", "" + RECT_WIDTH);
            tempRect.setAttributeNS(null, "height", "" + RECT_HEIGHT);
            if (i === 0)
                tempRect.setAttributeNS(null, "fill", "#3c3");
            else if (i === 1)
                tempRect.setAttributeNS(null, "fill", "#f33");
            else
                tempRect.setAttributeNS(null, "fill", "#33f");
            prostorija.appendChild(tempRect);

            let tempText = document.createElementNS('http://www.w3.org/2000/svg', 'text');
            tempText.setAttributeNS(null, "x", ""+(rectX + 0.5 * RECT_WIDTH));
            tempText.setAttributeNS(null, "y", ""+(rectY + 0.5 * RECT_HEIGHT));
            tempText.setAttributeNS(null, "dominant-baseline", "middle");
            tempText.setAttributeNS(null, "text-anchor", "middle");
            tempText.setAttributeNS(null, "class", "temp-text");
            tempText.appendChild(document.createTextNode(temperatureProstorija[prost][i] + "°C"));
            prostorija.appendChild(tempText);
        }

    });

    //sve prostorije koje su pravokutnici (ucionice i kabineti)
    let prostorijeRects = document.querySelectorAll('svg > g > rect:first-child');
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