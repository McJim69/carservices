<?php 
	require("../admin_reports_chart_proc.php");
?>

<script>
	window.onload = function () {
		var chart1 = new CanvasJS.Chart("chartContainer1",
		{
			axisY:{
				lineColor: "#bbb",
				labelFontColor: "#bbb",
			},
			
			axisX:{
				lineColor: "#bbb",
				labelFontColor: "#bbb",
			},
			
			theme: "light",
			backgroundColor: "transparent",
			title:{
			
 			text: "Php <?php echo number_format($sales,2);?>", 
				fontColor:"lightgreen",
				fontSize: 18,
			},		
						
			data: [{    
			//	type: "area",
			//	type: "bar",
			//	type: "bubble",
				type: "column",
			//	type: "doughnut",
			//	type: "spline",
			//	type: "pie",
					
			toolTipContent: "{indexLabel} ({y}) {per}%", 
			legendText: "{indexLabel}",
			indexLabelFontColor: "white",
			dataPoints: [
				{ y: <?php echo $janT;?>, indexLabel: "<?php echo $jan;?>", per: <?php echo $janP;?> },
				{ y: <?php echo $febT;?>, indexLabel: "<?php echo $feb;?>", per: <?php echo $febP;?> },
				{ y: <?php echo $marT;?>, indexLabel: "<?php echo $mar;?>", per: <?php echo $marP;?> },
				{ y: <?php echo $aprT;?>, indexLabel: "<?php echo $apr;?>", per: <?php echo $aprP;?> },
				{ y: <?php echo $mayT;?>, indexLabel: "<?php echo $may;?>", per: <?php echo $mayP;?> },
				{ y: <?php echo $junT;?>, indexLabel: "<?php echo $jun;?>", per: <?php echo $junP;?> },
				{ y: <?php echo $julT;?>, indexLabel: "<?php echo $jul;?>", per: <?php echo $julP;?> },
				{ y: <?php echo $augT;?>, indexLabel: "<?php echo $aug;?>", per: <?php echo $augP;?> },
				{ y: <?php echo $sepT;?>, indexLabel: "<?php echo $sep;?>", per: <?php echo $sepP;?> },
				{ y: <?php echo $octT;?>, indexLabel: "<?php echo $oct;?>", per: <?php echo $octP;?> },
				{ y: <?php echo $novT;?>, indexLabel: "<?php echo $nov;?>", per: <?php echo $novP;?> },
				{ y: <?php echo $decT;?>, indexLabel: "<?php echo $dec;?>", per: <?php echo $decP;?> }
			]
			}]
		});		
		var chart2 = new CanvasJS.Chart("chartContainer2",
		{
			axisY:{
				lineColor: "#bbb",
				labelFontColor: "#bbb",
			},
			
			axisX:{
				lineColor: "#bbb",
				labelFontColor: "#bbb",
			},

			theme: "light",
			backgroundColor: "transparent",
			title:{
			//	text: "Sales by Payment Status", 
			//	fontColor:"white",
			},		
			
			data: [{    
			//	type: "area",
			//	type: "bar",
			//	type: "bubble",
			//	type: "column",
				type: "doughnut",
			//	type: "spline",
			//	type: "pie",
					
			toolTipContent: "{indexLabel} ({y}) {per}%",
			legendText: "{indexLabel}",
			indexLabelFontColor: "white",
			indexLabelFontSize: 12,
			dataPoints: [
				{ y: <?php echo $pdtt;?>, indexLabel: "Paid", per: <?php echo $pdpa;?> },
				{ y: <?php echo $pntt;?>, indexLabel: "Pending", per: <?php echo $pnpa;?> },
				{ y: <?php echo $cltt;?>, indexLabel: "Collectable", per: <?php echo $clpa;?> }
			]

			}]
		});		
		
		chart1.render();
		chart2.render();
	}
</script>	