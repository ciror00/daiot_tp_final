from utils.configuration import Configuration
from utils.network_admin import NetworkAdmin
from utils.mqtt_handler import MqttHandler

global SDA, SCL
global client_id

'''
    Configuracion Global
'''
cfg = Configuration(prod=False)

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
#sensor.oversample_sett = 2
#sensor.baseline = 101325

while True:
    temp = sensor.temperature
    press = sensor.pressure/100
    hum = 0
    print('Temperatura: %s | Presion: %s | Humedad: %s' % (temp, p, altitude))

    '''
        Armado de JSON
    '''

    json = {"device-id": "", "temperature": "", "pressure": "", "altitude": ""}
    json['device-id'] = client_id
    json['temperature'] = temp
    json['pressure'] = press
    json['humidity'] = hum
    print(json)

    '''
        Envio de datos
    '''
    broker.publish(cfg.get_topic_pub(), json)

    time.sleep(cfg.get_interval())