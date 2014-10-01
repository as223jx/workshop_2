<?php

require_once 'BoatModel.php';

class BoatView {

	private $model;
	public function __construct() {
		$this -> model = new BoatModel();
	}

	public function echoHtml() {
		$ret = '';

		$ret = $this -> addMemberForm();

		return $ret;
	}
	
	public function showMembers(){
		$memberArray = $this->model->readMember();
		$body = '';

		for($i = 0; count($memberArray) > $i; $i ++){
			// for($j = 0; count($memberArray[$i]) > $j; $j ++){
				// echo $memberArray[$i]['firstname'];
			// }
			$body .= '<tr>
						<td>' . $memberArray[$i]['firstname'] . '</td>
						<td>' . $memberArray[$i]['lastname'] . '</td>
						<td>' . $memberArray[$i]['socialnumber'] . '</td>
						<td>' . $i . '</td>
						<td><a href='. '?delete'. $i . '><button name=' .'delete'.'>Ta bort</button></a></td>
						</tr>';
						
			if($this->didUserPressDelete($i)){
				$this->model->deleteMember($i);
			}
		}
		
		$ret = "
			<div>
				<h2>Båtmedlemmar</h2>
				<table>
					<tr>
						<td>Förnamn</td>
						<td>Efternamn</td>
						<td>Personnummer</td>
						<td>ID</td>
						<td></td>
					</tr>
					$body
				</table>
			</div>
			<a href='?addMember'>Lägg till medlem</a>
			";
		return $ret;
	}

	public function addMemberForm() {
		
		$ret = "
			<form method='post'>
			<fieldset>
				<legend>Registrera ny medlem.</legend>
			Förnamn: <input type='text' name='firstname' value=''/>
			Efternamn: <input type='text' name='lastname' value=''/>
			Personnummer: <input type='text' name='socialnumber' value=''/>
			Lägg till: <input type='submit' name='submit'/>
			</fieldset>
			</form>
			";

		return $ret;
	}

	public function didUserPressSubmit(){

		if (isset($_POST['submit'])) {
			return true;
		}
		return false;
	}
	
	public function didUserPressNewMember(){
		if(isset($_GET['addMember'])){
			return true;
		}
		return false;
	}
	
	public function didUserPressDelete($i){
		if(isset($_GET['delete' . $i])){
			return true;
		}
		return false;
	}
	
	public function saveInput(){

		if (isset($_POST['firstname'])) {
			$firstname = $_POST['firstname'];
			$lastname = $_POST['lastname'];
			$socialnumber = $_POST['socialnumber'];
			
			$this->model->addMember($firstname, $lastname, $socialnumber);
		}
	}
}

