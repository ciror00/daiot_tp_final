import gc
import machine
import ubinascii
import ujson
import time

from libs.bmp280 import BMP280

client_id = ubinascii.hexlify(machine.unique_id())

SDA = 21
SCL = 22