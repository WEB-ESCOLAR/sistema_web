	
	
	<?php if($_SESSION["rol"] == "director"){?>

			

		<div style="margin:auto;">
		<div style="display:flex;justify-content: space-between;">
			<div style="width:45%">
				<canvas id="myChart" width="300" height="150"></canvas>
			</div>
			<div style="background: green;width:45%;height:280px;">
				
			</div>
		</div>
			<div style="background: dodgerblue;width:100%;height:250px;margin-top:20px;">
					
			</div>
		<div style="display:flex;justify-content: space-between;margin-top:20px;">
			<div style="background: yellow;width:45%;height:280px;">
				
			</div>
			<div style="background: green;width:45%;height:280px;">
				
			</div>
		</div>


		</div>

	<?php }else{ ?>
		<div style="margin:auto;">
			<div style="display:flex;justify-content: space-between;">
			<div style="background: yellow;width:45%;height:280px;">
			
			</div>
			<div style="background: green;width:45%;height:280px;">
				
			</div>
		</div>
			<div style="background: dodgerblue;width:100%;height:250px;margin-top:20px;">
					
			</div>
		</div>
 
	<?php } ?>