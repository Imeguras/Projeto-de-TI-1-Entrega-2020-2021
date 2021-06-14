import cv2 as cv
import time
import requests

phoneip = "http://192.168.1.163:8080"

def send_status():
    val = {'tipo':'atuadores', 'nome':'camara', 'valor':'0'}
    r = requests.post('http://127.0.0.1/ProjetoTI/api/api.php', val)

def image_capture():
    try:
        camera = cv.VideoCapture(f"{phoneip}/video")
    except:
        camera = cv.VideoCapture(0)
    ret, image = camera.read()
    cv.imwrite('Ficheiros/Camara.jpg', image)
    camera.release()
    cv.destroyAllWindows()
    

try:
    while True:
        r=requests.get('http://127.0.0.1/ProjetoTI/api/api.php?tipo=atuadores&nome=camara')
        status = r.status_code
        if status == 200:
            value = int(r._content)
            if value == 1:
                image_capture()
                send_status()
            else:
                pass
        else:
            print("Erro ao ler do servidor")
        time.sleep(1)
except KeyboardInterrupt:
    print("Leaving...")

#img = cv.imread('opencv_image.png', 0)
#cv.imshow('Imagem', img)
#hile cv.waitKey(0) == ord('s'):
#   cv.imwrite('opencv_image_gray.png', img)
#   cv.destroyAllWindows()

