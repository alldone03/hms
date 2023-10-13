#include <Wire.h>
#include <LiquidCrystal_I2C.h>
#include <Adafruit_ADS1X15.h>
#include <OneWire.h>
#include <DallasTemperature.h>
#include <WiFiManager.h>
#include <HTTPClient.h>
#include <WiFi.h>
class ard {
public:
  int statephup, statephdown, statephmode, stateflagphdown, stateflagphup;
  float BatasBawah, BatasAtas;
  unsigned long millis_3secdown, millis_3secup;
  ard(float dataBatasBawah, float dataBatasAtas) {
    BatasBawah = dataBatasAtas;
    BatasAtas = dataBatasBawah;
  }

  void CheckRangeSensor(float tinggiAir) {
    if (statephmode == 0) {

      if (tinggiAir >= BatasAtas) {
        statephup = 0;
        statephdown = 1;
        statephmode = 1;
        stateflagphdown = 1;
        millis_3secdown = millis();
      } else if (tinggiAir <= BatasAtas) {
        statephup = 1;
        statephdown = 0;
        statephmode = 1;
        stateflagphup = 1;
        millis_3secup = millis();
      } else {
        statephup = 0;
        statephdown = 0;
      }
    } else {
      if (tinggiAir > (BatasAtas + BatasBawah) / 2 && stateflagphup == 1) {
        statephup = 0;
        statephdown = 0;
        statephmode = 0;
        stateflagphup = 0;
      } else if (tinggiAir < (BatasAtas + BatasBawah) / 2 && stateflagphdown == 1) {
        statephup = 0;
        statephdown = 0;
        statephmode = 0;
        stateflagphdown = 0;
      }
    }
  }
  void motorActiveCheckDown(uint8_t relay) {
    if (millis() - millis_3secdown < 3000 && stateflagphdown == 1) {
      digitalWrite(relay, 1);
    } else if (stateflagphdown == 0) {
      digitalWrite(relay, 0);
    }
  }
  void motorActiveCheckUp(uint8_t relay) {
    if (millis() - millis_3secup < 3000 && stateflagphup == 1) {
      digitalWrite(relay, 1);
    } else if (stateflagphup == 0) {
      digitalWrite(relay, 0);
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

const uint8_t relay[6] = { 13, 4, 17, 16, 18, 19 };
enum accRelay {
  PH_UP,
  PH_DOWN,
  UP_A,
  UP_B,
  Distribusi_Air,
  Pompa,
};
uint8_t datarelay[6];
// const String host = "http://ip.jsontest.com/?callback=showMyIP";
const String host = "http://10.17.35.208:8001";
const String namedevice = "device1";  // Nama Device
const int updateSetiap = 3000;        // update ke server setiap satuan milisecond


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

ard checksensorTinggiAir(30.0, 40.0);
ard checksensorPH(5.0, 8.0);


void WiFiEvent(WiFiEvent_t event) {
  if (event == WIFI_PROV_STA_DISCONNECTED) {
    WiFi.reconnect();
  }
}

void setup() {
  WiFi.mode(WIFI_STA);
  Serial.begin(9600);

  digitalWrite(ledesp, 0);
  for (uint8_t i = 0; i <= 6; i++) {
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
    delay(200);
    digitalWrite(buzzer, 0);
    delay(200);
  }

  digitalWrite(ledesp, 1);
}


void loop() {

  // koding kirim data
  if (millis() - last_millis >= updateSetiap) {

    for (uint8_t i = 0; i < 6; i++) {

      datarelay[i] = digitalRead(relay[i]);
    }
    last_millis = millis();
    HTTPClient http;
    Serial.println(host + "/logdevice?nama_device=device1&relaystate_1=" + String(datarelay[0]) + "&relaystate_2=" + String(datarelay[1]) + "&relaystate_3=" + String(datarelay[2]) + "&relaystate_4=" + String(datarelay[3]) + "&relaystate_5=" + String(datarelay[4]) + "&relaystate_6=" + String(datarelay[5]) + "&suhu=" + String(bacaSUHU()) + "&ph=" + String(bacaPH()) + "&tds=" + String(bacaTDS()) + "&ketinggian_air=" + String(bacaKetinggianAir()));
    http.begin(host + "/logdevice?nama_device=device1&relaystate_1=" + String(datarelay[0]) + "&relaystate_2=" + String(datarelay[1]) + "&relaystate_3=" + String(datarelay[2]) + "&relaystate_4=" + String(datarelay[3]) + "&relaystate_5=" + String(datarelay[4]) + "&relaystate_6=" + String(datarelay[5]) + "&suhu=" + String(bacaSUHU()) + "&ph=" + String(bacaPH()) + "&tds=" + String(bacaTDS()) + "&ketinggian_air=" + String(bacaKetinggianAir()));

    int httpCode = http.GET();
    if (httpCode > 0) {
      String payload = http.getString();
      Serial.println(payload);
      for (uint8_t i = 0; i < 7; i++)
        if (i > 0)
          digitalWrite(relay[i], payload.substring(i, i + 1).toInt());
        else if (Auto_state == 0)
          Auto_state = payload.substring(i, i + 1).toInt();
    } else {
      Serial.println("Error: " + httpCode);
    }
    http.end();
  }
  //------------------------------------
  // Check Every 1 mnt if auto on cairan larut kemudian akan di cek kembali setiap 1 menit
  // Lama dari pompa menyala 3 detik dan menyimpan posisi menunggu check kembali

  //setiap pengecekan dilakukan setiap 2 detik untuk data
  //setelah pengecekan 1 menit pengecekan ini untuk mengendalikan pompa


  //koding mengendalikan pompa
  if (millis() - millis_1min > 60000 && Auto_state == 1) {
    millis_1min = millis();
    // check keadaan + Ubah Logic
    int tinggiair = bacaKetinggianAir();
    int phAir = bacaPH();
    checksensorTinggiAir.CheckRangeSensor(tinggiair);
    checksensorPH.CheckRangeSensor(phAir);
  }
  //---------------------------------
  if (Auto_state != 1) {
    checksensorPH.motorActiveCheckDown(relay[PH_DOWN]);
    checksensorPH.motorActiveCheckUp(relay[PH_UP]);
  }
  // kendalikan pompa 3 detik
}
