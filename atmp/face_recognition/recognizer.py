import cv2, json, sys
import numpy as np

faceDetect = cv2.CascadeClassifier('C:\\xampp\\htdocs\\atmp\\face_recognition\\haarcascade_frontalface_default.xml')
cam = cv2.VideoCapture(0)

recognizer = cv2.createLBPHFaceRecognizer()
recognizer.load('C:\\xampp\\htdocs\\atmp\\face_recognition\\recognizer\\training_data.yml')

font = cv2.cv.InitFont(cv2.cv.CV_FONT_HERSHEY_COMPLEX_SMALL, 3, 1, 0, 2)

Id = int(sys.argv[1])
i = 1
result = 0

while (True):
    ret, img = cam.read()
    grayImg = cv2.cvtColor(img, cv2.COLOR_BGR2GRAY)

    faces = faceDetect.detectMultiScale(grayImg, 1.3, 5)
    for (x, y, w, h) in faces:
        userId, conf = recognizer.predict(grayImg[y : y + h, x : x + w])
        cv2.rectangle(img, (x, y), (x + w, y + h), (0, 255, 0), 2)
        
        userId = int(userId)
        conf = float(str(conf))

        if(Id == userId):
            x = (100 - conf) / 100
            result += x
        else:
            result -= 1
        #print("step: ", i ," result: ", result)
        i += 1
        cv2.waitKey(300)
        
    cv2.imshow("Camera", img)

    if(i > 10):
        break
    if (cv2.waitKey(1) == ord('q')):
        break

cam.release()
cv2.destroyAllWindows()

if(result > 4):
    result = "yes"
else:
    result = "no"

result = json.dumps(result)
result = str(result)
print result