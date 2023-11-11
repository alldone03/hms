#include <Wire.h>
#include <LiquidCrystal_I2C.h>
#include <Adafruit_ADS1X15.h>
#include <OneWire.h>
#include <DallasTemperature.h>
#include <WiFiManager.h>
#include <HTTPClient.h>
#include <WiFi.h>

float calibrationFactor = 75.865;

class ard {
private:
  int pinup, pindown;

public:
  int statephup, statephdown, statephmode, stateflagphdown, stateflagphup;
  float BatasBawah, BatasAtas;
  uint32_t last_millis;

  ard(float dataBatasBawah, float dataBatasAtas, int pinup, int pindown) {
    BatasBawah = dataBatasAtas;
    BatasAtas = dataBatasBawah;
    pinup = pinup;
    pindown = pindown;
  }

  void CheckRangeSensor(float ketinggian) {

    if (millis() - last_millis < 500) {
      if (statephup) {
        digitalWrite(pinup, 1);
      } else {
        digitalWrite(pinup, 0);
      }
      if (statephdown) {
        digitalWrite(pindown, 1);
      } else {
        digitalWrite(pindown, 0);
      }
    } else {
      digitalWrite(pinup, 0);
      digitalWrite(pindown, 0);
    }
    if (millis() - last_millis > 10000) {
      last_millis = millis();
    }
    if (statephmode == 0) {
      if (ketinggian >= BatasAtas) {
        statephup = 0;
        statephdown = statephmode = stateflagphdown = 1;
      } else if (ketinggian <= BatasBawah) {
        statephdown = 0;
        statephup = statephmode = stateflagphup = 1;
      } else {
        statephup = statephdown = 0;
      }
    } else {
      if (ketinggian > (BatasAtas + BatasBawah) / 2 && stateflagphup == 1) {
        statephup = statephdown = statephmode = stateflagphup = 0;
      } else if (ketinggian < (BatasAtas + BatasBawah) / 2 && stateflagphdown == 1) {
        statephup = statephdown = statephmode = stateflagphdown = 0;
      }
    }
  }
};
/*
Pin Setup
*/
#define trig 32
#define echo 33
#define suhu 26
#define buzzer 27
#define ledesp 2
#define sdapin 21
#define sclpin 22

// const int relay[6] = { 13, 5, 17, 16, 18, 19 };
// const int relay[6] = { 13, 4, 17, 16, 18, 19 };
const int relay[6] = { 13, 4, 16, 17, 18, 19 };
// const int relay[6] = { 4, 19, 17, 16, 18, 13 };



enum accRelay {
  PH_UP,
  PH_DOWN,
  UP_A,
  UP_B,
  Distribusi_Air,
  Pompa,
};
int datarelay[6];
// const String host = "http://ip.jsontest.com/?callback=showMyIP";
// const String host = "http://hysage.wroindonesia.org";
const String host = "http://192.168.225.110:8001";
const String namedevice = "device1";  // Nama Device
const int updateSetiap = 500;         // update ke server setiap satuan milisecond


/*
-------------------
*/

uint8_t Auto_state = 1;
unsigned long last_millis, millis_1min, millis_3sec;

LiquidCrystal_I2C lcd(0x27, 16, 2);
Adafruit_ADS1115 ads;
OneWire oneWire(suhu);
DallasTemperature sensorTemp(&oneWire);
WiFiManager wm;

ard checksensorTinggiAir(30.0, 40.0, relay[Pompa], relay[Pompa]);
ard checksensorPH(5.0, 8.0, relay[PH_UP], relay[PH_DOWN]);


void WiFiEvent(WiFiEvent_t event) {
  if (event == WIFI_PROV_STA_DISCONNECTED) {
    WiFi.reconnect();
  }
}

void setup() {
  WiFi.mode(WIFI_STA);
  Serial.begin(9600);
  lcd.begin();
  sensorTemp.begin();
  lcd.setCursor(5, 0);
  lcd.print("HySage");
  lcd.setCursor(3, 1);
  lcd.print("Hidroponik");

  digitalWrite(ledesp, 0);
  for (uint8_t i = 0; i <= 6; i++) {
    pinMode(relay[i], OUTPUT);
    digitalWrite(relay[i], 1);
  }
  pinMode(trig, OUTPUT);
  pinMode(buzzer, OUTPUT);
  pinMode(ledesp, OUTPUT);
  pinMode(echo, INPUT);
  pinMode(0, INPUT);


  if (digitalRead(0) == 0) {
    wm.resetSettings();
    for (uint8_t i = 0; i < 4; i++) {
      digitalWrite(buzzer, 1);
      digitalWrite(ledesp, 1);
      delay(200);
      digitalWrite(buzzer, 0);
      digitalWrite(ledesp, 0);
      delay(200);
    }
  }
  bool res = wm.autoConnect("HySage", "12345678");
  if (!res) {
    Serial.println("Failed to Connect");
    ESP.restart();
  } else {
    String ssid = wm.getWiFiSSID();
    Serial.println("SSID yang terhubung: " + ssid);
    WiFi.onEvent(WiFiEvent);
  }
  for (uint8_t i = 0; i < 2; i++) {
    digitalWrite(buzzer, 1);
    digitalWrite(ledesp, 1);
    delay(100);
    digitalWrite(buzzer, 0);
    digitalWrite(ledesp, 0);
    delay(100);
  }
  if (!ads.begin()) {
    Serial.println("Failed to initialize ADS.");
    while (1)
      ;
  }
  lcd.clear();
}
void xloop() {
  bacaPH();

  delay(2000);
}

void loop() {

  // koding kirim data

  if (millis() - last_millis >= updateSetiap) {
    // Serial.print(".");
    for (uint8_t i = 0; i < 6; i++) {

      datarelay[i] = !digitalRead(relay[i]);
      // Serial.print(datarelay[i]);
    }
    // Serial.println("");
    last_millis = millis();
    HTTPClient http;
    Serial.println(host + "/logdevice?nama_device=device1&relaystate_1=" + String(datarelay[0]) + "&relaystate_2=" + String(datarelay[1]) + "&relaystate_3=" + String(datarelay[2]) + "&relaystate_4=" + String(datarelay[3]) + "&relaystate_5=" + String(datarelay[4]) + "&relaystate_6=" + String(datarelay[5]) + "&suhu=" + String(bacaSUHU()) + "&ph=" + String(bacaPH()) + "&tds=" + String(bacaTDS()) + "&ketinggian_air=" + String(bacaKetinggianAir()));
    http.begin(host + "/logdevice?nama_device=device1&relaystate_1=" + String(datarelay[0]) + "&relaystate_2=" + String(datarelay[1]) + "&relaystate_3=" + String(datarelay[2]) + "&relaystate_4=" + String(datarelay[3]) + "&relaystate_5=" + String(datarelay[4]) + "&relaystate_6=" + String(datarelay[5]) + "&suhu=" + String(bacaSUHU()) + "&ph=" + String(bacaPH()) + "&tds=" + String(bacaTDS()) + "&ketinggian_air=" + String(bacaKetinggianAir()));

    int httpCode = http.GET();
    if (httpCode > 0) {
      digitalWrite(ledesp, 1);
      String payload = http.getString();

      for (uint8_t i = 7; i >= 1; i--)
        if (i == 1) {

          // Serial.println((String)i + ":u" + (String)payload.substring(i, i + 1).toInt());
          Auto_state = payload.substring(i, i + 1).toInt();
        } else if (i > 1 && Auto_state == 0) {
          // Serial.println(payload);
          digitalWrite(relay[i - 2], !payload.substring(i, i + 1).toInt());
          // Serial.println((String)relay[i - 2] + ":" + (String)payload.substring(i, i + 1).toInt());
        }
    } else {
      Serial.println("Error: " + httpCode);
      digitalWrite(ledesp, 0);
    }

    // Serial.println(Auto_state);
    http.end();
  }
  //------------------------------------
  // Check Every 1 mnt if auto on cairan larut kemudian akan di cek kembali setiap 1 menit
  // Lama dari pompa menyala 3 detik dan menyimpan posisi menunggu check kembali

  //setiap pengecekan dilakukan setiap 2 detik untuk data
  //setelah pengecekan 1 menit pengecekan ini untuk mengendalikan pompa

  //0100101
  //koding mengendalikan pompa
  if (Auto_state == 1) {
    int tinggiair = bacaKetinggianAir();
    int phAir = bacaPH();
    checksensorTinggiAir.CheckRangeSensor(tinggiair);
    checksensorPH.CheckRangeSensor(phAir);
  }
  // if (millis() - millis_1min > 60000 && Auto_state == 1) {
  //   millis_1min = millis();
  //   // check keadaan + Ubah Logic
  //   int tinggiair = bacaKetinggianAir();
  //   int phAir = bacaPH();
  //   checksensorTinggiAir.CheckRangeSensor(tinggiair);
  //   checksensorPH.CheckRangeSensor(phAir);
  // }
  // //---------------------------------
  // if (Auto_state == 1) {
  //   checksensorPH.motorActiveCheckDown(relay[PH_DOWN]);
  //   checksensorPH.motorActiveCheckUp(relay[PH_UP]);
  // }
  // // kendalikan pompa 3 detik
}
