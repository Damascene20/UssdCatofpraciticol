Rwanda Polytechnic Student Registration and Payment System
This PHP-based system allows students to register for Rwanda Polytechnic (RP) colleges and make payments via USSD interface. The registration process involves selecting a college, department, and providing personal details, followed by a payment process to complete the registration.
Features
College and Department Selection: Students can select a college and department from the list provided.
Student Registration: Collects student details such as full name, ID card number, phone number, email, and password.
Payment System: Allows students to make payments by entering a registration number, amount, and PIN.
Session Management: Uses PHP sessions to store user inputs at each step of the process, ensuring that data is maintained across multiple requests.
Database Integration: The system connects to a MySQL database (rp_student_registration) to store student and payment information.
Database Structure
students Table
Column	Data Type	Description
id	INT AUTO_INCREMENT	Primary key, unique student ID
college	VARCHAR(255)	Name of the college selected
department	VARCHAR(255)	Name of the department selected
full_name	VARCHAR(255)	Full name of the student
id_card	VARCHAR(50)	Student's ID card number
phone	VARCHAR(50)	Student's phone number
email	VARCHAR(255)	Student's email address
password	VARCHAR(255)	Encrypted password
reg_number	VARCHAR(255)	Generated student registration number
payments Table
Column	Data Type	Description
id	INT AUTO_INCREMENT	Primary key, unique payment ID
amount	DECIMAL(10,2)	Payment amount
reg_number	VARCHAR(255)	Associated student registration number
pin	VARCHAR(255)	Encrypted PIN used for payment
Setup
Prerequisites
PHP 7.0 or higher
MySQL database
Web server (e.g., Apache or Nginx)
Composer (for dependency management, if needed)
Installation Steps
Clone or download the repository:
git remote add origin https://github.com/Damascene20/UssdCatofpraciticol.git
Set up the Database: Create a database rp_student_registration and set up the following tables:
CREATE TABLE students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    college VARCHAR(255),
    department VARCHAR(255),
    full_name VARCHAR(255),
    id_card VARCHAR(50),
    phone VARCHAR(50),
    email VARCHAR(255),
    password VARCHAR(255),
    reg_number VARCHAR(255)
);

CREATE TABLE payments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    amount DECIMAL(10,2),
    reg_number VARCHAR(255),
    pin VARCHAR(255)
);
Configure the Database: Update the connectDatabase function in the PHP code with your database credentials (host, username, password, database name).

Deploy to a Web Server: Place the PHP code in the web server's document root (e.g., /var/www/html for Apache).

Test the System: Open the application via a browser or a tool that can simulate USSD (e.g., a web-based USSD emulator).
Usage
Initial Menu: Displays the main menu with available colleges.
Registration Flow: Guides the user through selecting a college, department, and entering their personal information.
Payment Flow: Allows students to make a payment after registration by entering their registration number, amount, and PIN.
Session Management: Ensures data is retained throughout the process using PHP sessions.
Security
Passwords are hashed using PASSWORD_BCRYPT for secure storage.
PINs are also hashed before being stored in the database to ensure security.
Ensure that your web server is configured to use HTTPS for secure communication.
Contributing
Feel free to fork this repository and submit pull requests for any improvements, bug fixes, or new features!

License
This project is licensed under the MIT License - see the LICENSE file for details.
