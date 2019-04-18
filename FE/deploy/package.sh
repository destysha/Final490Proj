#!/bin/bash

if [$# -lt 1 ] ; then 
	echo "Please give a Verison Number"
	exit
elif [$# -ge 3] ; then
	echo "Too many parameters"
	exit

fi

mtype = $1
version = $2
echo "creating package for "$mtype" version: "$version"

cd /var/www/ishop/
if [$mtype == "fe"]; then
	tar -cf $mtype'_'$version.tar --exclude-vcs userInterface

fi 
echo "package "$mtype'_'$version"created"
mv $mtype'_'$version.tar /var/www/ishop/versions/
cd /var/www/ishop/versions/
#send package to deployment server with scp

sshpass -p "Hccc0277766" scp $mtype'_'$version.tar deploy@10.0.2.9:/var/www/ishop/versionsD/
