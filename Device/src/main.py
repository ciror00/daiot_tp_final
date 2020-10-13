from utils.configuration import Configuration
from utils.network_admin import NetworkAdmin
from utils.mqtt_handler import MqttHandler

global SDA, SCL
global client_id

'''
    Configuracion Global
'''
cfg = Configuration(prod=False)
led = machine.Pin(2, machine.Pin.OUT)

'''
    Configuracion de Wifi
'''
wifi = NetworkAdmin(cfg.get_ssid(), cfg.get_wifi_password())
wifi.do_connect()

'''
    Configuracion de Broker
'''
broker = MqttHandler(cfg.get_broker(), cfg.get_broker_user(), cfg.get_broker_password(), cfg.get_topic_sub(), cfg.get_topic_pub())

'''
    Configuracion del puerto I2C y el sensor
'''
bus = machine.I2C(sda=machine.Pin(SDA), scl=machine.Pin(SCL))
print(bus.scan())

sensor = BMP280(bus)

while True:
    led.value(1)
    temp = sensor.temperature
    press = sensor.pressure/100
    hum = 0
    print('Temperatura: %s | Presion: %s | Humedad: %s' % (temp, press, hum))

    '''
        Armado de JSON
    '''

    json = {"temperature": "", "pressure": "", "humidity": "", "uuid": ""}
    json["uuid"] = str(client_id)[2:13]
    json["temperature"] = temp
    json["pressure"] = press
    json["humidity"] = hum
    print(json)

    '''
        Envio de datos
    '''
    topic_route = cfg.get_topic_pub()
    print(topic_route)
    broker.publish(topic_route, str(json))

    print('Ciclo terminado')
    led.value(0)
    #break
    time.sleep(cfg.get_interval())