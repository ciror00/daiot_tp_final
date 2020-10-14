import network

class NetworkAdmin():
    def __init__(self, ssid, passw):
        self._ssid = ssid
        self._passw = passw
        self.sta_if = network.WLAN(network.STA_IF)

    def do_connect(self):
        if not self.sta_if.isconnected():
            print('connecting to network...')
            self.sta_if.active(True)
            self.sta_if.connect(self._ssid, self._passw)
            while not self.sta_if.isconnected():
                pass
        print('network config:', self.sta_if.ifconfig()) 