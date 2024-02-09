<?php 

setcookie("ph_email_jwt", "", time()-3600);
header('Location: /');