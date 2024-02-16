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
    <meta name="author" content="">
    <title>New sign in</title>

    <style>
    .phem-container {
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 50px 0;
    }

    .phem-input {
        padding: 12px 20px;
        display: inline-block;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        margin-bottom: 20px;
    }

    .phem-card {
        color: #024430 !important;
        text-align: center;
        background-color: #fff;
        padding: 30px;
        border-radius: 0.5rem;
        box-shadow: 0 1px 3px rgba(17, 24, 39, .09);
        width: 100%;
        max-width: 420px;
        margin: 0 auto;
        font-family: sans-serif, serif, system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        line-height: 28px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }
    </style>
</head>


<body style="background-color: #f1f5f9;">

    <?php 
        /* Please replace XXXXXXXXXX with client id shown under profile section in admin dashboard (https://admin.phone.email) */
        $CLIENT_ID = 'XXXXXXXXXXXXXXXXX';
        $REDIRECT_URL = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https://" : "http://") . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $AUTH_URL = 'https://auth.phone.email/log-in?client_id='.$CLIENT_ID.'&redirect_url='.$REDIRECT_URL.'';
    ?>


    <?php
        if(!isset($_GET['access_token'])){
    ?>

    <!-- Display Login Button -->
    <div class="phem-container">
        <div class="phem-card">

            <img class="phe-login-img" width="250px" src="assets/imgs/page/login/phe-signin-box.svg"
                alt="phone email login demo">
            <h1 style="margin:10px; 0">Sign In</h1>
            <p style="color:#a6a6a6;">Welcome to Sign In with Phone  </p>

            <button
                style="display: flex; align-items: center; justify-content:center; padding: 14px 20px; background-color: #02BD7E; font-weight: bold; color: #ffffff; border: none; border-radius: 3px; font-size: inherit;cursor:pointer; max-width:320px; width:100%"
                id="btn_ph_login" name="btn_ph_login" type="button"
                onclick="window.open('<?php echo $AUTH_URL; ?>', 'peLoginWindow', 'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0, width=500, height=560, top=' + (screen.height - 600) / 2 + ', left=' + (screen.width - 500) / 2);">
                <img src="https://storage.googleapis.com/prod-phoneemail-prof-images/phem-widgets/phem-phone.svg"
                    alt="phone email" style="margin-right:10px;">
                Sign In with Phone
            </button>

        </div>
    </div>

    <?php } ?>


    <?php 
    
    /* After successful phone number verification an access_token will be returned by auth verification popup. In this if condition  please use this access_token to call Phone Email API to get verified phone number.  */
    if(isset($_GET['access_token'])){

        /* To get verified phone number please call the getuser API */

        // Initialize cURL session
        $ch = curl_init();
        $url = "https://eapi.phone.email/getuser";
        $postData = array(
            'access_token' => $_GET['access_token'],
            'client_id' => $CLIENT_ID
        );

        // Set cURL options
        curl_setopt($ch, CURLOPT_URL, $url); // URL to submit the POST request
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return the response as a string instead of outputting it directly
        curl_setopt($ch, CURLOPT_POST, true); // Set the request type to POST
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData); // Set the POST data
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Ignore SSL certificate verification (not recommended in production)

        $response = curl_exec($ch);

        if ($response === false) {
            echo "cURL error: " . curl_error($ch);
            header('Location: /demo-login');
        } 

        curl_close($ch);

        $json_data = json_decode($response,true);

        if($json_data['status'] != 200) {
            header('Location: /demo-login');
        }
            
        $country_code = $json_data['country_code'];
        $phone_no = $json_data['phone_no'];
        $ph_email_jwt = $json_data['ph_email_jwt'];
        setcookie('ph_email_jwt', $ph_email_jwt, time() + (86400 * 30), "/"); // 86400 = 1 day

        // Register User: As the user phone number has been verified successfully. If user corrosponding to this verified  mobile number does not exist in your user table then register the user by creating a row in user table. If user already exists then simply continue to the next step.

        // Send Email: We reccomend you to send welcome email to the user.
        //curl --location --request POST "https://api.phone.email/v1/sendmail" --ssl-no-revoke --header "Content-Type: application/json" --data-raw "{'apiKey':'API_KEY','fromCountryCode':'XXX','fromPhoneNo':'XXXXXXXXXX', 'toCountrycode':'XX','toPhoneNo':'XXXXXXXXXX','subject': 'Welcome to YOUR_BUSINESS_NAME','tinyFlag':true,'messageBody':'V2VsY29tZSB0byB5b3VyIEJVU0lORVNTX05BTUU='}"

        // Create Session: Store verified user phone number in session variable.

        // Redirect: Redirect user to the page of your choice as the user has successfully logged in.

        // Handle Logout (Optional): You can create logout button on your website as required.In the event of logout you must clear delete ph_email_jwt cookie and clear your session variables.  To delete cookie simply set it to blank -> setcookie("ph_email_jwt", "", time()-3600);
        ?>

    <div class="phem-container">
        <div class="phem-card">
            <img class="phe-login-img" width="250px" src="assets/imgs/page/login/phe-signin-success.svg"
                alt="phone email login demo">
            <div class="phem-card-body">
                <h1>Welcome!</h1>
                <h4 style="line-height:36px;">You are logged in successfully with <br />
                    <?php echo $country_code.$phone_no;?></h4>

            </div>

            <button
                style="display: flex; align-items: center; justify-content:center; padding: 14px 20px; background-color: #02BD7E; font-weight: bold; color: #ffffff; border: none; border-radius: 3px; font-size: inherit;cursor:pointer; max-width:320px; width:100%"
                onclick="location.href='/demo-login'">Back</button>
        </div>
    </div>

    <?php
    } ?>

</body>

</html>