global SDA, SCL
global client_id

'''
    Configuracion de Wifi
'''
wifi = NetworkAdmin(cfg.get_ssid(), cfg.get_wifi_password())

'''
    Configuracion de Broker
'''
broker = MqttHandler(cfg.get_broker(), cfg.get_broker_user(), cfg.get_broker_password())

'''
    Configuracion del puerto I2C
'''
i2c = machine.I2C(sda=machine.Pin(SDA),scl=machine.Pin(SCL))
sensor = BMP180(i2c)
sensor.oversample_sett = 2
sensor.baseline = 101325

while True:
    temp = sensor.temperature
    press = sensor.pressure
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