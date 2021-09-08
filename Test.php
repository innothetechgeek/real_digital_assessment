<?php

include_once "Api.php";
include_once "Employee.php";

$result = Api::get("https://interview-assessment-1.realmdigital.co.za/employees",[]);

$employees_arr =  json_decode($result['body'],true);

/*
 foreach($employees_arr as $key => $employee_attributes){

    $employee = new Employee($employee_attributes);
    //$employee->sendMessage();
} */

$employee = new Employee();
$employee->id = 567;
$employee->dateOfBirth = '2021-09-08';
$employee->sendMessage();

$employee = new Employee();
$employee->id = 568;
$employee->dateOfBirth = '2021-09-08';
$employee->sendMessage();

$employee = new Employee();
$employee->id = 569;
$employee->dateOfBirth = '2021-09-08';
$employee->sendMessage();


//var_dump($result);