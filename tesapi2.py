import requests
import random
import time
import json

def convert_string_to_array(string):
  array = []
  for char in string:
    array.append(char)
  return array

relaydata=['0', '0', '0', '0', '0', '0', '0']
while True:
    suhu = random.uniform(10.5, 75.5)
    ph = random.uniform(5.5, 8.5)
    tds = random.uniform(100, 500)
    ketinggian_air = random.uniform(10, 50)
    response = requests.get("http://127.0.0.1:8001/logdevice?nama_device=device2&relaystate_1="+relaydata[1]+"&relaystate_2="+relaydata[2]+"&relaystate_3="+relaydata[3]+"&relaystate_4="+relaydata[4]+"&relaystate_5="+relaydata[5]+"&relaystate_6="+relaydata[6]+"&suhu="+str(suhu)+"&ph="+str(ph)+"&tds="+str(tds)+"&ketinggian_air="+str(ketinggian_air))

    relaydata = convert_string_to_array(response.json()['relaystate'])

    time.sleep(1)
