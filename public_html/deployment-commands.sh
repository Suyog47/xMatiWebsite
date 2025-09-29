#!/bin/bash

# Digital Ocean Deployment Commands
# Run these commands on your Digital Ocean droplet

echo "=== Digital Ocean WordPress Deployment ==="

# 1. SSH into your droplet
echo "1. SSH into your droplet:"
echo "ssh root@YOUR_DROPLET_IP"
echo ""

# 2. Make setup script executable and run it
echo "2. Run the setup script:"
echo "chmod +x /tmp/server-setup-script.sh"
echo "/tmp/server-setup-script.sh"
echo ""

# 3. Fix MySQL socket error and secure installation
echo "3. Fix MySQL socket error and secure installation:"
echo "# Check MySQL status"
echo "systemctl status mysql"
echo ""
echo "# If MySQL is not running, start it:"
echo "systemctl start mysql"
echo "systemctl enable mysql"
echo ""
echo "# Check if MySQL socket exists:"
echo "ls -la /var/run/mysqld/"
echo ""
echo "# If socket directory doesn't exist, create it:"
echo "mkdir -p /var/run/mysqld"
echo "chown mysql:mysql /var/run/mysqld"
echo ""
echo "# Restart MySQL service:"
echo "systemctl restart mysql"
echo ""
echo "# Now secure MySQL installation:"
echo "mysql_secure_installation"
echo ""
echo "Answer prompts:"
echo "- Set root password: Y"
echo "- Remove anonymous users: Y" 
echo "- Disallow root login remotely: Y"
echo "- Remove test database: Y"
echo "- Reload privilege tables: Y"
echo ""

# 4. Create database
echo "4. Create WordPress database:"
echo "mysql -u root -p"
echo ""
echo "In MySQL console, run:"
echo "CREATE DATABASE xmati_wordpress;"
echo "CREATE USER 'xmati_user'@'localhost' IDENTIFIED BY 'YourStrongPassword123!';"
echo "GRANT ALL PRIVILEGES ON xmati_wordpress.* TO 'xmati_user'@'localhost';"
echo "FLUSH PRIVILEGES;"
echo "EXIT;"
echo ""

# 5. Import database
echo "5. Import WordPress database:"
echo "mysql -u root -p xmati_wordpress < /tmp/xmati-database-backup.sql"
echo ""

# 6. Update wp-config.php
echo "6. Update WordPress configuration:"
echo "nano /var/www/html/wp-config.php"
echo ""
echo "Update these lines:"
echo "define('DB_NAME', 'xmati_wordpress');"
echo "define('DB_USER', 'xmati_user');"
echo "define('DB_PASSWORD', 'YourStrongPassword123!');"
echo "define('DB_HOST', 'localhost');"
echo ""

# 7. Update site URLs
echo "7. Update site URLs in database:"
echo "mysql -u root -p xmati_wordpress"
echo ""
echo "In MySQL console, run:"
echo "UPDATE wp_options SET option_value = 'http://YOUR_DROPLET_IP' WHERE option_name = 'home';"
echo "UPDATE wp_options SET option_value = 'http://YOUR_DROPLET_IP' WHERE option_name = 'siteurl';"
echo "EXIT;"
echo ""

# 8. Final steps
echo "8. Final configuration:"
echo "systemctl restart apache2"
echo "systemctl restart mysql"
echo ""

echo "=== Deployment Complete ==="
echo "Your WordPress site should now be accessible at: http://YOUR_DROPLET_IP"
