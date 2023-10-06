float readVoltageADS(int channel) {
  return ads.computeVolts(ads.readADC_SingleEnded(channel));
}


float bacaPH() {
  float voltage = readVoltageADS(1);
  return voltage;
}
int bacaTDS() {
  float voltage = readVoltageADS(0);
  return voltage;
}
float bacaSUHU() {
  sensorTemp.requestTemperatures();
  return sensorTemp.getTempCByIndex(0);
}
int ketinggianAir() {
  digitalWrite(trig, LOW);
  delayMicroseconds(5);
  digitalWrite(trig, HIGH);
  delayMicroseconds(10);
  digitalWrite(trig, LOW);
  long duration = pulseIn(echo, HIGH);
  return duration * 0.034 / 2;
}

