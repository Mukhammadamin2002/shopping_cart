<?php
// define variables and set to empty values
$emailErr = $passwordErr = $addressErr = $phone_numberErr = $zip_zodeErr = "";
$email = $password = $zip_zode = $phone_number = $address = "";

if (isset($_POST['submit']))
{


   if (empty($_POST["email"])){
    $emailErr = "Email is required";}
   else{
    $email = test_input($_POST["email"]);}

   if (empty($_POST["password"])){
    $nameErr = "password is required";}
   else{
    $password = test_input($_POST["password"]);}

   if (empty($_POST["address"])){
    $address = "";}
   else{
    $address = test_input($_POST["address"]);}

   if (empty($_POST["phone_number"])){
    $phone_number = "";}
   else{
    $phone_number = test_input($_POST["phone_number"]);}

   if (empty($_POST["zip_zode"])){
    $genderErr = "zip_zode is required";}
   else{
    $zip_zode = test_input($_POST["zip_zode"]);}

}

function test_input($data){

     $data = trim($data);
     $data = stripslashes($data);
     $data = htmlspecialchars($data);
     return $data;
}
?>