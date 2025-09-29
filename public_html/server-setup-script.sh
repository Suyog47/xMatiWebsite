#!/bin/bash

# Digital Ocean WordPress Setup Script
# Run this script on your Digital Ocean droplet after uploading files

echo "=== Digital Ocean WordPress Setup ==="

# Update system
echo "Updating system packages..."
apt update && apt upgrade -y

# Install LAMP stack
echo "Installing LAMP stack..."
apt install apache2 mysql-server php php-mysql php-curl php-gd php-mbstring php-xml php-zip libapache2-mod-php unzip -y

# Enable Apache modules
echo "Configuring Apache..."
a2enmod rewrite
systemctl enable apache2
systemctl restart apache2

# Configure Apache for WordPress
echo "Setting up Apache virtual host..."
cat > /etc/apache2/sites-available/000-default.conf << 'EOF'
<VirtualHost *:80>
    ServerAdmin webmaster@localhost
    DocumentRoot /var/www/html
    
    <Directory /var/www/html>
        AllowOverride All
        Require all granted
    </Directory>
    
    ErrorLog ${APACHE_LOG_DIR}/error.log
    CustomLog ${APACHE_LOG_DIR}/access.log combined
</VirtualHost>
EOF

systemctl restart apache2

# Setup MySQL
echo "Configuring MySQL..."
systemctl enable mysql
systemctl start mysql

# Extract WordPress files
echo "Extracting WordPress files..."
cd /var/www/html
rm -f index.html
tar -xzf /tmp/xmati-wordpress-site.tar.gz -C /var/www/html/

# Set permissions
echo "Setting file permissions..."
chown -R www-data:www-data /var/www/html/
chmod -R 755 /var/www/html/
chmod -R 644 /var/www/html/wp-config.php

# Configure firewall
echo "Configuring firewall..."
ufw allow 'Apache Full'
ufw allow OpenSSH
echo "y" | ufw enable

echo "=== Setup Complete ==="
echo "Next steps:"
echo "1. Run: mysql_secure_installation"
echo "2. Create database: mysql -u root -p"
echo "   CREATE DATABASE xmati_wordpress;"
echo "   CREATE USER 'xmati_user'@'localhost' IDENTIFIED BY 'your_password';"
echo "   GRANT ALL PRIVILEGES ON xmati_wordpress.* TO 'xmati_user'@'localhost';"
echo "   FLUSH PRIVILEGES;"
echo "   EXIT;"
echo "3. Import database: mysql -u root -p xmati_wordpress < /tmp/xmati-database-backup.sql"
echo "4. Update wp-config.php with new database credentials"
echo "5. Update site URLs in WordPress database"
