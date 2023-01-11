<?php  

include("./admin/inc/functions/config.php");


$pass = decrypt("445ef6b560e97e59ced94d83baf9b34dd58625b0", "1234");

echo $pass;