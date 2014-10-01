<?php

class BoatModel {
	private $firstname;
	private $lastname;
	private $socialnumber;
	private $filePath = 'members.txt';

	public function addMember($firstname,$lastname,$socialnumber) {

		
		//Hämtar existerande data från filen		
		if(file_exists($this->filePath)){
			$getExistingData = file_get_contents($this->filePath);

			if($getExistingData == null){
				$memberID = 0;
			}
			else{
				$existingData = $this->readMember();
				var_dump($existingData);
				$memberID = count($existingData);
			}
		}
		
		//Skapar array av inmatad data
		$member = array("firstname" => $firstname,
						"lastname" => $lastname,
						"socialnumber" => $socialnumber,
						"ID" => $memberID);
		$data = serialize($member);
		
		//$existingData = serialize($existingData);
		
		if(is_writable($this->filePath)){
			$fp = fopen($this->filePath, "w");

			if($getExistingData != null){
				fwrite($fp, $existingData . "\n" . $data);
			}
			else {
				fwrite($fp, $data);
			}
			fclose($fp);
		}
	}
	
	public function writeToFile($data){
		
		$getExistingData = file_get_contents($this->filePath);
		
		if(is_writable($this->filePath)){
			$fp = fopen($this->filePath, "w");

			if($getExistingData != null){
				fwrite($fp, $data);
			}
			else {
				fwrite($fp, $data);
			}
			fclose($fp);
		}
	}
	
	public function readMember(){
		if(file_exists($this->filePath)){
		$fopen = fopen($this->filePath, "r");
			while(!feof($fopen)){
				$line = fgets($fopen);
				$line = unserialize($line);
				$linesArr[] = $line;
			}
		return $linesArr;
		}
	}
	
	public function deleteMember($i){
		if(file_exists($this->filePath)){
		$fopen = fopen($this->filePath, "r");
			while(!feof($fopen)){
				$line = fgets($fopen);
				$line = unserialize($line);
				$linesArr[] = $line;
			}
		}
		var_dump($linesArr);		
		unset($linesArr[$i]);
		var_dump($linesArr);
		$data = serialize($linesArr);
		var_dump($data);
		$this->writeToFile($data);
	}
}
