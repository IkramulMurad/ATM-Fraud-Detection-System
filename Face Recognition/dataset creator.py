import cv2
import numpy as np
import sqlite3

faceDetect = cv2.CascadeClassifier('haarcascade_frontalface_default.xml')
cam = cv2.VideoCapture(0)

def insertOrUpdate(Id, name):
    con = sqlite3.connect("FaceBase.db")

    query = "select * from people where id = " + str(Id)
    rows = con.execute(query)

    isExist = 0
    for row in rows:
        isExist = 1
        break

    if (isExist == 1):
        query = "update People set name = " + str(name) + " where id = " + str(Id)
    else:
        query = "insert into People (id, name) values (" + str(Id) + ", " + str(name) + ")"

    con.execute(query)
    con.commit()
    con.close()
    

Id = raw_input("Enter client account no: ")
name = raw_input("Enter client name: ")
insertOrUpdate(Id, name)

i = 1

while (True):
    ret, img = cam.read()
    grayImg = cv2.cvtColor(img, cv2.COLOR_BGR2GRAY)
    faces = faceDetect.detectMultiScale(grayImg, 1.3, 5)
    
    for (x, y, w, h) in faces:
        cv2.imwrite("dataset/user_" + str(Id) + "_" + str(i) + ".jpg", grayImg[y : y + h, x : x + w])
        cv2.rectangle(img, (x, y), (x + w, y + h), (0, 255, 0), 2)
        i += 1
        cv2.waitKey(500)

    cv2.imshow("Camera", img)
    cv2.waitKey(1)

    if (i > 20):
        break

cam.release()
cv2.destroyAllWindows()
