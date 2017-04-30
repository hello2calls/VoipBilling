#!/bin/bash
clear
echo
echo
echo
echo "=======================WWW.MAGNUSBILLING.COM==========================";
echo "_      _                               ______ _ _ _ _  			 ";
echo "|\    /|                               | ___ (_) | (_) 			 ";
echo "| \  / | ___  ____ _ __  _   _   _____ | |_/ /_| | |_ _ __   __ _ 	 ";
echo "|  \/  |/   \/  _ \| '_ \| | | \| ___| | ___ \ | | | | '_ \ /  _ \	 ";
echo "| |\/| |  | |  (_| | | | | |_| ||____  | |_/ / | | | | | | |  (_| |	 ";
echo "|_|  |_|\___|\___  |_| | |_____|_____|  \___/|_|_|_|_|_| |_|\___  |	 ";
echo "                _/ |                                           _/ |	 ";
echo "               |__/                                           |__/ 	 ";
echo "														 ";
echo "============================== UPDATE =================================";
echo

sleep 2

if [[ -e /var/www/html/mbilling/protected/commands/update2.sh ]]; then
	/var/www/html/mbilling/protected/commands/update2.sh
	exit;
fi
rm -rf /var/www/html/mbilling/MBilling*.tar.gz
cd /var/www/html/mbilling
wget http://master.dl.sourceforge.net/project/magnusbilling/MBilling-5-current.tar.gz
rm -rf /var/www/html/mbilling/yii
tar xzf MBilling-5-current.tar.gz
rm -rf /var/www/html/mbilling/MBilling*.tar.gz
php /var/www/html/mbilling/cron.php UpdateMysql
rm -rf /var/www/html/mbilling/doc
chown -R asterisk:asterisk /var/www/html/mbilling
chmod -R 777 /tmp
chmod -R 555 /var/www/html/mbilling/
chmod -R 750 /var/www/html/mbilling/resources/reports 
chmod 770 -R /var/www/html/mbilling/protected/runtime/
chmod 755 /var/www/html/mbilling/resources/ip.blacklist
mkdir /var/www/tmpmagnus
chown -R asterisk:asterisk /var/www/tmpmagnus