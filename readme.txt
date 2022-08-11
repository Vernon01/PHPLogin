The SQL question answer is:

select Created from Transaction ORDER BY Created DESC limit 1;

	This will return one value and the last value of created will be first(DESC order) and therefore the last value will be selected

MAX is when you need the highest value of something.



For the project.

I used XAMPP, went with the method of without using a framework.

	I have done a similar project recently on Laravel and decided to do it like this. 
	*Please have a look at the laravel project as well, there is a readme file - you will see it is very similar.
	https://github.com/Vernon01/ProPayProject


Now back to this project.


I used phpmyadmin for this project.

In XAMPP control panel
Start MySQL to create the database you need to use for this project


Create a database called - phpjob

-then create a table called - users
-structured as, id, username, email, exp_date, reset_link_token
(mysql table is provided)


Place the phpLogin folder in the following route
-"C:/xampp/htdocs/"
(inside htdocs folder place the phpLogin folder)


In XAMPP control panel
Start your apache server to run the project


In your browser type the following and then press enter:
http://localhost/phpLogin/login.php

-Now, you should be able to work through the project, Everything works, except the email part(So, users are now unable to reset their password)-this needs some fix.



What I did on the email end.

I created a gmail and yahoo account to send an email, both now does not have the section to allow third party apps. 

      	**At First I did this and this method does not work anymore
      	If you go into the path - C:/xampp/sendmail
      	-Here is a file sendmail.ini

    	Open the file and where you see these line in your file, change it to the following - (this is the yahoo account I created for the project)

     	smtp_server=smtp.gmail.com
     	smtp_port=465

     	auth_username=phpjobtask@gmail.com
    	auth_password=phpjob123


	Then, you go to to the following path - C:/xampp/php
	-Here is the a file called php.ini

	Change the following:
	press ctrl+f -  type in sendmail
	-when you see these lines, change it to the following

	sendmail_from = phpjobtask@yahoo.com
	sendmail_path = "C:\xampp\sendmail\sendmail.exe -t"


	Restart your apache server on XAMPP control panel.


**This actually worked.

Install PHPMailer.
-install composer in you xampp folder first and then in your terminal, go to that path, in my case it was C:\xampp\composer and then run the following command

	composer require phpmailer/phpmailer



**this part is only to use in the code - you can just install phpmailer and the code should work
Then in your file to run PHPMailer, include the following:

	use PHPMailer\PHPMailer\PHPMailer;
    	use PHPMailer\PHPMailer\Exception;

    	require 'C:\xampp\composer\vendor\autoload.php';

    	$mail = new PHPMailer(TRUE);
**in the code you will see i had to setup a token to send emails from gmail now.


That is it.

Thank you for reading.