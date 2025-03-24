# new_con_website

To make your website accessible over your Local Area Network (LAN) using XAMPP, follow these steps:

---

### *Step 1: Configure Apache in XAMPP*
1. *Open httpd.conf*:
   - Navigate to the XAMPP installation directory (e.g., C:\xampp).
   - Open the apache\conf folder and locate the httpd.conf file.
   - Open it with a text editor (e.g., Notepad or Notepad++).

2. *Modify the Listen directive*:
   - Find the line that says Listen 80 (or another port number).
   - Change it to Listen 0.0.0.0:80 to allow Apache to listen on all network interfaces.

3. *Allow access from other devices*:
   - Find the <Directory> section for your web root directory (e.g., C:/xampp/htdocs).
   - Update the Require directive to allow access from your LAN:
     apache
     <Directory "C:/xampp/htdocs">
         Options Indexes FollowSymLinks
         AllowOverride All
         Require all granted
     </Directory>
     

4. *Save and close the httpd.conf file*.

---

### *Step 2: Configure Firewall*
1. *Allow Apache through the firewall*:
   - Open the Windows Firewall settings.
   - Go to "Allow an app or feature through Windows Defender Firewall."
   - Ensure that httpd.exe (Apache) is allowed for both private and public networks.

2. *Allow MySQL through the firewall* (if needed):
   - Similarly, allow mysqld.exe through the firewall if your database needs to be accessed remotely.

---

### *Step 3: Find Your Local IP Address*
1. Open Command Prompt (cmd).
2. Type ipconfig and press Enter.
3. Look for the IPv4 Address under your active network adapter (e.g., 192.168.1.100). This is your local IP address.

---

### *Step 4: Access the Website from Another Device*
1. Ensure both your local machine and the other device are connected to the same LAN.
2. On the other device, open a web browser.
3. Enter your local IP address followed by the website folder name (if any):
   - Example: http://192.168.1.100/your-website-folder.

---

### *Step 5: Configure MySQL for Remote Access (Optional)*
If you want other devices on the LAN to access the MySQL database:
1. *Open my.ini*:
   - Locate the MySQL configuration file (my.ini or my.cnf) in the XAMPP installation directory.
   - Find the bind-address line and change it to:
     ini
     bind-address = 0.0.0.0
     
   - Save and close the file.

2. *Grant remote access to MySQL*:
   - Open phpMyAdmin or MySQL command line.
   - Run the following SQL command to grant access to a user:
     sql
     GRANT ALL PRIVILEGES ON *.* TO 'username'@'%' IDENTIFIED BY 'password';
     FLUSH PRIVILEGES;
     
   - Replace username and password with your MySQL credentials.

3. *Restart MySQL*:
   - Restart the MySQL service in XAMPP for the changes to take effect.

---

### *Step 6: Test the Setup*
1. On another device connected to the same LAN, open a browser.
2. Enter your local IP address and website folder (if applicable) to access the website.
3. If you configured MySQL for remote access, test the database connection from another device.

---

### *Troubleshooting*
- *Cannot access the website*:
  - Ensure XAMPP is running and Apache is started.
  - Check if the firewall is blocking the connection.
  - Verify that both devices are on the same network.

- *Database connection issues*:
  - Ensure MySQL is configured to allow remote access.
  - Check the database connection settings in your PHP code (e.g., mysqli_connect).

---

By following these steps, your website should be accessible to all devices on your LAN. Let me know if you encounter any issues!

https://2926-103-164-70-65.ngrok-free.app/conn_website/index.php
