#include <Wire.h>
#include <LiquidCrystal_I2C.h>
#include <Adafruit_ADS1X15.h>
#include <OneWire.h>
#include <DallasTemperature.h>
#include <WiFiManager.h>
#include <HTTPClient.h>
#include <WiFi.h>
/*
Pin Setup
*/
#define trig 32
#define echo 33
#define suhu 26
#define buzzer 27
#define ledesp 2
const int relay[6] = { 13, 4, 17, 16, 18, 19 };
const String host = "http://ip.jsontest.com/?callback=showMyIP";
const String namedevice = "device1";  // Nama Device
const int updateSetiap = 3000;        // update ke server setiap satuan milisecond

/*
-------------------
*/


unsigned long last_millis;

LiquidCrystal_I2C lcd(0x27, 16, 2);
Adafruit_ADS1115 ads;
OneWire oneWire(suhu);
DallasTemperature sensorTemp(&oneWire);
WiFiManager wm;

void WiFiEvent(WiFiEvent_t event) {
  if (event == WIFI_PROV_STA_DISCONNECTED) {
    WiFi.reconnect();
  }
}

void setup() {
  WiFi.mode(WIFI_STA);
  Serial.begin(9600);

  digitalWrite(ledesp, 0);
  for (int i; i <= 6; i++) {
    pinMode(relay[i], OUTPUT);
    digitalWrite(relay[i], 0);
  }
  pinMode(trig, OUTPUT);
  pinMode(buzzer, OUTPUT);
  pinMode(ledesp, OUTPUT);
  pinMode(echo, INPUT);

  // if (!ads.begin()) {
  //   Serial.println("Failed to initialize ADS.");
  //   while (1)
  //     ;
  // }


  // wm.resetSettings();
  bool res = wm.autoConnect("HySage", "12345678");
  if (!res) {
    Serial.println("Failed to Connect");
    ESP.restart();
  } else {
    String ssid = wm.getWiFiSSID();
    Serial.println("SSID yang terhubung: " + ssid);
    WiFi.onEvent(WiFiEvent);
  }
  for (int i = 0; i < 2; i++) {
    digitalWrite(buzzer, 1);
    delay(200);
    digitalWrite(buzzer, 0);
    delay(200);
  }

  digitalWrite(ledesp, 1);
}


void loop() {
  if (millis() - last_millis >= updateSetiap) {
    last_millis = millis();
    HTTPClient http;
    http.begin(host + "");
    
    int httpCode = http.GET();
    if (httpCode > 0) {
      String payload = http.getString();
      Serial.println(payload);
    } else {
      Serial.println("Error: " + httpCode);
    }
    http.end();
  }
}
