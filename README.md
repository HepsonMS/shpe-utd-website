## SHPE-UTD-Website
Website for the Society of Hispanic Professional Engineers (SHPE) at UT Dallas.
## Website has migrated from Awardspace.com to Infinityfree.net
  * #### Why?:
    * **Good News:** As a new feature, shpeutd.org now sends emails to its users to verify their new accounts (just like all other websites). It does this with the addition of new email-sending PHP and an "account_activations" table on the database.
      * **More Information:**
        * Tutorial Hepson Followed: https://code.tutsplus.com/tutorials/how-to-implement-email-verification-for-new-members--net-3824
        * Look at `Account_Creation_and_Verification_Guide.jpg`
    * **Problem:** For a website hosted on Awardspace.com to send emails via PHP, it HAS to use Awardspace.com's built-in email accounts. This free email account only allows up to **31** emails to be sent every month. SMTP is the alternative to using this method *(read below)*, but it is disabled for free Awardspace accounts.
      * **More Information:**
        * How to use PHP mail() on Awarspace.com: https://www.awardspace.com/kb/php-mail-function/
        * "Free hosting accounts has SMTP turned Off based on spam threats." on Awardspace: https://www.awardspace.com/web-hosting/shared-hosting/shared-hosting-features-table/
    * **Solution:** Move website to Infinityfree.net. This host allows us to use SMTP **(account has same login credentials as the one on awardspace.com)**
      * **More Information:**
        * What is SMTP?
          * Simple Mail Transfer Protocol (SMTP): Software that allows a website to log into an outside email account and send emails through there. **For example:** shpeutd.org would log into the shpe gmail and sending emails to its members from there, all using PHP.
        * What software are we using for SMTP?
          * We're using PHPMailer, a library of PHP code ready to connect with gmail and send emails (inludes tutorials): https://github.com/PHPMailer/PHPMailer
        * Sending email from your website (PHP mail) on Infinityfree.net: https://infinityfree.net/support/php-mail/
## For this website to work properly, do the following things:
1. ### Make sure it can connect to its database
   The website connects to its database via the `base.php` file. This file needs to be changed depending on whether the website is online or on your local XAMPP server. If it's online, it needs to connect to the appropriate online database. If it's on your local server, it needs to connect to your local server database (stored on your computer).
     * ~~If website is on **Awardspace.com**:~~ **(Awardspace.com is no longer in use. Website was migrated to Infinityfree.net)**
       1. Rename `base(remote awardspace.com).php` to just `base.php`
       1. You are done.
       * If the website is having trouble connecting, open `base.php` and make sure the values of the 4 variables `$dbhost, $dbname, $dbuser, and $dbpass` match with the credentials on Awardspace under **Database Manager**.
     * If website is on **XAMPP**:
       1. Rename `base(local XAMPP).php` to just `base.php`
       1. Open the file and make sure `$dbname` matches with the name of the database you created with your XAMPP. Instructions on this are in the XAMPP training PowerPoint. The other 3 variables, `$dbhost, $dbuser, and $dbpass`, are also important, but their current values should already work, so no need to touch them.
       1. You are done.
     * If website is on **Infinityfree.net**:
       1. Rename `base(remote infinityfree.net).php` to just `base.php`
       1. You are done.
       * If the website is having trouble connecting, open `base.php` and make sure the values of the 4 variables `$dbhost, $dbname, $dbuser, and $dbpass` match with the credentials on Infinityfree under **DATABASES>MySQL Databases**.
1. ### Make sure the website can send emails for user account verifications
   PHP lets you send emails from within your code using the `mail()` function. However, we're using a PHP library Called **PHPMailer** which uses its own functions to send mail. We are using PHPMailer because it lets us use our SHPE Gmail account to send mail via SMTP *(read above)*.
   
   Shpeutd.org now uses this feature to send verification emails when members are registering their accounts. If you would like to work on these features, please read below to setup your workspace. For more information, look at `Account_Creation_and_Verification_Guide.jpg`*
     * ~~To do this from **Awarspace.com**~~ (Awardspace.com is no longer in use. Website was migrated to Infinityfree.net)
       1. Make sure you have a valid email account setup under **E-Mail Accounts** on the dashboard.
           * **NOTE:** There should already be an account named noreply-accountverify@shpeutd.org, unless someone changed or deleted it. If it's still there, you're done with this step.
       1. You may now use `mail()` in your PHP. For more information, go here: https://www.awardspace.com/kb/php-mail-function/
     * To do this from **XAMPP**:
       * You need to setup XAMPP to connect with the email account that will be sending the emails for you.
         * ~~Setup XAMPP with an **Awardspace.com** email account~~: (Awardspace.com is no longer in use. Website was migrated to Infinityfree.net)
           1. Copy **php.ini** from `\shpe-utd-website\xampp_and_awardspace.com\sending_email` in this repository and paste it into your `C:\xampp\php` on your computer. Replace the old one already in there.
           1. Copy **sendmail.ini** from `shpe-utd-website\xampp_and_awardspace.com\sending_email` in this repository and paste it into your `C:\xampp\sendmail` on your computer. Replace the old one already in there.
           1. You may now use `mail()` in your PHP. For more information, go here: https://www.awardspace.com/kb/php-mail-function/ and here: http://localhost/dashboard/docs/send-mail.html
         * https://infinityfree.net/support/how-to-send-email-with-gmail-smtp/
