void setup() {
  pinMode(13, INPUT); //obican INPUT, internalni pullup je prevelikog otpora
  Serial.begin(115200);
}

void loop() {
  Serial.println(analogRead(13)); //analog testno, digital poslje
  delay(100);
}
