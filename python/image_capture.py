import cv2 as cv
import time
import requests

def send_file():
    files = {'imagem': open('webcam.jpg', 'rb')}
    r = requests.post('http://127.0.0.1/ti/upload.php', files=files)
    print(r.status_code, r.text)

def image_capture():

    try:
        cv.VideoCapture(0)
    except:
        camera = cv.VideoCapture("http://10.20.229.19:4747/video")
    ret, image = camera.read()
    cv.imwrite('webcam.jpg', image)
    camera.release()
    cv.destroyAllWindows()
    

try:
    while True:
        r=requests.get('http://127.0.0.1/ti/api/api.php?nome=botao')
        status = r.status_code
        if status == 200:
            value = float(r._content)
            if value > 20.0:
                image_capture()
                send_file()
            else:
                pass
        else:
            print("Erro ao ler do servidor")
        time.sleep(5)
except:
    print("Leaving...")

#img = cv.imread('opencv_image.png', 0)
#cv.imshow('Imagem', img)
#hile cv.waitKey(0) == ord('s'):
#   cv.imwrite('opencv_image_gray.png', img)
#   cv.destroyAllWindows()

