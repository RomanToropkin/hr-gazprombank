from collections import Counter
from nltk.tokenize import sent_tokenize, word_tokenize
import nltk
import math
from nltk.corpus import stopwords
import pymorphy2
from sklearn.feature_extraction.text import TfidfVectorizer
from sklearn.ensemble import RandomForestClassifier
from nltk.tokenize import RegexpTokenizer
import string	
from collections import defaultdict 
import model as mdl
import mysql.connector
from mysql.connector import Error

morph = pymorphy2.MorphAnalyzer()
stop_words = stopwords.words("russian")
tokenizer = RegexpTokenizer(r'\w+')

skills={}
category={}
skills_row=[]
skills = defaultdict(list) 
category = defaultdict(list) 
coincidences={}
clf = mdl.education()


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

def execute_insert_query(connection, query):
    cursor = connection.cursor(buffered=True)
    try:
        cursor.execute(query)
        connection.commit()
        print ("OK")
    except Error as e:
        print(f"The error '{e}' occurred")
connect = create_connection('phpmyadmin.creativityprojectcenter.ru', 'hr-gazprombank', '7W7AwrwpIcCVIqdO2R9A', 'hr-gazprombank')

read_table = """select sv.id_vacancy, k.title
from skill_keyword
         LEFT JOIN keyword k on skill_keyword.id_keyword = k.id
         LEFT JOIN skills s on skill_keyword.id_skill = s.id
         LEFT JOIN skill_vacancy sv on s.id = sv.id_skill
         LEFT JOIN vacancy v on sv.id_vacancy = v.id
         WHERE v.is_deleted = 0;"""
         
res = execute_read_query(connect, read_table)

for key, val in res:
    skills[key].append(morph.parse(val)[0].normal_form) 

read_table = """select sv.id_vacancy, v.id_category
from skill_keyword
         LEFT JOIN keyword k on skill_keyword.id_keyword = k.id
         LEFT JOIN skills s on skill_keyword.id_skill = s.id
         LEFT JOIN skill_vacancy sv on s.id = sv.id_skill
         LEFT JOIN vacancy v on sv.id_vacancy = v.id
         WHERE v.is_deleted = 0;"""
res = execute_read_query(connect, read_table)

for key, val in res:
    category[key].append(val) 

for id_summary in range(130, 1615, 1):
    create_users_table = """select description from summary where id = """+str(id_summary)+""";"""
    res = execute_read_query(connect, create_users_table)
    for i in res:
        text1 =  i[0]

    corpus= []
    filtered=[]
    normal = []
    normal1=[]

    text1 = "".join([ch for ch in text1 if ch not in string.punctuation]) #удаляем знаки препинания
    corpus=word_tokenize(text1, language="russian")  #делит предложения на слова

    for i in corpus:
        if i in stop_words:
            corpus.remove(i) #удаляет стоп слова (предлоги например) надо список слов вручную доработать

    

    for token in corpus:  
            a = corpus.index(token)
            corpus[a]=(morph.parse(token)[0].normal_form) #приводит слова к их нормальной форме

    experience = 0
    op = corpus.count("опыт")
    if(op>0):
        if(corpus.count("месяц")>0 and corpus.index("месяц")>op):
            if(corpus.count("год")>0 and corpus.index("год")>op):
                experience = int(corpus[corpus.index("год", op)-1])*12 + int(corpus[corpus.index("месяц", op)-1])
            else:
                experience = int(corpus[corpus.index("месяц", op)-1])
        else:
            if(corpus.count("год")>0 and corpus.index("год")>op):
                experience = int(corpus[corpus.index("год", op)-1])*12
            
    else:
        experience=0
    corpus = list(set(corpus))

    delimiter = ' '
    output=[]
    output.append(delimiter.join(corpus))
    result_predict = mdl.predit(output, clf)

    for i in skills:
        if(int(result_predict[0]) == int(category[i][0])):
            a = 0
            for j in corpus:
                if (skills[i].count(j)>0):
                    a = a + 1
        else:
            a = 0 
        coincidences[i] = a

    for i in coincidences:
        read_table = "SELECT work_start FROM vacancy WHERE id = "+str(i)+";"
        res = execute_read_query(connect, read_table)
        if (res[0][0]*12<= experience):
            if(coincidences[i]>0):
                read_table = "replace summary_vacancy (id_summary, id_vacancy, score) VALUE ("+str(id_summary)+"," +str(i)+","+ str(0.3+(coincidences[i]*0.7)/len(skills[i]))+");"
            else:
                read_table = "replace summary_vacancy (id_summary, id_vacancy, score) VALUE ("+str(id_summary)+"," +str(i)+","+ str(0)+");"
        else:
            read_table = "replace summary_vacancy (id_summary, id_vacancy, score) VALUE ("+str(id_summary)+"," +str(i)+","+ str(0)+");"
        res =execute_insert_query(connect, read_table)
print("all")




