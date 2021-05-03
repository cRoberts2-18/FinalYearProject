#! /usr/bin/python3
import mysql.connector as mysql
import pandas as pd
import numpy
import firebase_admin
import time
from firebase_admin import credentials, firestore
import datetime


HOST = "localhost"
DATABASE = "Weather"
USER = "phpmyadmin"
PASSWORD = "123123"
db_connection = mysql.connect(host=HOST, port = 3306, database=DATABASE, user=USER, password=PASSWORD)
print("Connected to:", db_connection.get_server_info())

cred = credentials.Certificate("1234/pisensor-36470-firebase-adminsdk-2wl8o-986e0f0216.json")
firebase_admin.initialize_app(cred,
{
"databaseURL" : "https://PiSensor.firebaseio.com/"
})

db = firestore.client()
docs = db.collection(u"Readings").stream()

for doc in docs:
        record = doc.to_dict()
        if record.get(" Rain")<=145:
                rain="Yes"
        else:
                rain="No"
        values= [record.get(" Reading Time"), record.get("Temperature"),record.get(" Max Temperature"),record.get(" Min Temperature"),rain]
        if int(record.get(" Max Temperature"))!=0 and int(record.get(" Min Temperature"))!=999 and int(record.get(" Max Temperature"))<=100 and int(record.get(" Min Temperature"))>=-20:
                mycursor = db_connection.cursor()
                sql = "INSERT IGNORE INTO `Readings`(`Date`, `Temperature`, `Max Temp`, `Min Temp`, `Rain`) VALUES (%s,%s,%s,%s,%s)"
                mycursor.execute(sql, values)
                db_connection.commit()
                if mycursor.rowcount != 0:
                        print(mycursor.rowcount, "record inserted.")

time.sleep(60)
