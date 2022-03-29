README.txt

//Project Contributions

Amelia Aboujawdah worked on managing and creating the MySQL database. 
She and Nathanael Ochoa worked together researching the different necessary requirements needed to link PHP and MySQL. 
MarMar Tahery and Nathanael worked on styling the web pages together and creating the user interface. 
The three of us worked together to apply the functionality to the web pages and ensured that the application 
correctly linked to MySQL. 


//////////////////////////////////////////////////////////////


// About our Application

The user is able to sign in or create a new account. 
When signing in, the application can recognize if the given username is saved in the 
database or not and will allow the sign-on if the password is given correctly. 
When creating a new account, the application will require the user to input all missing fields 
and can recognize if the given email address and username are already registered in the database or 
not, prompting the user to use another email address or password. The application can also recognize 
if the passwords do not match when confirming the password. 
After successfully logging in or signing up, the user will be redirected to the landing page with 
the ‘Initialize Database’ button reserved for the second phase of the assignment. 
It will also display the user’s first name at the top of the screen when successfully signed in. 


//////////////////////////////////////////////////////////////


// How to set up MySQL database

// launches the mysql shell, logs into user ‘root’ (will prompt for your password)
mysql -u root -p

// creates the database ‘comp440’ in your local mysql server
CREATE DATABASE comp440;

// shows databases on your computer, you should see ‘comp440’ there now
SHOW databases;

// tells mysql which database you will be using
USE comp440;

// creates the table ‘user’ with the following attributes
// need to update with ‘NOT NULL’ options
CREATE TABLE user (
	username varchar(20) UNIQUE,
	password varchar(20),
	email varchar(50) UNIQUE,
	first_name varchar(20),
	last_name varchar(20),
	PRIMARY KEY(username)
);

// shows the tables in your database
SHOW TABLES;

// shows the attributes of the table ‘user’
DESCRIBE user;

// if you mess up, drop the table! This deletes the table.
DROP TABLE user;

// exit the mysql shell back into your regular terminal shell (do not put a semicolon here)
Exit
