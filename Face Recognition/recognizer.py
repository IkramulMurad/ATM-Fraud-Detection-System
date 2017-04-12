import cv2
import numpy as np
import sqlite3

faceDetect = cv2.CascadeClassifier('haarcascade_frontalface_default.xml')
cam = cv2.VideoCapture(0)

recognizer = cv2.createLBPHFaceRecognizer()
recognizer.load('recognizer/training_data.yml')

font = cv2.cv.InitFont(cv2.cv.CV_FONT_HERSHEY_COMPLEX_SMALL, 3, 1, 0, 2)

def getProfile(Id):
    con = sqlite3.connect("FaceBase.db")

    query = "select * from People where id = " + str(Id)
    rows = con.execute(query)

    profile = None
    for row in rows:
        profile = row

    con.close()
    return profile

while (True):
    ret, img = cam.read()
    grayImg = cv2.cvtColor(img, cv2.COLOR_BGR2GRAY)

    faces = faceDetect.detectMultiScale(grayImg, 1.3, 5)
    for (x, y, w, h) in faces:
        userId, conf = recognizer.predict(grayImg[y : y + h, x : x + w])
        cv2.rectangle(img, (x, y), (x + w, y + h), (0, 255, 0), 2)

        profile = getProfile(userId)

        if (profile != None):
            cv2.cv.PutText(cv2.cv.fromarray(img), str(profile[0]), (x, y + h + 30), font, 255)
            cv2.cv.PutText(cv2.cv.fromarray(img), str(profile[1]), (x, y + h + 60), font, 255)
            cv2.cv.PutText(cv2.cv.fromarray(img), str(conf), (x, y + h + 90), font, 255)
        
    cv2.imshow("Camera", img)

    if (cv2.waitKey(1) == ord('q')):
        break

cam.release()
cv2.destroyAllWindows()
