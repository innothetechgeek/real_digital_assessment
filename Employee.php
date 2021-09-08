<?php
include "Session.php";

class Employee{

    public $id;
    public $name;
    public $lastName;
    public $startDate;
    public $dateOfBirth;
    public $endDate;
    public $lastNotification;
    public $message;

    public function __construct($attributes=[]){

        Session::start();

        if(!empty($attributes)){

            $this->id = $attributes['id'];
            $this->name = $attributes['name'];
            $this->lastName = $attributes['lastname'];            

            $this->dateOfBirth = date("Y-m-m",strtotime($attributes['dateOfBirth']));

            $this->startDate = $attributes['employmentStartDate'];
            $this->endDate = $attributes['employmentEndDate'];
            $this->lastNotification = key_exists('lastNotification',$attributes) ? $attributes['lastNotification'] : "";

        }

    }

    public function setMessage($message){

        $this->message = $message;

    }

    public function sendMessage($customMessage=""){

        
        if (!messageSentAlready($this->id)) {

            $exclusions =  Api::get('https://interview-assessment-1.realmdigital.co.za/do-not-send-birthday-wishes');
            
            if(!in_array($this->id,$exclusions) && empty($this->endDate)){
                $today = date("Y-m-d");
                if($today == $this->dateOfBirth){

                    $birthdayMessage = "Hi $this->name, we wish you a happy birthday. Hope you have a blast!";
                    //send message
                    $this->setSentMessagesForDay($today);
                    
                }
            }

            if($today == $this->startDate){

                //send annivessary message

            }

        }
      

    }

    public function setSentMessagesForDay(){

        Session::set('sentMessages',[
                'employee_id' => $this->id,
                'date_sent' => $day
            ]
        );
    }

    public function getSentMessagesForToday(){

        return Session::get('sentMessages');

    }

    public function messageSentAlready($employeeId){

        $sentMessages = $this->getSentMessagesForToday();

        return in_array($employeeId,array_column($sentMessages, 'employee_id'));

    }

}