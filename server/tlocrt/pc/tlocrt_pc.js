function generirajSVG(){
    naziviAktivnihProstorija.forEach(function (prost){
        baterije[prost] /= 1000;

        //postavljanje boje aktivnih prostorija
        let prostorija = document.getElementById("_" + prost);
        if (prostorija === null) return;
        let prostorijaRect = prostorija.firstChild;
        prostorijaRect.style.fill = "#F5BF7B";

        //prikazivanje temperature na tlocrtu
        let x = parseFloat(prostorijaRect.getAttributeNS(null, "x"));
        let y = parseFloat(prostorijaRect.getAttributeNS(null, "y"));
        const RECT_OFFSET_X = 10;
        const RECT_OFFSET_Y = 10;
        const RECT_WIDTH = 100;
        const RECT_HEIGHT = 50;

        for (let i = 0; i < 3; i++){
            if (temperatureProstorija[prost][i] == null) continue;

            let tempRect = document.createElementNS('http://www.w3.org/2000/svg', 'rect');
            let rectX = (x + RECT_OFFSET_X);
            let rectY = (y + RECT_OFFSET_Y + i * (RECT_OFFSET_Y + RECT_HEIGHT));
            if (prost === "26" || prost === "27" || prost === "28")
                rectY += parseFloat(prostorijaRect.getAttributeNS(null, "height"));

            tempRect.setAttributeNS(null, "x", "" + rectX);
            tempRect.setAttributeNS(null, "y", "" + rectY);
            tempRect.setAttributeNS(null, "width", "" + RECT_WIDTH);
            tempRect.setAttributeNS(null, "height", "" + RECT_HEIGHT);
            tempRect.setAttributeNS(null, "rx", "20");
            tempRect.setAttributeNS(null, "stroke", "black");
            tempRect.setAttributeNS(null, "stroke-width", "3");
            tempRect.setAttributeNS(null, "class", "rect" + i);
            if (i === 0)
                tempRect.setAttributeNS(null, "fill", "#8EB028");
            else if (i === 1)
                tempRect.setAttributeNS(null, "fill", "#CC311B");
            else
                tempRect.setAttributeNS(null, "fill", "#4379CC");
            prostorija.appendChild(tempRect);

            let tempText = document.createElementNS('http://www.w3.org/2000/svg', 'text');
            tempText.setAttributeNS(null, "x", ""+(rectX + 0.5 * RECT_WIDTH));
            tempText.setAttributeNS(null, "y", ""+(rectY + 0.5 * RECT_HEIGHT));
            tempText.setAttributeNS(null, "dominant-baseline", "middle");
            tempText.setAttributeNS(null, "text-anchor", "middle");
            tempText.setAttributeNS(null, "class", "temp-text");
            tempText.appendChild(document.createTextNode(temperatureProstorija[prost][i] + "°C"));
            
            prostorija.appendChild(tempText);

            let tooltip = document.createElementNS('http://www.w3.org/2000/svg', 'title');
            switch (i) {
                case 0:
                    tooltip.textContent = "sobna temperatura";
                    break;
                case 1:
                    tooltip.textContent = "temperatura radijatora";
                    break;
                case 2:
                    tooltip.textContent = "temperatura klime";
                    break;
            }
            
            let rectElement = prostorija.querySelector(".rect" + i);
            rectElement.appendChild(tooltip);
        }

        //prikaz otvorenog prozora na tlocrtu
        x = parseFloat(prostorijaRect.getAttributeNS(null, "x"))
            + parseFloat(prostorijaRect.getAttributeNS(null, "width"));
        y = parseFloat(prostorijaRect.getAttributeNS(null, "y"));

        const ICON_OFFSET_X = 10;
        const ICON_OFFSET_Y = 10;
        const ICON_WIDTH = 50;
        const ICON_HEIGHT = 50;

        for (i = 0; i < 2; i++){
            let icon = document.createElementNS('http://www.w3.org/2000/svg', 'image');
            let iconX = (x - ICON_OFFSET_X - ICON_WIDTH);
            let iconY = (y + ICON_OFFSET_Y + i * (ICON_OFFSET_Y + ICON_HEIGHT));

            icon.setAttributeNS(null, "x", "" + iconX);
            icon.setAttributeNS(null, "y", "" + iconY);
            icon.setAttributeNS(null, "width", "" + ICON_WIDTH);
            icon.setAttributeNS(null, "height", "" + ICON_HEIGHT);
            icon.setAttributeNS(null, "id", "ICON" + prost + i)

            let tooltip = document.createElementNS('http://www.w3.org/2000/svg', 'title');

            //ikona upozorenja
            if (i === 1) {
                icon.setAttributeNS("http://www.w3.org/1999/xlink", "href", "../ikone/oprez_zuto.svg");
                tooltip.textContent = "Otvoren prozor i upaljeno grijanje u poslijednjih 8h";

                if (otvoreniProzori[prost] === "1" && 
                    (temperatureProstorija[prost][0] > 35.0 || temperatureProstorija[prost][1] > 35.0 || temperatureProstorija[prost][2] > 35.0)){
                        icon.setAttributeNS("http://www.w3.org/1999/xlink", "href", "../ikone/oprez_crveno.svg");
                        tooltip.textContent = "Otvoren prozor i upaljeno grijanje";
                }
                else if (greske[prost] === false){
                    icon.setAttributeNS(null, "display", "none");
                }
            }
            //ikona za prozor
            else if (i === 0){
                if (otvoreniProzori[prost] === "1"){
                    icon.setAttributeNS("http://www.w3.org/1999/xlink", "href", "../ikone/prozor_otvoren.svg");
                    tooltip.textContent = "Prozor otvoren";
                }
                else{
                    icon.setAttributeNS("http://www.w3.org/1999/xlink", "href", "../ikone/prozor_zatvoren.svg");
                    tooltip.textContent = "Prozor zatvoren";
                }
            }
            prostorija.append(icon);

            let iconElement = prostorija.querySelector("#ICON" + prost + i);
            console.log(iconElement);
            iconElement.appendChild(tooltip);
        }

        y = parseFloat(prostorijaRect.getAttributeNS(null, "y"))
            + parseFloat(prostorijaRect.getAttributeNS(null, "height"));

        //prikaz baterije
        let iconX = (x - ICON_OFFSET_X - ICON_WIDTH);
        let iconY = (y - ICON_OFFSET_Y - ICON_HEIGHT);

        const maxFillHeight = 46;
        const minVoltage = 3, maxVoltage = 4.2;

        if (baterije[prost] < minVoltage - 0.1 || baterije[prost] > maxVoltage + 0.1){
            let icon = document.createElementNS('http://www.w3.org/2000/svg', 'image');
            icon.setAttributeNS("http://www.w3.org/1999/xlink", "href", "../ikone/no_battery.svg");
            icon.setAttributeNS(null, "x", "" + iconX);
            icon.setAttributeNS(null, "y", "" + iconY);
            icon.setAttributeNS(null, "width", "" + ICON_WIDTH);
            icon.setAttributeNS(null, "height", "" + ICON_HEIGHT);
            icon.setAttributeNS(null, "id", "BAT" + prost);
            prostorija.append(icon);

            let tooltip = document.createElementNS('http://www.w3.org/2000/svg', 'title');
            tooltip.textContent = "Čvor ne sadrži bateriju.";
            let iconElement = prostorija.querySelector("#BAT" + prost);
            iconElement.appendChild(tooltip);
        }
        else {
            const xhr = new XMLHttpRequest();
            xhr.open('GET', "../ikone/battery.svg");
            xhr.onload = () => {
                // dobhvatimo SVG datoteku te ju pretvorimo u document element
                const svgString = xhr.responseText;
                const parser = new DOMParser();
                const icon = parser.parseFromString(svgString, 'image/svg+xml').documentElement;
                
                // postavimo atribute
                icon.setAttributeNS(null, "x", "" + iconX);
                icon.setAttributeNS(null, "y", "" + iconY);
                icon.setAttributeNS(null, "width", "" + ICON_WIDTH);
                icon.setAttributeNS(null, "height", "" + ICON_HEIGHT);
                icon.setAttributeNS(null, "id", "BAT" + prost);
                
                let batPercent = Math.min(Math.max(((baterije[prost] - minVoltage) / (maxVoltage - minVoltage)), 0), 1);
                let fillHeight = batPercent * maxFillHeight;
                batFill = icon.querySelector(".bat-fill")
                batFill.setAttributeNS(null, "height", "" + fillHeight);
                batFill.setAttributeNS(null, "y", "" + (2 + maxFillHeight - fillHeight));
            
                // dodamo ikonu
                prostorija.append(icon);

                let tooltip = document.createElementNS('http://www.w3.org/2000/svg', 'title');
                tooltip.textContent = "Baterija na " + (Math.round((batPercent + Number.EPSILON) * 100)) + "%";
                let iconElement = prostorija.querySelector("#BAT" + prost);
                iconElement.appendChild(tooltip);
            };
            xhr.send();
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
            grafIframe.addClass("graf-on");
            grafIframe.removeClass("graf-off");
            grafIframe.attr("src", "../../display/main-graph.php?prostorija=" + $(this).attr("id").substring(1));
            $(this).siblings().children(0).css("stroke-width", "2px");
            $(this).children(0).css("stroke-width", "6px");
        });
    });
}

$(document).ready(function() {
    generirajSVG();
});