<!-- // Chart by Months	// -->

<?php

//	error_reporting(1);
	$jan = "JAN";
	$feb = "FEB";
	$mar = "MAR";
	$apr = "APR";
	$may = "MAY";
	$jun = "JUN";
	$jul = "JUL";
	$aug = "AUG";
	$sep = "SEP";
	$oct = "OCT";
	$nov = "NOV";
	$dec = "DEC";

	$janwD = "WHERE serv_date BETWEEN '$post-01-01' and '$post-01-31'";
	$janlQ = $link->query("SELECT SUM(labor_cost) AS total FROM transactions $janwD");							
	$janlA = $janlQ->fetch_assoc();
	$janlT+= $janlA["total"];				
	$janmQ = $link->query("SELECT SUM(product_price) AS total FROM trans_details $janwD");								
	$janmA = $janmQ->fetch_assoc();
	$janmT+= $janmA["total"];				
	$janT  = $janlT+$janmT;

	$febwD = "WHERE serv_date BETWEEN '$post-02-01' and '$post-02-29'";
	$feblQ = $link->query("SELECT SUM(labor_cost) AS total FROM transactions $febwD");							
	$feblA = $feblQ->fetch_assoc();
	$feblT+= $feblA["total"];				
	$febmQ = $link->query("SELECT SUM(product_price) AS total FROM trans_details $febwD");						
	$febmA = $febmQ->fetch_assoc();
	$febmT+= $febmA["total"];				
	$febT  = $feblT+$febmT;

	$marwD = "WHERE serv_date BETWEEN '$post-03-01' and '$post-03-31'";
	$marlQ = $link->query("SELECT SUM(labor_cost) AS total FROM transactions $marwD");							
	$marlA = $marlQ->fetch_assoc();
	$marlT+= $marlA["total"];				
	$marmQ = $link->query("SELECT SUM(product_price) AS total FROM trans_details $marwD");							
	$marmA = $marmQ->fetch_assoc();
	$marmT+= $marmA["total"];				
	$marT  = $marlT+$marmT;

	$aprwD = "WHERE serv_date BETWEEN '$post-04-01' and '$post-04-31'";
	$aprlQ = $link->query("SELECT SUM(labor_cost) AS total FROM transactions $aprwD");							
	$aprlA = $aprlQ->fetch_assoc();
	$aprlT+= $aprlA["total"];				
	$aprmQ = $link->query("SELECT SUM(product_price) AS total FROM trans_details $aprwD");							
	$aprmA = $aprmQ->fetch_assoc();
	$aprmT+= $aprmA["total"];				
	$aprT  = $aprlT+$aprmT;

	$maywD = "WHERE serv_date BETWEEN '$post-05-01' and '$post-05-31'";
	$maylQ = $link->query("SELECT SUM(labor_cost) AS total FROM transactions $maywD");							
	$maylA = $maylQ->fetch_assoc();
	$maylT+= $maylA["total"];				
	$maymQ = $link->query("SELECT SUM(product_price) AS total FROM trans_details $maywD");							
	$maymA = $maymQ->fetch_assoc();
	$maymT+= $maymA["total"];				
	$mayT  = $maylT+$maymT;

	$junwD = "WHERE serv_date BETWEEN '$post-06-01' and '$post-06-31'";
	$junlQ = $link->query("SELECT SUM(labor_cost) AS total FROM transactions $junwD");							
	$junlA = $junlQ->fetch_assoc();
	$junlT+= $junlA["total"];				
	$junmQ = $link->query("SELECT SUM(product_price) AS total FROM trans_details $junwD");							
	$junmA = $junmQ->fetch_assoc();
	$junmT+= $junmA["total"];				
	$junT  = $junlT+$junmT;

	$julwD = "WHERE serv_date BETWEEN '$post-07-01' and '$post-07-31'";
	$jullQ = $link->query("SELECT SUM(labor_cost) AS total FROM transactions $julwD");							
	$jullA = $jullQ->fetch_assoc();
	$jullT += $jullA["total"];				
	$julmQ = $link->query("SELECT SUM(product_price) AS total FROM trans_details $julwD");								
	$julmA = $julmQ->fetch_assoc();
	$julmT+= $julmA["total"];				
	$julT  = $jullT+$julmT;

	$augwD = "WHERE serv_date BETWEEN '$post-08-01' and '$post-08-31'";
	$auglQ = $link->query("SELECT SUM(labor_cost) AS total FROM transactions $augwD");							
	$auglA = $auglQ->fetch_assoc();
	$auglT+= $auglA["total"];				
	$augmQ = $link->query("SELECT SUM(product_price) AS total FROM trans_details $augwD");							
	$augmA = $augmQ->fetch_assoc();
	$augmT+= $augmA["total"];				
	$augT  = $auglT+$augmT;

	$sepwD = "WHERE serv_date BETWEEN '$post-09-01' and '$post-09-31'";
	$seplQ = $link->query("SELECT SUM(labor_cost) AS total FROM transactions $sepwD");							
	$seplA = $seplQ->fetch_assoc();
	$seplT+= $seplA["total"];				
	$sepmQ = $link->query("SELECT SUM(product_price) AS total FROM trans_details $sepwD");								
	$sepmA = $sepmQ->fetch_assoc();
	$sepmT+= $sepmA["total"];				
	$sepT  = $seplT+$sepmT;

	$octwD = "WHERE serv_date BETWEEN '$post-10-01' and '$post-10-31'";
	$octlQ = $link->query("SELECT SUM(labor_cost) AS total FROM transactions $octwD");							
	$octlA = $octlQ->fetch_assoc();
	$octlT+= $octlA["total"];				
	$octmQ = $link->query("SELECT SUM(product_price) AS total FROM trans_details $octwD");								
	$octmA = $octmQ->fetch_assoc();
	$octmT+= $octmA["total"];				
	$octT  = $octlT+$octmT;

	$novwD = "WHERE serv_date BETWEEN '$post-11-01' and '$post-11-31'";
	$novlQ = $link->query("SELECT SUM(labor_cost) AS total FROM transactions $novwD");							
	$novlA = $novlQ->fetch_assoc();
	$novlT += $novlA["total"];				
	$novmQ = $link->query("SELECT SUM(product_price) AS total FROM trans_details $novwD");							
	$novmA = $novmQ->fetch_assoc();
	$novmT+= $novmA["total"];				
	$novT  = $novlT+$novmT;

	$decwD = "WHERE serv_date BETWEEN '$post-12-01' and '$post-12-31'";
	$declQ = $link->query("SELECT SUM(labor_cost) AS total FROM transactions $decwD");							
	$declA = $declQ->fetch_assoc();
	$declT+= $declA["total"];				
	$decmQ = $link->query("SELECT SUM(product_price) AS total FROM trans_details $decwD");							
	$decmA = $decmQ->fetch_assoc();
	$decmT+= $decmA["total"];				
	$decT  = $declT+$decmT;	

	$sales = $janT + $febT + $marT + $aprT + $mayT + $junT + $julT + $augT + $sepT + $octT + $novT + $decT;
		
	$janA=($janT*100)/$sales;
	$janP=round($janA);

	$febA=($febT*100)/$sales;
	$febP=round($febA);

	$marA=($marT*100)/$sales;
	$marP=round($marA);

	$aprA=($aprT*100)/$sales;
	$aprP=round($aprA);

	$mayA=($mayT*100)/$sales;
	$mayP=round($mayA);

	$junA=($junT*100)/$sales;
	$junP=round($junA);

	$julA=($julT*100)/$sales;
	$julP=round($julA);

	$augA=($augT*100)/$sales;
	$augP=round($augA);

	$sepA=($sepT*100)/$sales;
	$sepP=round($sepA);

	$octA=($octT*100)/$sales;
	$octP=round($octA);

	$novA=($novT*100)/$sales;
	$novP=round($novA);

	$decA=($decT*100)/$sales;
	$decP=round($decA);

?>
<!-- // Chart by Status	// -->
<?php	
	$paid = "AND payment = 'Paid'";
	$pend = "AND payment = 'Pending'";
	$coll = "AND payment = 'Collectable'";

	$tran = "transactions  WHERE serv_date BETWEEN '$post-01-01' and '$post-12-31' ";	
	$dets = "trans_details WHERE serv_date BETWEEN '$post-01-01' and '$post-12-31' ";	
		
	$pdlq = $link->query("SELECT SUM(labor_cost) AS total FROM $tran $paid");							
	$pdla = $pdlq->fetch_array();
	$pdtt+= $pdla["total"];					
	$pdmq = $link->query("SELECT SUM(product_price) AS total FROM $dets $paid");								
	$pdma = $pdmq->fetch_array();
	$pdtt+= $pdma["total"];

	$pnlq = $link->query("SELECT SUM(labor_cost) AS total FROM $tran $pend");							
	$pnla = $pnlq->fetch_array();
	$pntt+= $pnla["total"];				
	$pnmq = $link->query("SELECT SUM(product_price) AS total FROM $dets $pend");								
	$pnma = $pnmq->fetch_array();
	$pntt+= $pnma["total"];	

	$cllq = $link->query("SELECT SUM(labor_cost) AS total FROM $tran ");						
	$clla = $cllq->fetch_array();
	$cltt+= $clla["total"];				
	$clmq = $link->query("SELECT SUM(product_price) AS total FROM $dets $coll");							
	$clma = $clmq->fetch_array();
	$cltt+= $clma["total"];	
			
	//Total by Statuses
	$stat = $pdtt + $pntt + $cltt;

	//Percentage by Statuses
	$pdpc = ($pdtt*100)/$stat;
	$pdpa = round($pdpc);

	$pnpc = ($pntt*100)/$stat;
	$pnpa = round($pnpc);

	$clpc = ($cltt*100)/$stat;
	$clpa = round($clpc);	
	
// Report by Labor and Materials // 

	$labq = $link->query("SELECT SUM(labor_cost) AS total FROM $tran ");						
	$laba = $labq->fetch_array();
	$labt+= $laba["total"];				
	$matq = $link->query("SELECT SUM(product_price) AS total FROM $dets ");							
	$mata = $matq->fetch_array();
	$matt+= $mata["total"];	

	//Total Labor and Meterials
	$tlmt = $labt + $matt;

	//Percentage by Labor and Materials
	$labpc = ($labt*100)/$tlmt;
	$labpa = round($labpc);

	$matpc = ($matt*100)/$tlmt;
	$matpa = round($matpc);

	$tlmpc = ($tlmt*100)/$tlmt;
	$tlmpa = round($tlmpc);

?>