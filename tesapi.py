import requests
import random
import time



while True:
    suhu = random.uniform(10.5, 75.5)
    ph = random.uniform(5.5, 8.5)
    tds = random.uniform(100, 500)
    ketinggian_air = random.uniform(10, 50)
    response = requests.get("http://127.0.0.1:8001/logdevice?nama_device=device1&relaystate_1=0&relaystate_2=0&relaystate_3=0&relaystate_4=0&relaystate_5=0&relaystate_6=0&suhu="+str(suhu)+"&ph="+str(ph)+"&tds="+str(tds)+"&ketinggian_air="+str(ketinggian_air))
    print(response.json())
    time.sleep(1)
