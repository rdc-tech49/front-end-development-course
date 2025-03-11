<?php

// $_SESSION['email'] = $user['email'];
// $_SESSION['user_id'] = $user['user_id'];
// $_SESSION['name'] = $user['user_name'];


//***************** */
// Set the timezone to India Standard Time (IST)
//date_default_timezone_set('Asia/Kolkata');

echo date("Y-m-d H:i:s");
// Get the current default timezone
$current_timezone = date_default_timezone_get();

// Print the current timezone
echo "Current timezone: " . $current_timezone;

?>