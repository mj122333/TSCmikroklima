
#include <WiFi.h>
#include <HTTPClient.h>
#include "DHT.h"
#define DHTPIN 14
#define DHTTYPE DHT11

const char* ssid = "ssid";
const char* password = "pass";

String serverName = "http://things.com.hr/skripte/primi.php";

DHT dht(DHTPIN, DHTTYPE);

unsigned long lastTime = 0;
// Timer set to 10 minutes (600000)
//unsigned long timerDelay = 600000;
// Set timer to 5 seconds (5000)
unsigned long timerDelay = 60000;

void setup() {
   Serial.begin(115200);
   dht.begin();
   pinMode(2, OUTPUT); //led na ploci
   digitalWrite(2, LOW);
   WiFi.begin(ssid, password);
   Serial.println("Connecting");
   Serial.println(WiFi.macAddress());
   //Serial.println(WiFi.ipAddress());
   while(WiFi.status() != WL_CONNECTED) {
     delay(500);
     Serial.print(".");
   }
   digitalWrite(2, HIGH);
   Serial.println("");
   Serial.print("Connected to WiFi network with IP Address: ");
   Serial.println(WiFi.localIP());

   
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
