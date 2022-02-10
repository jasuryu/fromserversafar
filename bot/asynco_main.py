#!/usr/bin/python

# This is a simple echo bot using the decorator mechanism.
# It echoes any incoming text messages.

from telebot import *
from telebot.async_telebot import AsyncTeleBot
#5038437541:AAHZHkYaa0XY2vl-Kdhe4_VYAHI5dzH2ySA
bot = AsyncTeleBot('2117975061:AAFdtaSlQDibyLi-tyb6HIhSgPfomJXBjZo')

import mysql.connector


#Connet to your db
HOST = "localhost"
USER = "root"
PASSWORD = ""
DATABASE = "safar_uz"

send = False

def set_langauage(user_id,language):
    mydb = mysql.connector.connect(
		host=HOST,
		user=USER,
		password=PASSWORD,
		database=DATABASE
		)
    isInTelegram = mydb.cursor()
    sql = "INSERT INTO telegram (user_id,language) VALUES(%s, %s)ON DUPLICATE KEY UPDATE  language = \" " + language +"\" "
    var = (user_id,language) 
    isInTelegram.execute(sql,var)

    
    mydb.commit()

def set_contact(user_id,contact):
    mydb = mysql.connector.connect(
		host=HOST,
		user=USER,
		password=PASSWORD,
		database=DATABASE
		)
    isInTelegram = mydb.cursor()
    sql = "UPDATE telegram SET phone_number = %s WHERE user_id = %s"
    var = (contact,user_id) 
    isInTelegram.execute(sql,var)

    
    mydb.commit()

    pass

def check_language(user_id):
    mydb = mysql.connector.connect(
        host=HOST,
        user=USER,
        password=PASSWORD,
        database=DATABASE
        )
    isInTelegram = mydb.cursor()
    isInTelegram.execute("SELECT language FROM telegram WHERE user_id = \" " + str(user_id) + " \" " )
    language = isInTelegram.fetchone()

    mydb.commit()

    if (language[0] == 'uz'):
        return 'uz'
    elif (language[0] == 'ru'):
        return 'ru'
    else:
        return 'ru'

def is_contact_in_db(user_id):
	mydb = mysql.connector.connect(
		host=HOST,
		user=USER,
		password=PASSWORD,
		database=DATABASE
		)
	isInTelegram = mydb.cursor()
	isInTelegram.execute("SELECT user_id FROM telegram")
	telegram_db = isInTelegram.fetchall()
	mydb.commit()
	
	for id_from_db in telegram_db :
		if (id_from_db[0] == user_id):		
			return True
	
	else:
		return False
		
def set_user_id_into_db(contact,user_id):
    mydb = mysql.connector.connect(
		host=HOST,
		user=USER,
		password=PASSWORD,
		database=DATABASE
		)
    set_id = mydb.cursor()
    sql = '''UPDATE users
    SET telegram_id = %s
    WHERE phone = %s;'''
    var = (user_id,contact) 
    set_id.execute(sql,var)

    
    mydb.commit()

    


    pass

def is_contact_authorized(contact,user_id):
    mydb = mysql.connector.connect(
        host=HOST,
        user=USER,
        password=PASSWORD,
        database=DATABASE
        )
    mycursor = mydb.cursor()
    mycursor.execute("SELECT phone FROM users")
    myresult = mycursor.fetchall()
    mydb.commit()
	#check from db contact
    for contact_in_db in myresult:
        original_contact = contact_in_db[0]
        # from errors
        try:
            #contact from db coverting to correct form (ex:998998457062)
            contact_in_db = contact_in_db[0]
            contact_in_db = contact_in_db.replace(' ', '')
            contact_in_db = contact_in_db.replace('+', '')
            pass
        except:
            pass

        #if in db 
        if (contact_in_db == contact):
            set_user_id_into_db(original_contact,user_id)
            return True
    return False





    pass




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


def select_customer_id(user_id):
    mydb = mysql.connector.connect(
        host=HOST,
        user=USER,
        password=PASSWORD,
        database=DATABASE
        )
    telegram_id = mydb.cursor()
    telegram_id.execute("SELECT id FROM users WHERE telegram_id = " + str(user_id) )
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

def change_to_sended(user_id):
    mydb = mysql.connector.connect(
        host=HOST,
        user=USER,
        password=PASSWORD,
        database=DATABASE
        )
    customer_id = mydb.cursor()
    customer_id.execute("UPDATE bravo_bookings SET is_send = 1 WHERE customer_id =  "  + str(select_customer_id(user_id)))
    mydb.commit()
  
def select_code(user_id):
    mydb = mysql.connector.connect(
        host=HOST,
        user=USER,
        password=PASSWORD,
        database=DATABASE
        )
    customer_id = mydb.cursor()
    customer_id.execute("SELECT code FROM bravo_bookings WHERE customer_id =  "  + str(select_customer_id(user_id)))
    customer_id = customer_id.fetchall()

    mydb.commit()
    for i in customer_id:
      try:
        return i[0]
      except:
        continue
    mydb.commit()
  


@bot.message_handler(commands=['send'])
async def send_message(message):
    await bot.send_message(message.chat.id,"<a href= \"https://safar.guru/login \">Send</a>" ,parse_mode="HTML")
    global send
    if (send == False):
        await bot.send_message(message.chat.id,"You turn on sending notices")
        await bot.send_message(481562551,"Someone turn on sending notices")
        send = True
        while send:
            try:
                user_id = select_booking()
                keyboard = types.InlineKeyboardMarkup()
                url_button = types.InlineKeyboardButton(text="Подробнее", url="http://newsafar.uz/booking/" +str(select_code(user_id)))
                keyboard.add(url_button)
                await bot.send_message(user_id,"Вы забонировали в <a href= \"https://safar.guru/login \">safar.guru</a>. ", reply_markup=keyboard,parse_mode="HTML")
                change_to_sended(user_id)
                
                time.sleep(1)
            except :
                
                time.sleep(1)




            pass
    else:
        await bot.send_message(message.chat.id,"You turn off sending notices")
        await bot.send_message(481562551,"Someone turn off sending notices")
        send = False
    



@bot.message_handler(commands=['start'])
async def echo_message(message):
    user_id = message.chat.id
    if is_contact_in_db(user_id): 
        if (check_language(user_id) == 'ru'):
            await bot.send_message(user_id,'Добро пожаловать  ' + message.chat.first_name)
        elif (check_language(user_id) == 'uz'):
            await bot.send_message(user_id,'Xush kelibsiz ' + message.chat.first_name)
		
	
    else:
        await bot.send_message(user_id,'Добро пожаловать ' + message.chat.first_name)
        ask_language = types.ReplyKeyboardMarkup()
        uz = types.KeyboardButton('O\'zbek tili')
        ru = types.KeyboardButton('Русский язык')
        ask_language.add(uz,ru)
        await bot.send_message(user_id,'Tilni tanlang/Выберите язык', reply_markup = ask_language)
        pass

@bot.message_handler(content_types=['text'])
async def text_message(message):
    user_id = message.chat.id
    if (message.text =='O\'zbek tili'):

        set_langauage(user_id,'uz')

        ask_contact = types.ReplyKeyboardMarkup()
        button_send_contact = types.KeyboardButton('Kontaktni yuboring',request_contact=True)
        ask_contact.add(button_send_contact)
        await bot.send_message(user_id,'Kontaktni yuborish uchun tugmani bosing', reply_markup = ask_contact)
    elif (message.text =='Русский язык'):

        set_langauage(user_id,'ru')

        ask_contact = types.ReplyKeyboardMarkup()
        button_send_contact = types.KeyboardButton('Отправить контакт',request_contact=True)
        ask_contact.add(button_send_contact)
        await bot.send_message(user_id,'Нажми на кнопку, чтобы отправить контакт', reply_markup = ask_contact)

@bot.message_handler(content_types=['contact'])
async def contact_handler(message):

    #contact coverting to correct form (ex:998998457062)
    contact = str(message.contact.phone_number)
    contact = contact.replace(' ', '')
    contact = contact.replace('+', '')
	#user id
    user_id = message.chat.id
    if (check_language(user_id) =='uz') :
        if is_contact_authorized(contact,user_id):
            set_contact(user_id,contact)
            await bot.send_message(message.chat.id,"<a href= \"https://safar.guru/login \">Raxmat</a>" ,parse_mode="HTML")
            pass
        else :
            await bot.send_message(message.chat.id,"<a href=\"https://safar.guru/login\">Avval bizning veb-saytimizda ro\'yxatdan o\'ting</a>" ,parse_mode="HTML")
            await bot.send_message(message.chat.id,"<a href= \"https://safar.guru/login \">Safar.guru</a>" ,parse_mode="HTML")
            pass
        pass

    elif (check_language(user_id) =='ru') :
        if is_contact_authorized(contact,user_id):
            set_contact(user_id,contact)
            await bot.send_message(message.chat.id,"<a href= \"https://safar.guru/login \">Спасибо</a>" ,parse_mode="HTML")
            pass
        else :
            await bot.send_message(message.chat.id,"<a href=\"https://safar.guru/login\">Зарегстрируйтесь сначало на нашем сайте</a>" ,parse_mode="HTML")
            await bot.send_message(message.chat.id,"<a href= \"https://safar.guru/login \">Safar.guru</a>" ,parse_mode="HTML")
            pass
        pass


import asyncio
asyncio.run(bot.polling())