




from telebot import *
from telebot.async_telebot import AsyncTeleBot


import mysql.connector


#Connet to your db
HOST = "localhost"
USER = "root"
PASSWORD = ""
DATABASE = "safar_uz"

import datetime

x = datetime.datetime.now()
# print(x)


def end_date():
    mydb = mysql.connector.connect(
		host=HOST,
		user=USER,
		password=PASSWORD,
		database=DATABASE
    )
    isindb = mydb.cursor()
    isindb.execute("SELECT end_date FROM bravo_bookings")
    telegram_db = isindb.fetchall()
    mydb.commit()

    for id_from_db in telegram_db :
        year = str(id_from_db[0]).split("-")[0]
        month = str(id_from_db[0]).split("-")[1]
        day = str(id_from_db[0]).split("-")[2]
        print(day,month,day)

def select_user_id(customer_id):
    mydb = mysql.connector.connect(
        host=HOST,
        user=USER,
        password=PASSWORD,
        database=DATABASE
        )
    telegram_id = mydb.cursor()
    telegram_id.execute("SELECT telegram_id FROM users WHERE id = " + str(customer_id) )
    telegram_id = telegram_id.fetchone()

    mydb.commit()
    return  telegram_id[0]
  



def select_booking():
    mydb = mysql.connector.connect(
        host=HOST,
        user=USER,
        password=PASSWORD,
        database=DATABASE
        )
    customer_id = mydb.cursor()
    customer_id.execute("SELECT customer_id FROM bravo_bookings WHERE is_send = 0 " )
    customer_id = customer_id.fetchall()

    mydb.commit()
    for i in customer_id:
      try:
        return select_user_id(i[0])
      except:
        continue

print(select_booking())



