#!/bin/bash

		IP_D="10.0.2.11"
                USER_M="shaiddy"
                PASS_M="1"
# Go to var/www/ishop/userInterface/uploads
# And send the csv file the user uploads and send it to BE: ~/Upload
cd /var/www/ishop/userInterface/uploads/

FILE=`ls`
#echo "${FILE}"

# password for root on BE vm
pAs="passwd"

echo  "deleteing old csv from BE...\n"
# Go to BE : ~/Upload and delete any old csv files
/usr/bin/sshpass -p ${pAs} ssh -t root@"${IP_D}" "cd ~/Upload/File/; sudo rm -r ./*.csv;"

echo  "Sending new csv to BE...\n"

# Sending new csv file to BE
/usr/bin/sshpass -p ${PASS_M} scp ${FILE} "${User_M}"@"10.0.2.11":~/Upload/File/

echo  "deleteing old csv from FE...\n"

# Delete new csv file from FE /var/www/ishop/userInterface/uploads/
cd /var/www/ishop/userInterface/uploads/
`sudo rm -r ./*.csv`

# On BE: Upload csv file to DB 
/usr/bin/sshpass -p ${pAs} ssh -t root@"${IP_D}" "cd ~/Upload/; exec(./uploadcsv.php);"

