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
          * Simple Mail Transfer Protocol (SMTP): Software that allows a website to log into an outside email account and send emails through there. **For example:** shpeutd.org would log into the SHPE Gmail and send emails to its members from there, all using PHP.
        * What software are we using for SMTP?
          * We're using PHPMailer, a library of PHP code ready to connect with gmail and send emails (inludes tutorials): https://github.com/PHPMailer/PHPMailer
        * Sending email from your website (PHP mail) on Infinityfree.net: https://infinityfree.net/support/php-mail/
        * How did you change shpeutd.org to point to Infinityfree.net? https://infinityfree.net/support/how-to-use-infinityfree-nameservers/
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
1. ### Make sure the website can send emails via PHP
   PHP lets you send emails from within your code using the `mail()` function. However, we're using a PHP library Called **PHPMailer** which uses its own functions to send mail. We are using PHPMailer because it lets us use our SHPE Gmail account to send mail via SMTP *(read above)*.
   
   Shpeutd.org now uses this feature to send verification emails when members are registering their accounts. If you would like to work on these features, please read below to setup your workspace. For more information, look at `Account_Creation_and_Verification_Guide.jpg`.
     * ~~If website is on **Awarspace.com:**~~ **(This used the `mail()` function, before PHPMailer was implemented. Furthermore, Awardspace.com is no longer in use. Website was migrated to Infinityfree.net)**
       1. Make sure you have a valid email account setup under **E-Mail Accounts** on the dashboard.
           * **NOTE:** There should already be an account named noreply-accountverify@shpeutd.org, unless someone changed or deleted it. If it's still there, you're done with this step.
       1. Open **registerMember.php** and make sure the email sent to users *(line 168)* is sent with a verification link to `http://shpeutd.org/verifyAccount.php?email='.$email.'&key='.$key.'`
       1. You may now use `mail()` in your PHP. For more information, go here: https://www.awardspace.com/kb/php-mail-function/
       
     * If website is on **XAMPP:**
       * ~~If live website is on **Awardspace.com:**~~ (Awardspace.com is no longer in use. Website was migrated to Infinityfree.net)
         * You need to setup XAMPP to connect with the Awardspace.com email account that will be sending the emails for you.
         1. Copy **php.ini** from `\shpe-utd-website\xampp_and_awardspace.com\sending_email` in this repository and paste it into your `C:\xampp\php` on your computer. Replace the old one already in there.
         1. Copy **sendmail.ini** from `shpe-utd-website\xampp_and_awardspace.com\sending_email` in this repository and paste it into your `C:\xampp\sendmail` on your computer. Replace the old one already in there.
         1. You may now use `mail()` in your PHP. For more information, go here: https://www.awardspace.com/kb/php-mail-function/ and here: http://localhost/dashboard/docs/send-mail.html
       * If live website is on **Infinityfree.net:**
         * Follow the same steps below under "If website is on **Infinityfree.net**". The same steps apply to the website when hosted from XAMPP.
         * **NOTE:** If you are having trouble sending emails from your localhost, but the same file are sending emails on Infinityfree.net, it is very likely your antivirus is just blocking them from sending. Disable your antivirus and firewall.

     * If website is on **Infinityfree.net:**
       1. These PHP lines need to go on top of any file that sends emails:
          ```
          // Import PHPMailer classes into the global namespace
          // These must be at the top of your script, not inside a function
          use PHPMailer\PHPMailer\PHPMailer;
          use PHPMailer\PHPMailer\Exception;
          // Load Composer's autoloader for PHPMailer
          require 'vendor/autoload.php';
          ```
       1. Here is the code for sending a PHP email using PHPMailer on our website:
        ```
        $mail_resend = new PHPMailer(true);
        try
        {
         $mail_resend->isSMTP();                        // Set mailer to use SMTP
         $mail_resend->Host       = 'smtp.gmail.com';   // Specify main and backup SMTP servers
         $mail_resend->SMTPAuth   = true;               // Enable SMTP authentication
         $mail_resend->Username   = 'utdshpe@gmail.com';// SMTP username, our shpe gmail account
         $mail_resend->Password   = '________';         // App Password from previous step
         $mail_resend->SMTPSecure = 'tls';              // Enable TLS encryption, `ssl` also accepted. TLS required with port 587.
         $mail_resend->Port       = 587;                // TCP port to connect to. 587 for Gmail
         $mail_resend->setFrom('utdshpe@gmail.com');
         $mail_resend->addCC('utdshpe@gmail.com');
         $mail_resend->addAddress($email);
         $mail_resend->Subject = '_____';
         $mail_resend->Body    = '_____';
         $mail_resend->send();
        }
        catch (Exception $e)
        {}
        ```
       1. A `vendor` folder needs to be present. This folder contains the files being imported above in PHP. They're the **PHPMailer** files. You can get PHPMailer here: https://github.com/PHPMailer/PHPMailer
       1. Make sure the Gmail is set to **2-Step Verification**
          * Instructions: https://support.google.com/accounts/answer/185839?co=GENIE.Platform%3DDesktop&hl=en
       1. Make sure the Gmail has an **App Pasword** genereated for our website. This password is used during the step below.
          * Instructions: https://support.google.com/accounts/answer/185833
       1. You are done. For more information, go here: https://infinityfree.net/support/how-to-send-email-with-gmail-smtp/
