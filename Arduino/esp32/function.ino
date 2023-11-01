float readVoltageADS(int channel) {
  return ads.computeVolts(ads.readADC_SingleEnded(channel));
}


float bacaPH() {
  // float voltage = readVoltageADS(1);
  int sampleDuration = 1000;
  int sampleCount = 0;
  double y = 0;
  double rSquaredSum = 0;
  uint32_t startTime = millis();
  while ((millis() - startTime) < sampleDuration) {
    double RawCurrentIn = ads.readADC_SingleEnded(1) * (6.144f / (32768 >> 0));
    rSquaredSum += RawCurrentIn;
    sampleCount++;  
  }
  float voltage = (rSquaredSum / sampleCount);
  // y = (-7.1053 * voltage) + 37.844;
  if (voltage > 4.8) {
    y = 0.835416667 * voltage;
  } else {
    y = (-5.4258 * voltage) + 30.248  ;
  }

  lcd.setCursor(0, 0);
  lcd.print("Volt: ");
  lcd.print(voltage, 4);
  lcd.setCursor(0, 1);
  lcd.print("PH: ");
  lcd.print(y, 4);
  Serial.print("ADC:");
  Serial.print(ads.readADC_SingleEnded(1));
  Serial.print(" Volt:");
  Serial.println(voltage, 4);
  return voltage;
}


int bacaTDS() {
  float tdsvalue;
  int sampleDuration = 800;
  int sampleCount = 0;
  double rSquaredSum = 0;
  uint32_t startTime = millis();

  while ((millis() - startTime) < sampleDuration) {
    double RawCurrentIn = ads.readADC_SingleEnded(0) * (6.144f / (32768 >> 0));
    rSquaredSum += RawCurrentIn;
    sampleCount++;
  }
  float volt = (rSquaredSum / sampleCount);
  if (volt < 0)
    volt = 0;



  if (volt > 0.9) {
    tdsvalue = (volt * 607594.936708861)
               / 1000;
  } else {
    tdsvalue = (volt * 485000)
               / 1000;
  }

  if (tdsvalue < 0) {
    tdsvalue = 0;
  }
  // lcd.setCursor(0, 0);
  // lcd.print("Volt: ");
  // lcd.print(volt);
  // lcd.setCursor(0, 1);
  // lcd.print("TDS: ");
  // lcd.print(tdsvalue);

  // Serial.print("ADC:");
  // Serial.print(ads.readADC_SingleEnded(0));
  // Serial.print(" Volt:");
  // Serial.print(volt, 4);
  // Serial.print(" TDS:");
  // Serial.println(tdsvalue);
  return (int)tdsvalue;
}




float bacaSUHU() {

  sensorTemp.requestTemperatures();
  return sensorTemp.getTempCByIndex(0);
  // float voltage = random(1, 50) / 100.0;
  // return voltage;
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
