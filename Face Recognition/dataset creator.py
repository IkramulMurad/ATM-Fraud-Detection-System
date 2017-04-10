import cv2
import numpy as np

faceDetect = cv2.CascadeClassifier('haarcascade_frontalface_default.xml')
cam = cv2.VideoCapture(0)

name = raw_input("Enter client name: ")
i = 1

while (True):
    ret, img = cam.read()
    grayImg = cv2.cvtColor(img, cv2.COLOR_BGR2GRAY)
    faces = faceDetect.detectMultiScale(grayImg, 1.3, 5)
    
    for (x, y, w, h) in faces:
        cv2.imwrite("dataset/user_" + str(name) + "_" + str(i) + ".jpg", grayImg[y : y + h, x : x + w])
        cv2.rectangle(img, (x, y), (x + w, y + h), (0, 255, 0), 2)
        i += 1
        cv2.waitKey(300)

    cv2.imshow("Camera", img)
    cv2.waitKey(1)

    if (i == 10):
        break

cam.release()
cv2.destroyAllWindows()
