<?php

class JsonParser{
	
	public function get($directory){

		$data = array();

		// Read all json files of the directory
		$json_files = glob('../application/models/'.$directory.'/'.'*.json');

		foreach($json_files as $file){

			$file_data = (array) json_decode(file_get_contents($file));

			$key = ($file_data['big_project']) ? '2' : '1';

			$data[$key.strtotime($file_data['date'])] = $file_data;
			$data[$key.strtotime($file_data['date'])]['date_parsed'] = date('d.m.Y - H:i', strtotime($file_data['date']));

		}

		krsort($data);

		return $data;

	}

}