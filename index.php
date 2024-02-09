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
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
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
            padding: 60px 30px;
            border-radius: 0.5rem;
            box-shadow: 0 1px 3px rgba(17, 24, 39, .09);
            width: 100%;
            max-width: 420px;
            margin: 0 auto;
            font-family: sans-serif, serif, system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            line-height: 28px;
            display: flex;
            flex-direction: column;
        }
    </style>
</head>

<body style="background-color: #f1f5f9;">

    <div class="phem-container">
        <div class="phem-card">
            <input class="phem-input" type="text" placeholder="First Name" id="fname" onchange="add_fname()">
            <input class="phem-input" type="text" placeholder="Last Name" id="lname" onchange="add_lname()">

            <!-- Button code start -->
            <script>
            var country_code = 'XXX';
            var phone_no = 'XXXXXXXXXX';

            var redirect_url = new URL(location.href);
            var auth_url = 'https://www.phone.email/auth/sign-in?countrycode=' + country_code + '&phone_no=' + phone_no + '&auth_type=2&redirect_url=' + redirect_url + '';
            </script>

            <button
                style="display: flex; align-items: center; justify-content:center; padding: 10px 15px; background-color: #02BD7E; font-weight: bold; color: #ffffff; border: none; border-radius: 3px; font-size: inherit;cursor:pointer;"
                id="btn_ph_login" name="btn_ph_login" type="button"
                onclick="window.open(''+auth_url+'', 'peLoginWindow', 'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0, width=500, height=560, top=' + (screen.height - 600) / 2 + ', left=' + (screen.width - 500) / 2);">
                <img src="https://storage.googleapis.com/prod-phoneemail-prof-images/phem-widgets/phem-phone.svg"
                    alt="phone email" style="margin-right:5px;">
                Sign in with Phone
            </button>
            <!-- Button code end -->
            
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

    <script>
        const cookieCheck = (document.cookie.match(/ph_email_jwt\s*=\s*([^;]+)/) || [, null])[1];
        if (cookieCheck !== null) {
            // for php uncomment line below
            location.href = 'success.php';

            //for node js uncomment line below
            // call REST API (NodeJS/php/python/java)

        }
    </script>


    <script>
        function add_fname() {
            fieldval = document.getElementById('fname').value;

            const expirationDate = new Date();
            expirationDate.setDate(expirationDate.getDate() + 360);
            document.cookie = `login_form_fname=` + fieldval + `; expires=${expirationDate.toUTCString()}; path=/`;
        }

        function add_lname() {
            fieldval = document.getElementById('lname').value;
            const expirationDate = new Date();
            expirationDate.setDate(expirationDate.getDate() + 360);
            document.cookie = `login_form_lname=` + fieldval + `; expires=${expirationDate.toUTCString()}; path=/`;
        }
    </script>

</body>

</html>