<?php
// Use following composer command to download PHP-JWT which will create vendor/autoload.php file:
// composer require firebase/php-jwt
require 'vendor/autoload.php';
use Firebase\JWT\JWT;
use Firebase\JWT\Key;


if(isset($_COOKIE['ph_email_jwt'])){
    try {
        $api_key = 'XXXXXXXXXXXXXXXXXXXXXX'; // Please specify API key provided in profile section of Phone Email Admin Dashboard (https://admin.phone.email) 
        $decoded = JWT::decode($_COOKIE['ph_email_jwt'], new Key($api_key, 'HS256'));
        $jwt_phone = $decoded->country_code.$decoded->phone_no; // You will get user phone number here from JWT


        //setcookie('ph_email_jwt', $_COOKIE['ph_email_jwt'], time() + (86400 * 180),"/");

        // Register User: As the user phone number has been verified successfully. If user corrosponding to this verified  mobile number does not exist in your user table then register the user by creating a row in user table. If user already exists then simply continue to the next step.

        // Send Email: We reccomend you to send welcome email to the user. 
        //curl --location --request POST "https://api.phone.email/v1/sendmail" --ssl-no-revoke --header "Content-Type: application/json" --data-raw "{'apiKey':'API_KEY','fromCountryCode':'XXX','fromPhoneNo':'XXXXXXXXXX', 'toCountrycode':'XX','toPhoneNo':'XXXXXXXXXX','subject': 'Welcome to YOUR_BUSINESS_NAME','tinyFlag':true,'messageBody':'V2VsY29tZSB0byB5b3VyIEJVU0lORVNTX05BTUU='}"

        // Create Session: Store verified user phone number in session variable.

        // Redirect: Redirect user to the page of your choice as the user has successfully logged in.
 
        if(isset($_COOKIE['ph_email_origin_url'])){
          header('Location:'.$_COOKIE['ph_email_origin_url'].'');
        }

        // Handle Logout (Optional): You can create logout button on your website as required.In the event of logout you must clear delete ph_email_jwt cookie and clear your session variables.  To delete cookie simply set it to blank -> setcookie("ph_email_jwt", "", time()-3600);

    } catch (Exception $e) {
            //catch exception here
            echo '<h2>Error: Invalid API key</h2>';die;
        $jwt_phone = '';
    }
}else{
    $jwt_phone = '';
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="msapplication-TileColor" content="#0E0E0E">
  <meta name="template-color" content="#0E0E0E">
  <meta name="description" content="">
  <meta name="keywords" content="free SMS,OTP,phone email,free sms otp service">
  <meta name="author" content="phone.email">
  <title>Login Success</title>

  <style scoped>
    .phem-container {
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .phem-card {
      color: #024430 !important;
      text-align: center;
      background-color: #fff;
      padding: 60px 30px;
      border-radius: 0.5rem;
      box-shadow: 0 1px 3px rgba(17, 24, 39, .09);
      max-width: 420px;
      margin: 0 auto;
      font-family: sans-serif, serif, system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
      line-height: 28px;
    }
  </style>
</head>

<body style="background-color: #f1f5f9;">
  <div class="phem-container">
    <div class="phem-card">
      <svg width="72" height="72" viewBox="0 0 114 114" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path
          d="M56.95 0C25.485 0 0 25.49 0 56.95C0 88.415 25.49 113.9 56.95 113.9C88.415 113.9 113.9 88.41 113.9 56.95C113.9 25.49 88.41 0 56.95 0ZM52.47 79.17L29.315 56.11L35.945 49.48L52.47 66.005L82.16 36.315L88.79 42.945L52.47 79.17Z"
          fill="#02BD7E" />
      </svg>
      <div class="phem-card-body">
      <h2 class="phem-card-title">Hi <?php echo $_COOKIE['login_form_fname'].' '.$_COOKIE['login_form_lname'];?>, <?php  echo '<br>'; ?> You are logged in Successfully!</h2>
        <p class="phem-card-text">You are logged in successfully with <?php echo $jwt_phone;?> </p>
      </div>

      <button onclick="location.href='logout.php'">Logout</button>
    </div>
  </div>


   <!-- Email alert start: Include this email alert code block in footer to show email alert on all pages  -->
   <div id="pheIncludedContent"></div>
    <script src="https://auth.phone.email/login_custom_v1_1.js"></script>
    <script>
        var reqJson = '{"email_notification":"icon","button_position":"left"}';
        log_in_with_phone(reqJson);
    </script>
    <!-- End of email alert block  -->

</body>

</html>