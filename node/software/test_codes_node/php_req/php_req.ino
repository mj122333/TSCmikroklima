//kod za custom implementaciju...

#include <WiFi.h>
#include <HTTPClient.h>
#include "DHT.h"
#define DHTPIN 14
#define DHTTYPE DHT11

const char* ssid = "SSID";
const char* password = "PASS";

String serverName = "SERVER_PATH";

DHT dht(DHTPIN, DHTTYPE);

unsigned long lastTime = 0;

unsigned long timerDelay = 60000; //update rate 1 min

void setup() {
   Serial.begin(115200);
   dht.begin();
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
   Serial.println(WiFi.macAddress());
   
}

void loop() {
   if ((millis() - lastTime) > timerDelay) {
     if(WiFi.status()== WL_CONNECTED){
       HTTPClient http;

       int h = dht.readHumidity();
       float t = dht.readTemperature();

       String serverPath = serverName + "?temp="+String(t)+"&vlaga="+String(h)+"&API_key=e32";
       Serial.println(serverPath);
       // Your Domain name with URL path or IP address with path
       http.begin(serverPath.c_str());

       int httpResponseCode = http.GET();

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
     }
     lastTime = millis();
   }
}
