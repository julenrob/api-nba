import mysql.connector
from mysql.connector import errorcode
import csv

equipos_file = "files/equipos.csv"
estadisticas_file = "files/estadisticas.csv"
jugadores_file = "files/jugadores.csv"
partidos_file = "files/partidos.csv"

# WORKING
def connect_db():
    cnx = None

    try:
        cnx = mysql.connector.connect(user='root', password='dbrootpass',
                                      host='add-dbms',
                                      database='nba')
    except mysql.connector.Error as err:
        if err.errno == errorcode.ER_ACCESS_DENIED_ERROR:
            print("Something is wrong with your user name or password")
        elif err.errno == errorcode.ER_BAD_DB_ERROR:
            print("Database does not exist")
        else:
            print(err)

    return cnx

# WORKING
def insert_equipos(cnx):    
    cursor = cnx.cursor()

    with open(equipos_file, "r", encoding = 'utf8') as csv_file:
        csv_reader = csv.DictReader(csv_file, delimiter =";")

        for lineCSV in csv_reader:
            add_equipos = ("INSERT INTO equipos (nombre, ciudad, conferencia, division)" "VALUES (%s, %s, %s, %s)")
            data_equipos = (lineCSV['nombre'], lineCSV['ciudad'], lineCSV['conferencia'], lineCSV['division'])
        
            cursor.execute(add_equipos, data_equipos)
       
        cursor.close()
        cnx.commit()

# WORKING
def insert_estadisticas(cnx):    
    cursor = cnx.cursor()

    with open(estadisticas_file, "r", encoding = 'utf8') as csv_file:
        csv_reader = csv.DictReader(csv_file, delimiter =";")

        for lineCSV in csv_reader:
            add_estadisticas = ("INSERT INTO estadisticas (temporada, jugador, puntos_por_partido, asistencias_por_partido, tapones_por_partido, rebotes_por_partido)" "VALUES (%s, %s, %s, %s, %s, %s)")
            data_estadisticas = (lineCSV['temporada'], lineCSV['jugador'], lineCSV['puntos_por_partido'], lineCSV['asistencias_por_partido'], lineCSV['tapones_por_partido'], lineCSV['rebotes_por_partido'])
        
            cursor.execute(add_estadisticas, data_estadisticas)
       
        cursor.close()
        cnx.commit()

# WORKING
def insert_jugadores(cnx):    
    cursor = cnx.cursor()

    with open(jugadores_file, "r", encoding = 'utf8') as csv_file:
        csv_reader = csv.DictReader(csv_file, delimiter =";")

        for lineCSV in csv_reader:
            add_jugadores = ("INSERT INTO jugadores (codigo, nombre, procedencia, altura, peso, posicion, nombre_equipo)" "VALUES (%s, %s, %s, %s, %s, %s, %s)")
            data_jugadores = (lineCSV['codigo'], lineCSV['nombre'], lineCSV['procedencia'], lineCSV['altura'], lineCSV['peso'], lineCSV['posicion'], lineCSV['nombre_equipo'])
        
            cursor.execute(add_jugadores, data_jugadores)
       
        cursor.close()
        cnx.commit()

# WORKING
def insert_partidos(cnx):    
    cursor = cnx.cursor()

    with open(partidos_file, "r", encoding = 'utf8') as csv_file:
        csv_reader = csv.DictReader(csv_file, delimiter =";")

        for lineCSV in csv_reader:
            add_partidos = ("INSERT INTO partidos (codigo, equipo_local, equipo_visitante, puntos_local, puntos_visitante, temporada)" "VALUES (%s, %s, %s, %s, %s, %s)")
            data_partidos = (lineCSV['codigo'], lineCSV['equipo_local'], lineCSV['equipo_visitante'], lineCSV['puntos_local'], lineCSV['puntos_visitante'], lineCSV['temporada'])
        
            cursor.execute(add_partidos, data_partidos)
       
        cursor.close()
        cnx.commit()

# WORKING
def close_db(cnx):
    cnx.close()

    return 0

if __name__ == "__main__":
    cnx = connect_db()

    insert_equipos(cnx)
    insert_jugadores(cnx)
    insert_partidos(cnx)
    insert_estadisticas(cnx)

    close_db(cnx)