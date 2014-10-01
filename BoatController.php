<?php

require_once 'BoatModel.php';
require_once 'BoatView.php';

	class BoatController{
		private $view;
		private $model;
		public function __construct(){
			$this->model = new BoatModel();
			$this->view = new BoatView($this->model);
			
		}
		
		public function control(){
			
			if($this->view->didUserPressSubmit()){
				$this->view->saveInput();
				return $this->view->showMembers();	
			}
			
			if($this->view->didUserPressNewMember()){
				return $this->view->addMemberForm();
			}
			
			return $this->view->showMembers();
			
			
		}
	}