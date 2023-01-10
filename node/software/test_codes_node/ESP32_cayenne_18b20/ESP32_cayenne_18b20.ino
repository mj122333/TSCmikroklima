//#define CAYENNE_DEBUG
#define CAYENNE_PRINT Serial
#include <CayenneMQTTESP32.h>
#include <OneWire.h>
#include <DallasTemperature.h>

#define ONE_WIRE_BUS 13

OneWire oneWire(ONE_WIRE_BUS);
DallasTemperature sensors(&oneWire);

float senzori[4];

char ssid[] = "SSID";
char wifiPassword[] = "PASS";

// Cayenne authentication info. This should be obtained from the Cayenne Dashboard.
char username[] = "";
char password[] = "";
char clientID[] = "";


void setup() {
	Serial.begin(112500);
	Cayenne.begin(username, password, clientID, ssid, wifiPassword);
  Serial.println("MAC adresa: " + String(WiFi.macAddress()));
  sensors.begin();
}

void loop() {
	Cayenne.loop();
}

// CAYENNE_OUT(1) for sending channel 1 data.
CAYENNE_OUT_DEFAULT()
{
	Cayenne.virtualWrite(0, millis()); // probno, power on timer
  sensors.requestTemperatures(); 
  for(int i = 0; i < 3; i++){
  Serial.print("\t" + String (i+1) + ". senzor: ");
  senzori[i]=sensors.getTempCByIndex(i);
  Serial.print(senzori[i]);
  Cayenne.celsiusWrite(i+1, senzori[i]);
  }
  Serial.println();
}

// CAYENNE_IN(1) for channel 1 commands.
CAYENNE_IN_DEFAULT()
{
	CAYENNE_LOG("Channel %u, value %s", request.channel, getValue.asString());
	//Process message here. If there is an error set an error message using getValue.setError(), e.g getValue.setError("Error message");
}
