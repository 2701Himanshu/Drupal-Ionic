# Drupal-Ionic

## Requirement

### A. Drupal Requirement

- Apache server, mysql server, phpmyadmin and php@7.*
or
- XAMPP server

### B. Ionic Requirement

- Nodejs and npm
- Ionic

## Installation

### A. Drupal Setup

1. Find the 'd8' folder in the drupal-ionic project. Place this folder in your localhost web server folder (in my case it will be '/var/www/html').

2. Open the mysql phpmyadmin and create a new database named as 'ionic' and import the given sql file named as 'drupal_sql_file.sql'. That sql file is placed within the project folder.

3. Open drupal folder 'd8' and change the content of a file '<path-to-localhost-folder>/d8/sites/default/default.settings.php'.

  <pre>
  $databases['default']['default'] = array (
    'database' => 'd8',
    'username' => 'root',
    'password' => '<mysql-password-if-any>',
    ......
  </pre>

4. After creating and importing database, check your drupal installation by hit an url: 

  http://localhost/d8/
  
If drupal is launched successfully, then go to the next step to setup ionic code. If any error occures in drupal setup, please refer to the drupal 8 installation guide.

Use this Reference: http://www.inmotionhosting.com/support/edu/drupal-8/getting-started/manual-install

### B. Ionic Setup

1. The remaining files of the project(after removing 'd8' folder and database sql file 'drupal_sql_file.sql') are the ionic project files. Create a new folder 'dru-ion' and place these remaining files in the new folder. Place the 'dru-ion' folder aynwhere in your system.

2. Open '.../dru-ion/www/js/controllers.js' and replace a string that occurs only 1 times:

  http://localhost/cms/DP/Headless/d8/api/article   =>    http://localhost/d8/api/article

3. Open another file '.../dru-ion/www/js/services.js' and replace a string that occurs 2 times:

  http://localhost/cms/DP/Headless/d8/  =>  http://localhost/d8/

4. Open command prompt or terminal and go inside the 'dru-ion' and run a command : 
  
  ionic serve
  
After running this command, the default browser is opened and output of the ionic application is shown on it.
