<?php

include_once "Api.php";
include_once "Employee.php";

$result = Api::get("https://interview-assessment-1.realmdigital.co.za/employees",[]);

$employees_arr =  json_decode($result,true);

foreach($employees_arr as $key => $employee_attributes){

    $employee = new Employee($employee_attributes);
    $employee->sendMessage();

    var_dump( $employee);
}

//foreac

//var_dump($result);