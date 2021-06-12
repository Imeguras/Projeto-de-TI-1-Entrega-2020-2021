import sys
from time import sleep

try:
    print("Use o Ctrl+C para interromper o programa")
    while True:
        print("Hi!")
        sleep(5)
except KeyboardInterrupt:
    print("Programa terminado")
finally:
    print("Fim do programa")
