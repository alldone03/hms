float readVoltageADS(int channel) {
  return ads.computeVolts(ads.readADC_SingleEnded(channel));
}


float bacaPH() {
  // float voltage = readVoltageADS(1);
  float voltage = random(1, 14) / 100.0;
  return voltage;
}
int bacaTDS() {
  // float voltage = readVoltageADS(0);
  float voltage = random(1, 1000);
  return voltage;
}
float bacaSUHU() {

  // sensorTemp.requestTemperatures();
  // return sensorTemp.getTempCByIndex(0);
  float voltage = random(1, 50) / 100.0;
  return voltage;
}
int bacaKetinggianAir() {
  digitalWrite(trig, LOW);
  delayMicroseconds(5);
  digitalWrite(trig, HIGH);
  delayMicroseconds(10);
  digitalWrite(trig, LOW);
  long duration = pulseIn(echo, HIGH);
  return duration * 0.034 / 2;
  // float voltage = random(1, 50);
  // return voltage;
}
