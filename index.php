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
        if(!isset($_GET['user_json_url'])){
    ?>

    <!-- Display Login Button -->
    <div class="phem-container">
        <div class="phem-card">

            <img class="phe-login-img" width="250px" src="https://storage.googleapis.com/prod-phoneemail-prof-images/phem-widgets/phe-signin-box.svg"
                alt="phone email login demo">
            <h1 style="margin:10px; 0">Sign In</h1>
            <p style="color:#a6a6a6;">Welcome to Sign In with Phone  </p>

            <div class="pe_signin_button" data-client-id="XXXXXXXXXXXXXXXXX"><script src="https://www.phone.email/sign_in_button_v1.js" async></script></div>
            <script>
                function phoneEmailListener(userObj){
                    var user_json_url = userObj.user_json_url;
                    // You can submit your form here or redirect user to post login dashboard page
                    // Send user_json_url to your backend to retrieve user info (i.e. country code and phone number) from this URL.
                    
                    location.href='?user_json_url='+user_json_url+'';
                    
                }
            </script> 
        </div>
    </div>

    <?php } ?>


    <?php 
    
    if(isset($_GET['user_json_url'])){

        $json_data = file_get_contents($_GET['user_json_url']);
        $data = json_decode($json_data, true);

        $country_code = $data['user_country_code'];
        $phone_no = $data['user_phone_number'];
       
        ?>

    <div class="phem-container">
        <div class="phem-card">
            <img class="phe-login-img" width="250px" src="https://storage.googleapis.com/prod-phoneemail-prof-images/phem-widgets/phe-signin-success.svg"
                alt="phone email login demo">
            <div class="phem-card-body">
                <h1>Welcome!</h1>
                <h4 style="line-height:36px;">You are logged in successfully with <br />
                    <?php echo $country_code.$phone_no;?></h4>

            </div>

            <button
                style="display: flex; align-items: center; justify-content:center; padding: 14px 20px; background-color: #02BD7E; font-weight: bold; color: #ffffff; border: none; border-radius: 3px; font-size: inherit;cursor:pointer; max-width:320px; width:100%"
                onclick="location.href='/'">Back</button>
        </div>
    </div>

    <?php
    } ?>

</body>

</html>