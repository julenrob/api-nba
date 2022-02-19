import mysql.connector
from mysql.connector import errorcode
from datetime import datetime
import csv

file_to_work = "employees.csv"

# WORKING
def connect_db():
    cnx = None

    try:
        cnx = mysql.connector.connect(user='root', password='dbrootpass',
                                      host='edu-dbms',
                                      database='employees')
    except mysql.connector.Error as err:
        if err.errno == errorcode.ER_ACCESS_DENIED_ERROR:
            print("Something is wrong with your user name or password")
        elif err.errno == errorcode.ER_BAD_DB_ERROR:
            print("Database does not exist")
        else:
            print(err)

    return cnx

# WORKING
def csv_read_insert(cnx):    
    cursor = cnx.cursor()

    with open(file_to_work, "r", encoding = 'utf8') as csv_file:
        csv_reader = csv.DictReader(csv_file)

        for lineCSV in csv_reader:
            add_salary = ("INSERT INTO employees (emp_no, birth_date, first_name, last_name, gender, hire_date)" "VALUES (%s, %s, %s, %s, %s, %s)")
            data_salary = (lineCSV['emp_no'], lineCSV['birth_date'], lineCSV['first_name'], lineCSV['last_name'], lineCSV['gender'], lineCSV['hire_date'])
        
            cursor.execute(add_salary, data_salary)
       
        cursor.close()
        cnx.commit()

# WORKING
def close_db(cnx):
    cnx.close()

    return 0

if __name__ == "__main__":
    cnx = connect_db()
    csv_read_insert(cnx)
    close_db(cnx)