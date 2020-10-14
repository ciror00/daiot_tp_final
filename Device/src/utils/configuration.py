import ujson

class Configuration:
    def __init__(self, prod):
        if(prod):
            file_path = './config.json'
        else:
            #f = open('./dev.json', 'w')
            #f.write('{"network": {"ssid": "","password": ""},"mqtt": {"broker": "","user": "","password": "","topic_pub": "","topic_sub": ""},"parameters": {"interval": 30},"model": ""}')
            #f.close()
            file_path = './dev.json'
        # *Cargar el archivo json:
        try:
            with open(file_path) as config_file:
                self.config = ujson.load(config_file)
        except OSError as err:
            print("No se puede abrir el archivo de configuracion: {}".format(err))
            # TODO: Cargar configuracion por defecto si el archivo falla

    def get_ssid(self):
        return self.config["network"]["ssid"]

    def get_wifi_password(self):
        return self.config["network"]["password"]

    def get_broker(self):
        return self.config["mqtt"]["broker"]

    def get_broker_user(self):
        return self.config["mqtt"]["user"]

    def get_broker_password(self):
        return self.config["mqtt"]["password"]

    def get_topic_sub(self):
        return self.config["mqtt"]["topic_sub"]

    def get_topic_pub(self):
        return self.config["mqtt"]["topic_pub"]

    def get_interval(self):
        return self.config["parameters"]["interval"]