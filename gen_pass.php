<?php
			$cash_name='5000001';
			$access_level='Cashier';
			$resinfo = $cash_name."".$access_level;
			$pass = array(); //remember to declare $pass as an array
			$alphaLength = strlen($resinfo) - 1; //put the length -1 in cache
			for ($i = 0; $i < 8; $i++) {
				$n = rand(0, $alphaLength);
				$pass[] = $resinfo[$n];
			}
			echo $Gpassword = implode($pass); //turn the array into a string
			?>