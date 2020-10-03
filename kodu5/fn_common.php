<?php
function test_input($data){
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
function test_email($email){
  $email = filter_var($email, FILTER_SANITIZE_EMAIL);
  return $email;
}
