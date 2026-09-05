<?php echo"
				<table class='table table-responsive text-light contab'>
					<thead style='text-transform:uppercase'>
						<tr>
							<th width='2%' scope='col' style='text-align:center'><small>#</small></th>
							<th scope='col'><small>Year</small></th>
							<th scope='col'><small>Month</small></th>
							<th scope='col'><small>Count</small></th>
							<th scope='col'><small>Labor</small></th>
							<th scope='col'><small>Materials</small></th>
							<th scope='col'><small>Total Sales</small></th>
						</tr>
					</thead>
							
					<tbody style='text-transform:uppercase;border-left:1px solid #bbb;border-right:1px solid #bbb'>";
														
						while($row = $month->fetch_assoc()) {

							$tqry = $link->query("SELECT SUM(labor_cost) FROM transactions WHERE $Year") or die(mysqli_error($link));
							$tary = mysqli_fetch_array($tqry);	

							$mqry = $link->query("SELECT SUM(product_price) FROM trans_details WHERE $Year AND serv_id='".$row["id"]."'") or die(mysqli_error($link));
							$mary = mysqli_fetch_array($mqry);	
								
							$count = $row["count"];
							$labor = $row["labor"];
							$mater = $mary[0];
							$total = $labor+$mater;

							$ConT+=$count;
							$LabT+=$labor;
							$MatT+=$mater;
							$GrdT+=$total;
															
							if($i%2==0) echo"<tr class='odd'>"; else echo"<tr class='even'>";
								
							echo"
								<td scope='row'> <small> <b> $i.</b> </small></td>
								<td scope='row'><small>".$row['year']."</small></td>
								<td scope='row'><small>".$row['month']."</small></td>
								<td scope='row'><small>".number_format($count)."</small></td>
								<td scope='row'><small>&#8369; ".number_format($labor).".00</small></td>
								<td scope='row'><small>&#8369; ".number_format($mater).".00</small></td>
								<td scope='row'><small>&#8369; ".number_format($total).".00</small></td>
							</tr>";
						$i++;
					}
							
					echo"
					</tbody>";
										
					echo"
					<tfoot>
						<td scope='col'><small></small></td>
						<td scope='col'><small></small></td>
						<td scope='col'><small>TOTALS</small></td>
						<td scope='col'><small>".number_format($ConT)."</small></td>
						<td scope='col'><small>&#8369; ".number_format($LabT).".00</small></td>
						<td scope='col'><small>&#8369; ".number_format($MatT).".00</small></td>
						<td scope='col'><small>&#8369; ".number_format($GrdT).".00</small></td>
					</tfoot>
				</table>";
				
			?>