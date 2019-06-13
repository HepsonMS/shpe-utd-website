## SHPE-UTD-Website
Website for the Society of Hispanic Professional Engineers (SHPE) at UT Dallas. 

### Setting up Awardspace.com and XAMPP to let you send email through PHP
  * *PHP lets you send emails from within your code using the `mail()` function. Shpeutd.org now uses this feature to send verification emails when members are registering their accounts. If you would like to work on these features, please read below to setup your workspace.*
  * ~~To do this from **Awarspace.com**~~ **(Awardspace.com is no longer in use. Website was migrated to Infinityfree.net)**
    1. Make sure you have a valid email account setup under **E-Mail Accounts** on the dashboard.
        * **NOTE:** There should already be an account named noreply-accountverify@shpeutd.org, unless someone changed or deleted it. If it's still there, you're done with this step.
    1. You may now use `mail()` in your PHP. For more information, go here: https://www.awardspace.com/kb/php-mail-function/
  * To do this from **XAMPP**:
    * You need to setup XAMPP to connect with the email account that will be sending the emails for you.
      * ~~Setup XAMPP with an **Awardspace.com** email account~~: **(Awardspace.com is no longer in use. Website was migrated to Infinityfree.net)**
        1. Copy **php.ini** from `\shpe-utd-website\sending_email` in this repository and paste it into your `C:\xampp\php` on your computer. Replace the old one already in there.
        1. Copy **sendmail.ini** from `shpe-utd-website\sending_email` in this repository and paste it into your `C:\xampp\sendmail` on your computer. Replace the old one already in there.
        1. You may now use `mail()` in your PHP. For more information, go here: https://www.awardspace.com/kb/php-mail-function/ and here: http://localhost/dashboard/docs/send-mail.html
