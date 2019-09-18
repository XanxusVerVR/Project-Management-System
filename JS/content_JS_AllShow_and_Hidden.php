<?php
		echo "function All_show(){";
			
				for($i=2;$i<=20;$i++){
					echo "$('.s{$i}').css('display','table-cell');\n";
				}
				for($i=2;$i<=20;$i++){
					echo "$('.i{$i}').css('display','table-cell');\n";
				}
			
		echo "}";
		
		echo "function All_hidden(){";
			
				for($i=2;$i<=20;$i++){
					echo "$('.s{$i}').css('display','none');\n";
				}
				for($i=2;$i<=20;$i++){
					echo "$('.i{$i}').css('display','none');\n";
				}
			
		echo "}"
?>