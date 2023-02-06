//kod za custom implementaciju...

#include <WiFi.h>
#include <HTTPClient.h>
#include <OneWire.h>
#include <DallasTemperature.h>

const char* ssid = "";
const char* password = "";

String serverName = "";

unsigned long lastTime = 0;
unsigned long timerDelay = 60000;
String key = "esp32"; //super tajni key
String macAdresa = "";
String zaSlanjeT = "";
String zaSlanjeH = "";
String zaSlanjeM = "";
int broj_senzora = 0;
bool zadnjeStanjeHall[3];
bool statusObjekt[3];
#define ONE_WIRE_BUS 13
#define B20_POWER 23
#define HALL_POWER 16
#define HALL_READ1 17
#define HALL_READ2 18
#define HALL_READ3 19
#define BATT 32

OneWire oneWire(ONE_WIRE_BUS);
DallasTemperature sensors(&oneWire);
DeviceAddress Thermometer;
   
void setup() {
   Serial.begin(115200);
   WiFi.begin(ssid, password);
   delay(2000);
   Serial.println("Spajanje");
   while(WiFi.status() != WL_CONNECTED) {
     WiFi.begin(ssid, password);
     delay(5000);
     //yield();
   }
   Serial.println("");
   Serial.print("IP: ");
   Serial.println(WiFi.localIP());
   Serial.print("MAC: ");
   macAdresa = WiFi.macAddress();
   Serial.println(macAdresa);
   Serial.println(WiFi.RSSI());
   pinMode(HALL_POWER, OUTPUT);
   pinMode(HALL_READ1, INPUT);
   pinMode(HALL_READ2, INPUT_PULLDOWN);
   pinMode(HALL_READ3, INPUT_PULLDOWN);
   pinMode(BATT, INPUT);
   pinMode(B20_POWER, OUTPUT);
   digitalWrite(B20_POWER, HIGH); //no deep sleep
}

void loop() {
  /*
   * slanje podataka, određeni interval vremena (timerDelay)
   * ako dođe do promjene u statusObjekt informacije se šalju odmah
   * interval slanja podataka neovisan je o promjeni statusaObjekta (šalje podatke na timerDelay)
   */
  if ((millis() - lastTime) > timerDelay) {
    mjeri_temperaturu(); //funkcija koja ažurira temperature
    get_metadata(); //WiFi status i baterija
    pushData(); //funkcija koja šalje vrijednosti Gotalu i Biškupu
    lastTime = millis();
  }

  hallRefresh(); //"interrupt" funkcija statusObjekt-a (šalje podatke kod promjene, ne čeka timerDelay)
}

void hallRefresh(){ //void funkcija očitanja statusaObjekta
  digitalWrite(HALL_POWER, LOW); //reset hall senzora
  delay(10);
  digitalWrite(HALL_POWER, HIGH);
  delay(100); //pricekati da se hallovi stabiliziraju?
  zaSlanjeH = "";
  zaSlanjeH = ",\"statusObjekt\" : {";
  for(int i = 0; i < 3; i++){
    statusObjekt[i] = digitalRead(17+i); //17, 18, 19 su ulazi senzora statusObjekt-a
    delay(20);
    if (statusObjekt[i] != digitalRead(17+i)) //ako dva slijedna ocitanja daju razlicite vrijednosti -> preskoci
        continue;
   
    //ovaj dio moramo prodiskutirati
    if(zadnjeStanjeHall[i] != statusObjekt[i]){//
      zadnjeStanjeHall[i] = statusObjekt[i]; //ako je stanje različito prijašnjem, zapisuje se u listu
      lastTime = millis() + timerDelay; //Slanje ažuriranih podataka, odmah (ukoliko je doslo do promjene barem jednog senzora)
    }
    zaSlanjeH += "\"" + String(17+i) + "\" : \"" + statusObjekt[i] + "\""; //spremanje stanja u zaSlanjeH string (u json formatu)
    if(i != 2) zaSlanjeH += ",";
  }
  zaSlanjeH += "}";
}

void pushData(){
  if(WiFi.status()== WL_CONNECTED){
       HTTPClient http;

       http.begin(serverName.c_str());
       Serial.println(serverName.c_str());
       http.addHeader("Content-Type", "application/json");

       //String jsonData =  "{\"MAC\" : \"" + macAdresa + "\",\"key\" : \"esp32\",\"temp\" : {\"0xtest1\" : \"15\",\"0xtest2\" : \"20\" , \"0xtest3\" : \"25\"}}";
       String jsonData =  "{\"MAC\" : \"" + macAdresa + "\",\"key\" : \"" + key + "\"," + zaSlanjeT + zaSlanjeH + zaSlanjeM + "}";
       Serial.println(jsonData);
       zaSlanjeT = ""; //reset stringa za temperature
       zaSlanjeH = ""; //reset stringa za statusObjekta (hall)
       zaSlanjeM = ""; //reset stringa za metadata
       
       int httpResponseCode = http.POST(jsonData.c_str());

       if (httpResponseCode>0) {
         Serial.print("HTTP Response code: ");
         Serial.println(httpResponseCode);
         String payload = http.getString();
         Serial.println(payload);
       }
       else {
         Serial.print("Error code: ");
         Serial.println(httpResponseCode);
       }
       http.end();
     }
     else {
      while(WiFi.status() != WL_CONNECTED) { //ako esp32 nije spojen na WiFi u trenutku slanja poruke (ponovno spajanje)
        Serial.println("LostConnection, SPAJANJE!");
        WiFi.begin(ssid, password);
        delay(10000);
        //yield();
      }
      pushData(); //slanje podataka odmah nakon ponovnog spajanja
    }
}

void get_metadata(){
  zaSlanjeM = ",\"metadata\" : {\"wifi_rssi:\" : \"";
  zaSlanjeM += WiFi.RSSI();
  zaSlanjeM += "\",\"baterija\" : \"";
  float ulazA = analogRead(BATT);
  float napon = ulazA/4096 * 6.6; //3.3V nominal, naponsko djelilo 1/2
  zaSlanjeM += napon;
  zaSlanjeM += "\"}";
}

void mjeri_temperaturu(){
  sensors.begin(); //inicijalizacija senzora u svakom krugu očitanja (omogućuje hot-swap)
  delay(10);
  broj_senzora = sensors.getDeviceCount(); //spremanje broja senzora
  sensors.requestTemperatures(); //očitavanje temperatura pomoću biblioteke
  delay(10);
  zaSlanjeT += "\"temp\" : {\""; //početak json dijela s temperaturnim senzorima
  for(int sen = 0; sen < broj_senzora; sen++){
    if(sensors.getTempCByIndex(sen) == -127) 
      continue;
    sensors.getAddress(Thermometer, sen);
    zaSlanjeT += printAddress(Thermometer); //očitavanje adrese
    zaSlanjeT += "\" : \"";
    zaSlanjeT += sensors.getTempCByIndex(sen); //očitavanje temperature
    if(sen != broj_senzora-1) zaSlanjeT += "\",\"";
    delay(5);
  }
  zaSlanjeT += "\"}";
}

String printAddress(DeviceAddress deviceAddress) //funkcija za adresu temperaturnih senzora
{ 
    String adresa = "0x";
  for (uint8_t i = 0; i < 8; i++)
  {
    adresa += String(deviceAddress[i], HEX);
  }
  return adresa;
}
