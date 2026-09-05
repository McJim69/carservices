<?php
	// Initialize
	$monthlyTotals = [];
	$monthlyPercents = [];
	$sales = 0;

	// Loop through months
	for ($m = 1; $m <= 12; $m++) {
		$month = str_pad($m, 2, "0", STR_PAD_LEFT);
		$lastDay = date("t", strtotime("$post-$month-01"));
		$where = "WHERE serv_date BETWEEN '$post-$month-01' AND '$post-$month-$lastDay'";

		// Labor
		$laborQ = $link->query("SELECT SUM(labor_cost) AS total FROM transactions $where");
		$laborA = $laborQ->fetch_assoc();
		$laborT = isset($laborA["total"]) ? (float)$laborA["total"] : 0;

		// Materials
		$matQ = $link->query("SELECT SUM(product_price) AS total FROM trans_details $where");
		$matA = $matQ->fetch_assoc();
		$matT = isset($matA["total"]) ? (float)$matA["total"] : 0;

		// Monthly total
		$total = $laborT + $matT;
		$monthlyTotals[$month] = $total;
		$sales += $total;
	}

	// Percentages
	foreach ($monthlyTotals as $month => $total) {
		$monthlyPercents[$month] = ($sales > 0) ? round(($total * 100) / $sales) : 0;
	}

	// Map back to individual variables for chart compatibility
	$janT = $monthlyTotals['01']; $janP = $monthlyPercents['01']; $jan = "JAN";
	$febT = $monthlyTotals['02']; $febP = $monthlyPercents['02']; $feb = "FEB";
	$marT = $monthlyTotals['03']; $marP = $monthlyPercents['03']; $mar = "MAR";
	$aprT = $monthlyTotals['04']; $aprP = $monthlyPercents['04']; $apr = "APR";
	$mayT = $monthlyTotals['05']; $mayP = $monthlyPercents['05']; $may = "MAY";
	$junT = $monthlyTotals['06']; $junP = $monthlyPercents['06']; $jun = "JUN";
	$julT = $monthlyTotals['07']; $julP = $monthlyPercents['07']; $jul = "JUL";
	$augT = $monthlyTotals['08']; $augP = $monthlyPercents['08']; $aug = "AUG";
	$sepT = $monthlyTotals['09']; $sepP = $monthlyPercents['09']; $sep = "SEP";
	$octT = $monthlyTotals['10']; $octP = $monthlyPercents['10']; $oct = "OCT";
	$novT = $monthlyTotals['11']; $novP = $monthlyPercents['11']; $nov = "NOV";
	$decT = $monthlyTotals['12']; $decP = $monthlyPercents['12']; $dec = "DEC";

	// --- Status Totals ---
	$tran = "transactions WHERE serv_date BETWEEN '$post-01-01' AND '$post-12-31'";
	$dets = "trans_details WHERE serv_date BETWEEN '$post-01-01' AND '$post-12-31'";

	$pdtt = $pntt = $cltt = 0;

	// Paid
	$pdlq = $link->query("SELECT SUM(labor_cost) AS total FROM $tran AND payment='Paid'");
	$pdla = $pdlq->fetch_assoc();
	$pdtt += isset($pdla["total"]) ? (float)$pdla["total"] : 0;

	$pdmq = $link->query("SELECT SUM(product_price) AS total FROM $dets AND payment='Paid'");
	$pdma = $pdmq->fetch_assoc();
	$pdtt += isset($pdma["total"]) ? (float)$pdma["total"] : 0;

	// Pending
	$pnlq = $link->query("SELECT SUM(labor_cost) AS total FROM $tran AND payment='Pending'");
	$pnla = $pnlq->fetch_assoc();
	$pntt += isset($pnla["total"]) ? (float)$pnla["total"] : 0;

	$pnmq = $link->query("SELECT SUM(product_price) AS total FROM $dets AND payment='Pending'");
	$pnma = $pnmq->fetch_assoc();
	$pntt += isset($pnma["total"]) ? (float)$pnma["total"] : 0;

	// Collectable
	$cllq = $link->query("SELECT SUM(labor_cost) AS total FROM $tran AND payment='Collectable'");
	$clla = $cllq->fetch_assoc();
	$cltt += isset($clla["total"]) ? (float)$clla["total"] : 0;

	$clmq = $link->query("SELECT SUM(product_price) AS total FROM $dets AND payment='Collectable'");
	$clma = $clmq->fetch_assoc();
	$cltt += isset($clma["total"]) ? (float)$clma["total"] : 0;

	// Status percentages
	$stat = $pdtt + $pntt + $cltt;
	$pdpa = ($stat > 0) ? round(($pdtt * 100) / $stat) : 0;
	$pnpa = ($stat > 0) ? round(($pntt * 100) / $stat) : 0;
	$clpa = ($stat > 0) ? round(($cltt * 100) / $stat) : 0;

	// --- Labor vs Materials ---
	$labq = $link->query("SELECT SUM(labor_cost) AS total FROM $tran");
	$laba = $labq->fetch_assoc();
	$labt = isset($laba["total"]) ? (float)$laba["total"] : 0;

	$matq = $link->query("SELECT SUM(product_price) AS total FROM $dets");
	$mata = $matq->fetch_assoc();
	$matt = isset($mata["total"]) ? (float)$mata["total"] : 0;

	$tlmt = $labt + $matt;
	$labpa = ($tlmt > 0) ? round(($labt * 100) / $tlmt) : 0;
	$matpa = ($tlmt > 0) ? round(($matt * 100) / $tlmt) : 0;
	$tlmpa = ($tlmt > 0) ? round(($tlmt * 100) / $tlmt) : 0;
?>
