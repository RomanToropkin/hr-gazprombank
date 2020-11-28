# подключим word2vec
from gensim.models import word2vec
import re
from nltk.corpus import stopwords
import pymorphy2
import mysql.connector
from mysql.connector import Error
import numpy as np
import pandas as pd
import math
from sklearn.feature_extraction.text import TfidfVectorizer
from sklearn.pipeline import Pipeline
from sklearn.ensemble import RandomForestClassifier
from nltk.tokenize import sent_tokenize, word_tokenize



morph = pymorphy2.MorphAnalyzer()
stops = set(stopwords.words("english")) | set(stopwords.words("russian"))

def create_connection(host_name, user_name, user_password, db_name):
    connection = None
    try:
        connection = mysql.connector.connect(
            host=host_name,
            user=user_name,
            passwd=user_password,
            database=db_name
        )
        print("Connection to MySQL DB successful")
    except Error as e:
        print(f"The error '{e}' occurred")
    return connection

def execute_read_query(connection, query):
    cursor = connection.cursor(buffered=True)
    result = None
    try:
        cursor.execute(query)
        result = cursor.fetchall()
        return result
    except Error as e:
        print(f"The error '{e}' occurred")

connect = create_connection('phpmyadmin.creativityprojectcenter.ru', 'hr-gazprombank', '7W7AwrwpIcCVIqdO2R9A', 'hr-gazprombank')
def review_to_wordlist(review):
        review_text = re.sub("[^а-яА-Яa-zA-Z0-9]"," ", review)#очищаем от мусора
        words=word_tokenize(review_text, language="russian")  #делит предложения на слова
        words = [w for w in words if not w in stops]#очищаем от стоп-слов
        delimiter = ' '
        output = delimiter.join(words)#соединяем в строку
        return(output)

def predit(text1, text_clf):   # выдает предсказания
    a = text_clf.predict(text1)
    return(a)

def education():   #обучает модель при 1 хапуске
    category = {}
    read_table = """select description, category_id 
    from summary"""
    res = execute_read_query(connect, read_table)

    frame1 = pd.DataFrame(res)
    frame1.rename(columns= { 0:'about', 1:'id'}, inplace = True)
    for i in range(0, len(frame1['id']),1):

        if(math.isnan(frame1['id'][i])):
            frame1['id'][i] = int(0)
        else:
            frame1['id'][i] = int(frame1['id'][i])

    frame1['id'] = frame1['id'].astype(int)
    frame1['id'] = frame1['id'].astype(str)

    read_table = """select * from category;"""
    res = execute_read_query(connect, read_table)
    frame2 = pd.DataFrame(res)
    frame2.rename(columns= {0 :'id', 1:'vacansy'}, inplace = True)
    frame2['id'] = frame2['id'].astype(str)
    frame = pd.merge(frame1, frame2)
    frame['about'] = frame['about'].apply(review_to_wordlist)

    text_clf = Pipeline([
                        ('tfidf', TfidfVectorizer()),
                        ('clf', RandomForestClassifier()),
                        ])
    # train, test, train_labels, test_labels = train_test_split(frame['about'],frame['id'],test_size = 0.40, random_state = 42)
    clf = text_clf.fit(frame['about'], frame['id'])
    return(clf)