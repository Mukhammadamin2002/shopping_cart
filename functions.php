<?php 

$email = '';
$phone = '';
$name = '';
$address = '';

if (isset($_POST['submit'])) {

		$email = sanitize($_POST['email']) ?? '';
		// $name = sanitize($_POST['name']) ?? '';
  //       $phone = sanitize($_POST['phone']) ?? '';
		// $address = sanitize($_POST['address']) ?? '';

			if (empty($email)) {
				
				$errors['email'] = 'Email is required';
			} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$errors['email'] = 'Invalid email adderss';
			}

			if (empty($name)) {
				$errors['name'] = 'Name is required';
			} elseif (!preg_match("/^([a-zA-Z ])*$/", $name)) {
				$errors = 'Only lettersand white space alllowed';
			} 


}

     function sanitize($data)
   {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
   }

?>