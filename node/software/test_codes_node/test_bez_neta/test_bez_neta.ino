//kod za test jsona, OFFLINE!!
#include <OneWire.h>
#include <DallasTemperature.h>

unsigned long lastTime = 0;
unsigned long timerDelay = 10000;
String macAdresa = "";
String zaSlanjeT = "";
String zaSlanjeH = "";
int broj_senzora = 0;
bool zadnjeStanjeHall[3];
bool statusObjekt[3];
#define ONE_WIRE_BUS 13
#define HALL_POWER 16
#define HALL_READ1 17
#define HALL_READ2 18
#define HALL_READ3 19

OneWire oneWire(ONE_WIRE_BUS);
DallasTemperature sensors(&oneWire);
DeviceAddress Thermometer;
   
void setup() {
   Serial.begin(115200);
   macAdresa = "aa-B0-D0-63-C2-55";
   Serial.println(macAdresa);
   pinMode(HALL_POWER, OUTPUT);
   pinMode(HALL_READ1, INPUT);
   pinMode(HALL_READ2, INPUT);
   pinMode(HALL_READ3, INPUT);
}

void loop() {
  /*
   * slanje podataka, određeni interval vremena (timerDelay)
   * ako dođe do promjene u statusObjekt informacije se šalju odmah
   * interval slanja podataka neovisan je o promjeni statusaObjekta (šalje podatke na timerDelay)
   */
  if ((millis() - lastTime) > timerDelay) {
    mjeri_temperaturu(); //funkcija koja ažurira temperature
    pushData(); //funkcija koja šalje vrijednosti Gotalu i Biškupu
    lastTime = millis();
  }

  hallRefresh(); //"interrupt" funkcija statusObjekt-a (šalje podatke kod promjene, ne čeka timerDelay)
}

void hallRefresh(){ //void funkcija očitanja statusaObjekta
  digitalWrite(HALL_POWER, HIGH); //reset hall senzora
  digitalWrite(HALL_POWER, LOW);

  zaSlanjeH = "";
  zaSlanjeH = ",\"statusObjekt\" : {";
  for(int i = 0; i < 3; i++){
    statusObjekt[i] = digitalRead(17+i); //17, 18, 19 su ulazi senzora statusObjekt-a
    if(zadnjeStanjeHall[i] != statusObjekt[i]){
      zadnjeStanjeHall[i] = statusObjekt[i]; //ako je stanje različito prijašnjem, zapisuje se u listu
      lastTime = millis() + timerDelay; //Slanje ažuriranih podataka, odmah
    }
    zaSlanjeH += "\"" + String(17+i) + "\" : \"" + statusObjekt[i] + "\""; //spremanje stanja u zaSlanjeH string (u json formatu)
    if(i != 2) zaSlanjeH += ",";
  }
  zaSlanjeH += "}";
}

void pushData(){
       //String jsonData =  "{\"MAC\" : \"" + macAdresa + "\",\"temp\" : {\"" + a1 + "\" : \"" + t1 + "\",\"" + a2 + "\" : \"" + t2 + "\" , \"" + a3 + "\" : \"" + t3 + "\"}, \"prozor\" : \"" + sp + "\"}";
       String jsonData =  "{\"MAC\" : \"" + macAdresa + "\"," + zaSlanjeT + zaSlanjeH + "\"}";
       Serial.println(jsonData);
       zaSlanjeT = ""; //reset stringa za temperature
       zaSlanjeH = ""; //reset stringa za statusObjekta (hall)
}

void mjeri_temperaturu(){
  sensors.begin(); //inicijalizacija senzora u svakom krugu očitanja (omogućuje hot-swap)
  broj_senzora = sensors.getDeviceCount(); //spremanje broja senzora
  sensors.requestTemperatures(); //očitavanje temperatura pomoću biblioteke
  
  zaSlanjeT += "\"temp\" : {\""; //početak json dijela s temperaturnim senzorima
  for(int sen = 0; sen < broj_senzora; sen++){
    sensors.getAddress(Thermometer, sen);
    zaSlanjeT += printAddress(Thermometer); //očitavanje adrese
    zaSlanjeT += "\" : \"";
    zaSlanjeT += sensors.getTempCByIndex(sen); //očitavanje temperature
    if(sen != broj_senzora-1) zaSlanjeT += "\",\"";
  }
  zaSlanjeT += "\"}";
}

String printAddress(DeviceAddress deviceAddress) //funkcija za adresu temperaturnih senzora
{ 
    String adresa = "";
  for (uint8_t i = 0; i < 8; i++)
  {
    adresa += "0x";
    if (deviceAddress[i] < 0x10) adresa += "0";
    adresa += String(deviceAddress[i], HEX);
    if (i < 7) adresa += ", ";
  }
  return adresa;
}
