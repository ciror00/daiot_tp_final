import utime
import ubinascii
from machine import unique_id
from libs.umqttsimple import MQTTClient
from utils.logger import logger


class MqttHandler:
    def __init__(self, server, user, passw):
        self._mqtt_server = server
        self._user = user
        self._password = passw
        self._topic_sub = topic_sub
        self._topic_pub = topic_pub
        self._client_id = ubinascii.hexlify(unique_id())

        self.client = self.connect_and_subscribe()

    # Función callback
    def sub_cb(self, topic, msg):
        try:
            print((topic, msg))
            if topic == b'notification' and msg == b'received':
                print('ESP received hello message')

        except Exception as err:
            raise err

    # Conectar y suscribirse
    def connect_and_subscribe(self):
        client = MQTTClient(client_id = self._client_id, server=self., port=0, user=self._user, password=self._password)
        client.set_callback(self.sub_cb)
        client.connect()

        # Suscripción al tópico
        client.subscribe(topic_sub)
        message = "Connected to {} MQTT broker, subscribed to {} topic"
        print(message.format(self.mqtt_server, topic_sub))

        return client

    # Restart conexión
    def restart_and_reconnect(self):
        logger("Failed to connect to MQTT broker. Reconnecting...", "warning")
        utime.sleep(10)
        machine.reset()

    def publish(self, topic_pub, msg=None):
        self.client.publish(topic_pub, msg)
