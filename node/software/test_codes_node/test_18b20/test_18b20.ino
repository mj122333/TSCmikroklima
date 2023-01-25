//kod za testiranje senzora 18b20

#include <OneWire.h>
#include <DallasTemperature.h>

#define ONE_WIRE_BUS 13

OneWire oneWire(ONE_WIRE_BUS);
DallasTemperature sensors(&oneWire);

float senzori[4];

void setup(void)
{
  Serial.begin(112500);
  sensors.begin();
}

void loop(void){ 
  // Call sensors.requestTemperatures() to issue a global temperature and Requests to all devices on the bus
  sensors.requestTemperatures(); 

  for(int i = 0; i < 3; i++){
  Serial.print("\t" + String (i+1) + ". senzor: ");
  senzori[i]=sensors.getTempCByIndex(i);
  Serial.print(senzori[i]);
  }
  Serial.println();
  delay(1000);
}
