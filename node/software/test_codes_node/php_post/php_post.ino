//kod za custom implementaciju...

#include <WiFi.h>
#include <HTTPClient.h>
#include <OneWire.h>
#include <DallasTemperature.h>

const char* ssid = "ssid";
const char* password = "pass";

String serverName = "path";

unsigned long lastTime = 0;
unsigned long timerDelay = 60000;
String macAdresa = "";
String adr1 = "N/A", adr2 = "N/A", adr3 = "N/A";
float senzori[3];
bool zadnjeStanjeHall = LOW;
bool stanjeProzor = HIGH;
#define ONE_WIRE_BUS 11
#define HALL_POWER 12
#define HALL_READ 13

OneWire oneWire(ONE_WIRE_BUS);
DallasTemperature sensors(&oneWire);
DeviceAddress Thermometer;
   
void setup() {
   Serial.begin(115200);
   WiFi.begin(ssid, password);
   Serial.println("Connecting");
   while(WiFi.status() != WL_CONNECTED) {
     delay(500);
     Serial.print(".");
   }
   Serial.println("");
   Serial.print("IP: ");
   Serial.println(WiFi.localIP());
   Serial.print("MAC: ");
   macAdresa = WiFi.macAddress();
   Serial.println(macAdresa);
   pinMode(HALL_POWER, OUTPUT);
   pinMode(HALL_READ, INPUT);
   sensors.begin();
   sensors.getAddress(Thermometer, 0);
   adr1 = printAddress(Thermometer);
   sensors.getAddress(Thermometer, 1);
   adr2 = printAddress(Thermometer);
   sensors.getAddress(Thermometer, 2);
   adr3 = printAddress(Thermometer);
}

void loop() {
  if ((millis() - lastTime) > timerDelay) {
    Atepmeratura();
    pushData(adr1, adr2, adr3, senzori[0], senzori[1], senzori[2], stanjeProzor);
    lastTime = millis();
  }

  digitalWrite(HALL_POWER, HIGH);
  stanjeProzor = digitalRead(HALL_READ);
  if(zadnjeStanjeHall != stanjeProzor){
    Atepmeratura();
    pushData(adr1, adr2, adr3, senzori[0], senzori[1], senzori[2], stanjeProzor);
    zadnjeStanjeHall = stanjeProzor;
    lastTime = millis();
    delay(100);
  }

  digitalWrite(HALL_POWER, LOW);
  
}

void pushData(String a1, String a2, String a3, float t1, float t2, float t3, bool sp){
  if(WiFi.status()== WL_CONNECTED){
       HTTPClient http;

       http.begin(serverName.c_str());
       http.addHeader("Content-Type", "application/json");

       String jsonData =  "{\"MAC\" : \"" + WiFi.macAddress() + "\",\"temp\" : {\"" + a1 + "\" : \"" + t1 + "\",\"" + a2 + "\" : \"" + t2 + "\" , \"" + a3 + "\" : \"" + t3 + "\"}, \"prozor\" : \"" + sp + "\"}";

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
       Serial.println("WiFi Disconnected");
       ESP.restart();
     }
}

String printAddress(DeviceAddress deviceAddress)
{ 
    String adresa = "";
  for (uint8_t i = 0; i < 8; i++)
  {
    adresa += "0x";
    if (deviceAddress[i] < 0x10) adresa += "0";
    adresa += (deviceAddress[i], HEX);
    if (i < 7) adresa += ", ";
  }
  return adresa;
}

void Atepmeratura(){
  sensors.requestTemperatures(); 

  for(int i = 0; i < 3; i++){
  Serial.print("\t" + String (i+1) + ". senzor: ");
  senzori[i]=sensors.getTempCByIndex(i);
  Serial.print(senzori[i]);
  }
  Serial.println();
}
