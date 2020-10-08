import gc
import machine
import ubinascii
import ujson
import time

from bmp180 import BMP180

client_id = ubinascii.hexlify(machine.unique_id())

SDA = 21
SCL = 22

'''
    Configuracion Global
'''
cfg = Configuration(prod=False)