# Model View Controller - Design Pattern for PHP

## Models

All the database functions are stored in here.  
Every table has his own object inside of the model folder.

## Views

All the web pages are stored in here.  
Every page has his own folder with an index.php.  
All the data is passed to the view via the $data variable.

## Controller

All the functionallities are stored in here.  
All the models are called inside the controllers and can be modified and then be passed to the view.

-- Project Setup --
1. Put this folder to xampp/htdocs.
2. Insert the sql table and values.
3. Edit /app/core/config.php, change the root variable to your port number, in case you use port other than 80.
4. Currently, this project is connecting to the AWS Cloud RDS Database, and all the database credentials are stored in .env file.
If you need to maintain your own database, you need to change the credentials accordingly.
5. In the webpage, navigate to localhost/CinemaManagementSystem/public/ path, it will show the homepage.

Predefined user credentials
username: 0143551931
password: @Bc1234

Predefined admin credentials
username: 0143551931
password: @Bc123
