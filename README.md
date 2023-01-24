<div align="center">

[![Contributors][contributors-shield]][contributors-url]
[![Stargazers][stars-shield]][stars-url]

</div>

# TSC Mikroklima

TSC Mikroklima je projekt koji se bavi izgradnjom IoT sistema za mjerenje raznih parametara u školi.  
Sistem koristi senzore koji mjere: 
* temperaturu
* vlagu
* pritisak zraka
* otvorene prozore


Podaci se prikupljaju i prenose na cloud platformu gdje se obrađuju i prikazuju na različite načine, kao što su grafovi, tabele i mape. Cilj projekta
je pružiti školi uvid u stanje učionica i pomoći u održavanju optimalnih uvjeta za učenje. Također, sistem će biti dostupan putem web sučelja za lakše praćenje i 
upravljanje.Sada radimo na izgradnji i testiranju sistema i planiramo ga uključiti u školske aktivnosti u najkraćem mogućem roku.


Ovaj projekt sadrži sljedeće jezike/frameworke/biblioteke:
* [![C++][Cpp]][Cpp-url]
* [![JSON][JSON]][JSON-url]
* [![PHP][PHP]][PHP-url]
* [![MySQL][MySQL]][MySQL-url]
* [![JS][JS]][JS-url]



<!-- GETTING STARTED -->
## Korištenje
pojašnjanje kako koristiti djelove ovog projekta.

### JSON upit za [submit.php](https://github.com/mj122333/TSCmikroklima/blob/main/server/submit.php)
Objašnjenje:

```JSON
{
  "MAC": "#MAC adresa uređaja koji šalje POST zahtjev",
  "temp": {
    "#adresa senzora za temperaturu": "#temperatura u decimalnom zapisu",
    "adresa sljedećeg senzora za temperaturu": "#temperatura u decimalnom zapisu",
    "adresa n-tog senzora za temperaturu": "#temperatura u decimalnom zapisu"
  },
  "statusObjekt": {
    "#pin senzora za status  objekta": "#je li prozor otvoren",
    "#pin sljedećeg za status objekta": "#je li prozor otvoren",
    "#pin n-tog za status objekta": "#je li prozor otvoren"
  }
}
```

Primjer:
```JSON
{
  "MAC": "01-23-45-67-89-AB",
  "temp": {
    "0x12, 0x34, 0x56, 0x78, 0x9A, 0xBC, 0xDE, 0xF0": 23.42,
    "0x12, 0x34, 0x56, 0x78, 0x9A, 0xBC, 0xDE, 0xF1": 22,
    "0x12, 0x34, 0x56, 0x78, 0x9A, 0xBC, 0xDE, 0xF2": 21.1
  },
  "statusObjekt": {
    "1": 1,
    "4": 0,
    "23": 1
  }
}
```
[Primjer upita u Postman-u](https://github.com/mj122333/TSCmikroklima/blob/main/server/skola-IoT.postman_collection.json) (importati u Postman)



[CPP]: https://img.shields.io/badge/C++-909DAB?style=for-the-badge&logo=cplusplus&logoColor=00599C
[CPP-url]: https://isocpp.org/

[JSON]: https://img.shields.io/badge/JSON-000?style=for-the-badge&logo=JSON
[JSON-url]: https://www.json.org/

[PHP]: https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=333
[PHP-url]: https://isocpp.org/

[MySQL]: https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=FFF
[MySQL-url]: https://www.mysql.com/

[JS]: https://img.shields.io/badge/javascript-000000?style=for-the-badge&logo=javascript&logoColor=F7DF1E
[JS-url]: https://www.javascript.com/




[contributors-shield]: https://img.shields.io/github/contributors/mj122333/TSCmikroklima.svg?style=for-the-badge
[contributors-url]: https://github.com/mj122333/TSCmikroklima/graphs/contributors

[stars-shield]: https://img.shields.io/github/stars/mj122333/TSCmikroklima.svg?style=for-the-badge
[stars-url]: https://github.com/mj122333/TSCmikroklima/stargazers
