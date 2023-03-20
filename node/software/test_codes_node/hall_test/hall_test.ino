void setup() {
  pinMode(17, INPUT_PULLUP); //gpio 17 ulaz senzora
  pinMode(16, OUTPUT); //gpio 16 napajanje senzora
  Serial.begin(115200);
}

void loop() {
  digitalWrite(16, HIGH);
  delay(100);
  Serial.println(digitalRead(17)); 
  digitalWrite(16, LOW);
  delay(100);
}
