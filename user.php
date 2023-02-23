<?php
class User{
public $first_name;
public $last_name;
public $phone;
public $email;
public $marks;

//setter methods
function setFirstName($first_name){
$this->first_name=$first_name;
}
function setLastName($last_name){
$this->last_name=$last_name;
}
function setPhone($phone){
$this->phone=$phone;
}
function setMail($email){
$this->email=$email;
}
function setMarks($marks){
    $this->marks=$marks;
    }


//getter methods
function getFirstName(){
return $this->first_name;
}
function getLastName(){
    return $this->last_name;
    }
function getPhone(){
    return $this->phone;
}
function getEmail(){
    return $this->email;
}
function getMarks(){
    return $this->marks;
}
}
?>