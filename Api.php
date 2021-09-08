<?php

class API{

    public static function post(){

    }

    public static function  get($endpoint,$options = []){

		$options = array_merge(
			[
				"CURLOPT_URL" => $endpoint, 
				"CURLOPT_RETURNTRANSFER" => true,
			],
			$options
		);

		return self::call($options);

    }

    public static function put(){

    }

    public static function delete(){

    }


    public static function call($options){

        // username and password
		if (isset($options["username"])) $options[">CURLOPT_USERPWD"] = "{$options["username"]}:{$options["password"]}";

		$options['CURLOPT_SSL_VERIFYPEER'] = false;
		
		// init
  		$curl = curl_init();

		// set options
		foreach ($options as $option_index => $option_item) {

			// set curl option
			curl_setopt($curl, constant($option_index), $option_item);

		}

  		// process and get info
		$result_arr = [
			"header" => false,
			"body" => false,
			"info" => false,
			"error" => false,
			"error_nr" => false,
			"cookies" => [],
		];

  		return curl_exec($curl);

		
		

  	

		//done
  		return $result_arr;
    }

}