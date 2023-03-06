#!/bin/bash
#
# SCRIPT DE DESPLIEGUE DE PROYECTO
#
# Manuel Arqués Yus
#

# Variables de entorno

USERDB="root"
PASSDB="root"
HOST=$(hostname -I)
WWW="/var/www/html/"

# Nombre del fichero de los datos en el proyecto 
DATOS="db/subastas.sql"
BBDD="subastas"

# Se toman los parámetros como USER y PASS de la BBDD
if [ $# = 2 ];
then
   USERDB=$1
   PASSDB=$2
fi

# Copiamos el contenido de la carpeta proyecto a la página html
cp -r ../../Proyecto-Final/ $WWW

# Restauramos los datos de ejemplo a la BBDD
mysqladmin -u $USERDB -p$USERDB create $BBDD
mysql -u $USERDB -p$USERDB $BBDD < ../$DATOS

# Mostramos url de carga
echo "http://$HOST/Proyecto-Final/index.php"

