#!/bin/bash

# MySQL Socket Error Fix for Digital Ocean Ubuntu/Debian
echo "=== Fixing MySQL Socket Error ==="

echo "1. Check MySQL service status:"
systemctl status mysql

echo "2. Check if MySQL is installed:"
which mysql
mysql --version

echo "3. Check MySQL socket directory:"
ls -la /var/run/mysqld/ 2>/dev/null || echo "Socket directory doesn't exist"

echo "4. Create socket directory if missing:"
mkdir -p /var/run/mysqld
chown mysql:mysql /var/run/mysqld
chmod 755 /var/run/mysqld

echo "5. Check MySQL configuration:"
cat /etc/mysql/mysql.conf.d/mysqld.cnf | grep socket

echo "6. Start MySQL service:"
systemctl start mysql
systemctl enable mysql

echo "7. Check MySQL status again:"
systemctl status mysql

echo "8. Test MySQL connection:"
mysql -u root -p -e "SELECT 1;" 2>/dev/null && echo "MySQL connection successful!" || echo "MySQL connection failed"

echo "9. If still not working, reinstall MySQL:"
echo "apt remove --purge mysql-server mysql-client mysql-common"
echo "apt autoremove"
echo "apt autoclean"
echo "apt install mysql-server"

echo "=== MySQL Fix Complete ==="
