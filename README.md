## SHPE-UTD-Website
Website for the Society of Hispanic Professional Engineers (SHPE) at UT Dallas.

## For this website to work properly, do the following things:
1. ### Set up the website to connect to the database
   * The website connects to its database via the `base.php` file. This file needs to be changed depending on whether the website is online or on your local XAMPP server.
     * ~~Website is on **Awardspace.com**~~: (Awardspace.com is no longer in use. Website was migrated to Infinityfree.net)**
       1. Rename `base(remote awardspace.com).php` to just `base.php`
       1. You are done.
     * **Website is on **XAMPP**:
       1. Rename `base(local XAMPP).php` to just `base.php`
       1. You are done.
     * **Website is on **Infinityfree.net**:
       1. Rename `base(remote infinityfree.net).php` to just `base.php`
       1. You are done.
1. ### Set up the website to send emails for user account verifications
   * *PHP lets you send emails from within your code using the `mail()` function. Shpeutd.org now uses this feature to send verification emails when members are registering their accounts. If you would like to work on these features, please read below to setup your workspace.*
   * ~~To do this from **Awarspace.com**~~ **(Awardspace.com is no longer in use. Website was migrated to Infinityfree.net)**
     1. Make sure you have a valid email account setup under **E-Mail Accounts** on the dashboard.
         * **NOTE:** There should already be an account named noreply-accountverify@shpeutd.org, unless someone changed or deleted it. If it's still there, you're done with this step.
     1. You may now use `mail()` in your PHP. For more information, go here: https://www.awardspace.com/kb/php-mail-function/
   * To do this from **XAMPP**:
     * You need to setup XAMPP to connect with the email account that will be sending the emails for you.
       * ~~Setup XAMPP with an **Awardspace.com** email account~~: **(Awardspace.com is no longer in use. Website was migrated to Infinityfree.net)**
         1. Copy **php.ini** from `\shpe-utd-website\xampp_and_awardspace.com\sending_email` in this repository and paste it into your `C:\xampp\php` on your computer. Replace the old one already in there.
         1. Copy **sendmail.ini** from `shpe-utd-website\xampp_and_awardspace.com\sending_email` in this repository and paste it into your `C:\xampp\sendmail` on your computer. Replace the old one already in there.
         1. You may now use `mail()` in your PHP. For more information, go here: https://www.awardspace.com/kb/php-mail-function/ and here: http://localhost/dashboard/docs/send-mail.html
