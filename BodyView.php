<?php


	class BodyView{
		public function echoBody($html){
			if($html == NULL){
				throw new \Exception ("html can't be null");
			}
			
			echo "
				<!DOCTYPE>
					<html>
						<head>
						<meta charset='UTF-8'>
						</head>
						<body>
							$html
						</body>
					</html>";
		}
	}
