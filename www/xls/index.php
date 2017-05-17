<?php
if ($str == "index.php")
{
$rows01=mysql_num_rows(mysql_query("SELECT s1 FROM `bs4_1user` WHERE `s1`='$id1u' AND `s6`='1' AND `s7`='$id1c' LIMIT 0,1"));
if ($rows01 == "1")
{
/*
Список отчетов:
day.xlsx - отчет за сегодня
*/

require_once 'phpexcel/Classes/PHPExcel.php';
$phpexcel=new PHPExcel();
$page=$phpexcel->setActiveSheetIndex(0);

$namecol["inf"]="A";
$namecol["in"]="B";
$namecol["out"]="C";
$namecol[0]="D";
$namecol[1]="E";
$namecol[2]="F";
$namecol[3]="G";
$namecol[4]="H";
$namecol[5]="I";
$namecol[6]="J";
$namecol[7]="K";
$namecol[8]="L";
$namecol[9]="M";
$namecol[10]="N";
$namecol[11]="O";
$namecol[12]="P";
$namecol[13]="Q";
$namecol[14]="R";
$namecol[15]="S";
$namecol[16]="T";
$namecol[17]="U";
$namecol[18]="V";
$namecol[19]="W";
$namecol[20]="X";
$namecol[21]="Y";
$namecol[22]="Z";
$namecol[23]="AA";
function table1($page)
{
	$page->setCellValue("A1", "ОПИСАНИЕ");
	$page->setCellValue("B1", "ВОШЛО");
	$page->setCellValue("C1", "ВЫШЛО");
	$page->setCellValue("D1", "0");
	$page->setCellValue("E1", "1");
	$page->setCellValue("F1", "2");
	$page->setCellValue("G1", "3");
	$page->setCellValue("H1", "4");
	$page->setCellValue("I1", "5");
	$page->setCellValue("J1", "6");
	$page->setCellValue("K1", "7");
	$page->setCellValue("L1", "8");
	$page->setCellValue("M1", "9");
	$page->setCellValue("N1", "10");
	$page->setCellValue("O1", "11");
	$page->setCellValue("P1", "12");
	$page->setCellValue("Q1", "13");
	$page->setCellValue("R1", "14");
	$page->setCellValue("S1", "15");
	$page->setCellValue("T1", "16");
	$page->setCellValue("U1", "17");
	$page->setCellValue("V1", "18");
	$page->setCellValue("W1", "19");
	$page->setCellValue("X1", "20");
	$page->setCellValue("Y1", "21");
	$page->setCellValue("Z1", "22");
	$page->setCellValue("AA1", "23");
}

if ($xls0agen == "day")
{
	// Отчет за сегодня
	table1($page);
	$n1a1="1";
	$res3a3=mysql_query("SELECT s1,s2 FROM `bs4_2region`");
	while($row3a3=mysql_fetch_array($res3a3))
	{
		$s1reg1a1=$row3a3["s1"];
		$s2reg1a1=$row3a3["s2"];
		$res3a1=mysql_query("SELECT s1,s3 FROM `bs4_3gorod` WHERE `s2`='$s1reg1a1'");
		while($row3a1=mysql_fetch_array($res3a1))
		{
			$s1a2=$row3a1["s1"];
			$s2reg1a1g=$row3a1["s3"];
			$in0="0";
			$out0="0";
			$res3=mysql_query("SELECT s3,s4 FROM `bs4_4coun` WHERE `s2`='$s1a2'");
			while($row3=mysql_fetch_array($res3))
			{
				$s3a3=$row3["s3"];
				$s1a3=$row3["s4"];
				$in1=mysql_fetch_row(mysql_query("SELECT SUM(`in`),SUM(`out`) FROM `counters` WHERE `ID_Counters`='$s1a3' AND `date`='$dt1'"));
				if ($in1[0] < "1") { $in1[0]="0"; }
				if ($in1[1] < "1") { $in1[1]="0"; }
				$n1a1++;
				$page->setCellValue("$namecol[inf]".$n1a1, "$s2reg1a1 - $s2reg1a1g - $s3a3");
				$page->setCellValue("$namecol[in]".$n1a1, "$in1[0]");
				$page->setCellValue("$namecol[out]".$n1a1, "$in1[1]");
				$inall1a=$inall1a + $in1[0];
				$outall1a=$outall1a + $in1[1];
				for ($h=0;$h<24;$h++)
				{
					$in1=mysql_fetch_row(mysql_query("SELECT SUM(`in`),SUM(`out`) FROM `counters` WHERE `ID_Counters`='$s1a3' AND `date`='$dt1' AND `hour`='$h'"));
					if ($in1[0] < "1") { $in1[0]="0"; }
					if ($in1[1] < "1") { $in1[1]="0"; }
					$page->setCellValue("$namecol[$h]".$n1a1, "$in1[0] - $in1[1]");
					$inall1b[$h]=$inall1b[$h] + $in1[0];
					$outall1b[$h]=$outall1b[$h] + $in1[1];
				}
			}
		}
	}
	$n1a1=$n1a1 + 1;
	$page->setCellValue("$namecol[inf]".$n1a1, "ВСЕГО");
	$page->setCellValue("$namecol[in]".$n1a1, "$inall1a");
	$page->setCellValue("$namecol[out]".$n1a1, "$outall1a");
	for ($h=0;$h<24;$h++)
	{
		$page->setCellValue("$namecol[$h]".$n1a1, "$inall1b[$h] - $outall1b[$h]");
	}
	
	$n1a1=$n1a1 + 2;
	$page->setCellValue("$namecol[inf]".$n1a1, "Отчет за период: $dt1");
	$page->setCellValue("$namecol[in]".$n1a1, "$dt1");
	$page->getColumnDimension("A")->setAutoSize(true);
	$page->setTitle("Отчет");
	$objWriter = PHPExcel_IOFactory::createWriter($phpexcel, 'Excel2007');
	$objWriter->save("xls/day.xlsx");
} else if ($xls0agen == "all") {
	// Общий отчет
	table1($page);
	$n1a1="1";
	
	$res3a3=mysql_query("SELECT s1,s2 FROM `bs4_2region`");
	while($row3a3=mysql_fetch_array($res3a3))
	{
		$region[$row3a3["s1"]]=$row3a3["s2"];
	}
	
	$res3a1=mysql_query("SELECT s1,s2,s3 FROM `bs4_3gorod` ORDER BY `s2` ASC");
	while($row3a1=mysql_fetch_array($res3a1))
	{
		$s1a2=$row3a1["s1"];
		$s2a2=$row3a1["s2"];
		$s2reg1a1g=$row3a1["s3"];
		$res3=mysql_query("SELECT * FROM `devices` WHERE `city`='$city'");
		while($row3=mysql_fetch_array($res3))
		{
			$s3a3=$row3["name"];
			$s1a3=$row3["adres"];
			$n1a1++;
			$in1=mysql_fetch_row(mysql_query("SELECT SUM(`in`),SUM(`out`) FROM `counters` WHERE `ID_Counters`='$s1a3' AND `date` LIKE '$dt1%%'"));
			if ($in1[0] < "1") { $in1[0]="0"; }
			if ($in1[1] < "1") { $in1[1]="0"; }
			$page->setCellValue("$namecol[inf]".$n1a1, "$region[$s2a2] - $s2reg1a1g - $s3a3");
			$page->setCellValue("$namecol[in]".$n1a1, "$in1[0]");
			$page->setCellValue("$namecol[out]".$n1a1, "$in1[1]");
			for ($h=0;$h<24;$h++)
			{
				$in1=mysql_fetch_row(mysql_query("SELECT SUM(`in`),SUM(`out`) FROM `counters` WHERE `ID_Counters`='$s1a3' AND `date` LIKE '$dt1%%' AND `hour`='$h'"));
				if ($in1[0] < "1") { $in1[0]="0"; }
				if ($in1[1] < "1") { $in1[1]="0"; }
				$page->setCellValue("$namecol[$h]".$n1a1, "$in1[0] - $in1[1]");
				$inall1b[$h]=$inall1b[$h] + $in1[0];
				$outall1b[$h]=$outall1b[$h] + $in1[1];
			}
		}
	}
	
	$res3a1=mysql_query("SELECT DISTINCT date FROM `counters` WHERE `date` LIKE '$dt1%%' ORDER BY `date` ASC");
	while($row3a1=mysql_fetch_array($res3a1))
	{
		$dt1a2=$row3a1["date"];
		$in1=mysql_fetch_row(mysql_query("SELECT SUM(`in`),SUM(`out`) FROM `counters` WHERE `date`='$dt1a2'"));
		if ($in1[0] < "1") { $in1[0]="0"; }
		if ($in1[1] < "1") { $in1[1]="0"; }
		$n1a1++;
		$page->setCellValue("$namecol[inf]".$n1a1, "$dt1a2");
		$page->setCellValue("$namecol[in]".$n1a1, "$in1[0]");
		$page->setCellValue("$namecol[out]".$n1a1, "$in1[1]");
		for ($h=0;$h<24;$h++)
		{
			$in1=mysql_fetch_row(mysql_query("SELECT SUM(`in`),SUM(`out`) FROM `counters` WHERE `date`='$dt1a2' AND `hour`='$h'"));
			if ($in1[0] < "1") { $in1[0]="0"; }
			if ($in1[1] < "1") { $in1[1]="0"; }
			$page->setCellValue("$namecol[$h]".$n1a1, "$in1[0] - $in1[1]");
			$inall1=$inall1 + $in1[0];
			$outall1=$outall1 + $in1[1];
		}
	}
	
	$n1a1=$n1a1 + 1;
	$page->setCellValue("$namecol[inf]".$n1a1, "ВСЕГО");
	$page->setCellValue("$namecol[in]".$n1a1, "$inall1");
	$page->setCellValue("$namecol[out]".$n1a1, "$outall1");
	for ($h=0;$h<24;$h++)
	{
		$in1=mysql_fetch_row(mysql_query("SELECT SUM(`in`),SUM(`out`) FROM `counters` WHERE `date` LIKE '$dt1%%' AND `hour`='$h'"));
		if ($in1[0] < "1") { $in1[0]="0"; }
		if ($in1[1] < "1") { $in1[1]="0"; }
		$page->setCellValue("$namecol[$h]".$n1a1, "$in1[0] - $in1[1]");
	}
	
	$n1a1=$n1a1 + 2;
	$page->setCellValue("$namecol[inf]".$n1a1, "Общий отчет");
//	$page->setCellValue("$namecol[in]".$n1a1, "$dt1");
	$page->getColumnDimension("A")->setAutoSize(true);
	$page->setTitle("Отчет");
	$objWriter = PHPExcel_IOFactory::createWriter($phpexcel, 'Excel2007');
	$objWriter->save("xls/all.xlsx");
	
} else if ($xls0agen == "alld") {
	
	// Общий отчет по дате
	table1($page);
	$n1a1="1";
	
	$res3a3=mysql_query("SELECT s1,s2 FROM `bs4_2region`");
	while($row3a3=mysql_fetch_array($res3a3))
	{
		$region[$row3a3["s1"]]=$row3a3["s2"];
	}
	
	$res3a1=mysql_query("SELECT s1,s2,s3 FROM `bs4_3gorod` ORDER BY `s2` ASC");
	while($row3a1=mysql_fetch_array($res3a1))
	{
		$s1a2=$row3a1["s1"];
		$s2a2=$row3a1["s2"];
		$s2reg1a1g=$row3a1["s3"];
		$res3=mysql_query("SELECT * FROM `devices` WHERE `city`='$city'");
		while($row3=mysql_fetch_array($res3))
		{
			$s3a3=$row3["name"];
			$s1a3=$row3["adres"];
			$n1a1++;
			$in1=mysql_fetch_row(mysql_query("SELECT SUM(`in`),SUM(`out`) FROM `counters` WHERE `date`>='$dt1' AND `date`<='$dt2' AND `ID_Counters`='$s1a3'"));
			if ($in1[0] < "1") { $in1[0]="0"; }
			if ($in1[1] < "1") { $in1[1]="0"; }
			$page->setCellValue("$namecol[inf]".$n1a1, "$region[$s2a2] - $s2reg1a1g - $s3a3");
			$page->setCellValue("$namecol[in]".$n1a1, "$in1[0]");
			$page->setCellValue("$namecol[out]".$n1a1, "$in1[1]");
			for ($h=0;$h<24;$h++)
			{
				$in1=mysql_fetch_row(mysql_query("SELECT SUM(`in`),SUM(`out`) FROM `counters` WHERE `date`>='$dt1' AND `date`<='$dt2' AND `ID_Counters`='$s1a3' AND `hour`='$h'"));
				if ($in1[0] < "1") { $in1[0]="0"; }
				if ($in1[1] < "1") { $in1[1]="0"; }
				$page->setCellValue("$namecol[$h]".$n1a1, "$in1[0] - $in1[1]");
				$inall1b[$h]=$inall1b[$h] + $in1[0];
				$outall1b[$h]=$outall1b[$h] + $in1[1];
			}
		}
	}
	
	$res3a1=mysql_query("SELECT DISTINCT date FROM `counters` WHERE `date`>='$dt1' AND `date`<='$dt2' ORDER BY `date` ASC");
	while($row3a1=mysql_fetch_array($res3a1))
	{
		$dt1a2=$row3a1["date"];
		$in1=mysql_fetch_row(mysql_query("SELECT SUM(`in`),SUM(`out`) FROM `counters` WHERE `date`='$dt1a2'"));
		if ($in1[0] < "1") { $in1[0]="0"; }
		if ($in1[1] < "1") { $in1[1]="0"; }
		$n1a1++;
		$page->setCellValue("$namecol[inf]".$n1a1, "$dt1a2");
		$page->setCellValue("$namecol[in]".$n1a1, "$in1[0]");
		$page->setCellValue("$namecol[out]".$n1a1, "$in1[1]");
		for ($h=0;$h<24;$h++)
		{
			$in1=mysql_fetch_row(mysql_query("SELECT SUM(`in`),SUM(`out`) FROM `counters` WHERE `date`='$dt1a2' AND `hour`='$h'"));
			if ($in1[0] < "1") { $in1[0]="0"; }
			if ($in1[1] < "1") { $in1[1]="0"; }
			$page->setCellValue("$namecol[$h]".$n1a1, "$in1[0] - $in1[1]");
			$inall1=$inall1 + $in1[0];
			$outall1=$outall1 + $in1[1];
		}
	}
	
	$n1a1=$n1a1 + 1;
	$page->setCellValue("$namecol[inf]".$n1a1, "ВСЕГО");
	$page->setCellValue("$namecol[in]".$n1a1, "$inall1");
	$page->setCellValue("$namecol[out]".$n1a1, "$outall1");
	for ($h=0;$h<24;$h++)
	{
		$in1=mysql_fetch_row(mysql_query("SELECT SUM(`in`),SUM(`out`) FROM `counters` WHERE `date`>='$dt1' AND `date`<='$dt2' AND `hour`='$h'"));
		if ($in1[0] < "1") { $in1[0]="0"; }
		if ($in1[1] < "1") { $in1[1]="0"; }
		$page->setCellValue("$namecol[$h]".$n1a1, "$in1[0] - $in1[1]");
	}
	
	$n1a1=$n1a1 + 2;
	$page->setCellValue("$namecol[inf]".$n1a1, "Общий отчет");
//	$page->setCellValue("$namecol[in]".$n1a1, "$dt1");
	$page->getColumnDimension("A")->setAutoSize(true);
	$page->setTitle("Отчет");
	$objWriter = PHPExcel_IOFactory::createWriter($phpexcel, 'Excel2007');
	$objWriter->save("xls/alld.xlsx");

} else if ($xls0agen == "gorod") {
	
	// Отчет по городу
	table1($page);
	$n1a1="1";
	
	// По счетчикам
	$res3=mysql_query("SELECT * FROM `devices` WHERE `city`='$id'");
	while($row3=mysql_fetch_array($res3))
	{
		$s3a3=$row3["name"];
		$s1a3=$row3["mac_last"];
		$in1=mysql_fetch_row(mysql_query("SELECT SUM(`in`),SUM(`out`) FROM `counters` WHERE `ID_Counters`='$s1a3'"));
		if ($in1[0] < "1") { $in1[0]="0"; }
		if ($in1[1] < "1") { $in1[1]="0"; }
		$n1a1++;
		$page->setCellValue("$namecol[inf]".$n1a1, "$s3a3");
		$page->setCellValue("$namecol[in]".$n1a1, "$in1[0]");
		$page->setCellValue("$namecol[out]".$n1a1, "$in1[1]");
		$in0all1=$in0all1 + $in1[0];
		$out0all1=$out0all1 + $in1[1];
		for ($h=0;$h<24;$h++)
		{
			$in1=mysql_fetch_row(mysql_query("SELECT SUM(`in`),SUM(`out`) FROM `counters` WHERE `ID_Counters`='$s1a3' AND `hour`='$h'"));
			if ($in1[0] < "1") { $in1[0]="0"; }
			if ($in1[1] < "1") { $in1[1]="0"; }
			$page->setCellValue("$namecol[$h]".$n1a1, "$in1[0] - $in1[1]");
			$in0a[$h]=$in0a[$h] + $in1[0];
			$out0a[$h]=$out0a[$h] + $in1[1];
		}
	}
	
	// Всего
	$n1a1=$n1a1 + 1;
	$page->setCellValue("$namecol[inf]".$n1a1, "ВСЕГО");
	$page->setCellValue("$namecol[in]".$n1a1, "$in0all1");
	$page->setCellValue("$namecol[out]".$n1a1, "$out0all1");
	for ($h=0;$h<24;$h++)
	{
		$page->setCellValue("$namecol[$h]".$n1a1, "$in0a[$h] - $out0a[$h]");
	}
	
	$n1a1=$n1a1 + 2;
	$page->setCellValue("$namecol[inf]".$n1a1, "Отчет по городу");
//	$page->setCellValue("$namecol[in]".$n1a1, "$dt1");
	$page->getColumnDimension("A")->setAutoSize(true);
	$page->setTitle("Отчет");
	$objWriter = PHPExcel_IOFactory::createWriter($phpexcel, 'Excel2007');
	$objWriter->save("xls/gorod.xlsx");

} else if ($xls0agen == "region") {
	
	// Отчет по региону
	table1($page);
	$n1a1="1";
	
	$res3=mysql_query("SELECT s1,s3 FROM `bs4_3gorod` WHERE `s2`='".$id."'");
	while($row3=mysql_fetch_array($res3))
	{
		$s3a1=$row3["s1"];
		$s3a3=$row3["s3"];
		$in1=mysql_fetch_row(mysql_query("SELECT SUM(`in`),SUM(`out`) FROM `counters` WHERE `ID_Counters` IN (SELECT mac_last FROM `devices` WHERE `city`='$s3a1')"));
		if ($in1[0] < "1") { $in1[0]="0"; }
		if ($in1[1] < "1") { $in1[1]="0"; }
		$n1a1++;
		$page->setCellValue("$namecol[inf]".$n1a1, "$s3a3");
		$page->setCellValue("$namecol[in]".$n1a1, "$in1[0]");
		$page->setCellValue("$namecol[out]".$n1a1, "$in1[1]");
		$in0all1=$in0all1 + $in1[0];
		$out0all1=$out0all1 + $in1[1];
		for ($h=0;$h<24;$h++)
		{
			$in1=mysql_fetch_row(mysql_query("SELECT SUM(`in`),SUM(`out`) FROM `counters` WHERE `ID_Counters` IN (SELECT mac_last FROM `devices` WHERE `city`='$s3a1') AND `hour`='$h'"));
			if ($in1[0] < "1") { $in1[0]="0"; }
			if ($in1[1] < "1") { $in1[1]="0"; }
			$page->setCellValue("$namecol[$h]".$n1a1, "$in1[0] - $in1[1]");
			$in0a[$h]=$in0a[$h] + $in1[0];
			$out0a[$h]=$out0a[$h] + $in1[1];
		}
	}
	
	// Всего
	$n1a1=$n1a1 + 1;
	$page->setCellValue("$namecol[inf]".$n1a1, "ВСЕГО");
	$page->setCellValue("$namecol[in]".$n1a1, "$in0all1");
	$page->setCellValue("$namecol[out]".$n1a1, "$out0all1");
	for ($h=0;$h<24;$h++)
	{
		$page->setCellValue("$namecol[$h]".$n1a1, "$in0a[$h] - $out0a[$h]");
	}
	
	$n1a1=$n1a1 + 2;
	$page->setCellValue("$namecol[inf]".$n1a1, "Отчет по региону");
//	$page->setCellValue("$namecol[in]".$n1a1, "$dt1");
	$page->getColumnDimension("A")->setAutoSize(true);
	$page->setTitle("Отчет");
	$objWriter = PHPExcel_IOFactory::createWriter($phpexcel, 'Excel2007');
	$objWriter->save("xls/region.xlsx");
	
} else if ($xls0agen == "cont1") {
	
	// Отчет по счетчику
	table1($page);
	$n1a1="1";
	
	$res3=mysql_query("SELECT * FROM `devices` WHERE `mac_last`='$id' LIMIT 0,1");
	while($row3=mysql_fetch_array($res3))
	{
		$s2=$row3["city"];
		$name=$row3["name"];
		$adres=$row3["mac_last"];
	}
	// По дням
	$res3a1=mysql_query("SELECT DISTINCT date FROM `counters` WHERE `ID_Counters`='$adres' ORDER BY `date` ASC");
	while($row3a1=mysql_fetch_array($res3a1))
	{
		$dt1a2=$row3a1["date"];
		$in1=mysql_fetch_row(mysql_query("SELECT SUM(`in`),SUM(`out`) FROM `counters` WHERE `ID_Counters`='$adres' AND `date`='$dt1a2'"));
		if ($in1[0] < "1") { $in1[0]="0"; }
		if ($in1[1] < "1") { $in1[1]="0"; }
		$n1a1++;
		$page->setCellValue("$namecol[inf]".$n1a1, "$dt1a2");
		$page->setCellValue("$namecol[in]".$n1a1, "$in1[0]");
		$page->setCellValue("$namecol[out]".$n1a1, "$in1[1]");
		for ($h=0;$h<24;$h++)
		{
			$in1=mysql_fetch_row(mysql_query("SELECT SUM(`in`),SUM(`out`) FROM `counters` WHERE `ID_Counters`='$adres' AND `date`='$dt1a2' AND `hour`='$h'"));
			if ($in1[0] < "1") { $in1[0]="0"; }
			if ($in1[1] < "1") { $in1[1]="0"; }
			$page->setCellValue("$namecol[$h]".$n1a1, "$in1[0] - $in1[1]");
			
		}
	}
	
	// Всего
	$in1=mysql_fetch_row(mysql_query("SELECT SUM(`in`),SUM(`out`) FROM `counters` WHERE `ID_Counters`='$adres'"));
	if ($in1[0] < "1") { $in1[0]="0"; }
	if ($in1[1] < "1") { $in1[1]="0"; }
	$n1a1=$n1a1 + 1;
	$page->setCellValue("$namecol[inf]".$n1a1, "ВСЕГО");
	$page->setCellValue("$namecol[in]".$n1a1, "$in1[0]");
	$page->setCellValue("$namecol[out]".$n1a1, "$in1[1]");
	for ($h=0;$h<24;$h++)
	{
		$in1=mysql_fetch_row(mysql_query("SELECT SUM(`in`),SUM(`out`) FROM `counters` WHERE `ID_Counters`='$adres' AND `hour`='$h'"));
		if ($in1[0] < "1") { $in1[0]="0"; }
		if ($in1[1] < "1") { $in1[1]="0"; }
		$page->setCellValue("$namecol[$h]".$n1a1, "$in1[0] - $in1[1]");
	}
	
	$n1a1=$n1a1 + 2;
	$page->setCellValue("$namecol[inf]".$n1a1, "Отчет по счетчику");
//	$page->setCellValue("$namecol[in]".$n1a1, "$dt1");
	$page->getColumnDimension("A")->setAutoSize(true);
	$page->setTitle("Отчет");
	$objWriter = PHPExcel_IOFactory::createWriter($phpexcel, 'Excel2007');
	$objWriter->save("xls/cont1.xlsx");
	
} else if ($xls0agen == "cont1d") {
	
	// Отчет по счетчику, по дате
	table1($page);
	$n1a1="1";
	
	$res3=mysql_query("SELECT * FROM `devices` WHERE `mac_last`='$id' LIMIT 0,1");
	while($row3=mysql_fetch_array($res3))
	{
		$s2=$row3["city"];
		$name=$row3["name"];
		$adres=$row3["mac_last"];
	}
	// По дням
	$res3a1=mysql_query("SELECT DISTINCT date FROM `counters` WHERE `ID_Counters`='$adres' AND `date`>='$dt1' AND `date`<='$dt2' ORDER BY `date` ASC");
	while($row3a1=mysql_fetch_array($res3a1))
	{
		$dt1a2=$row3a1["date"];
		$in1=mysql_fetch_row(mysql_query("SELECT SUM(`in`),SUM(`out`) FROM `counters` WHERE `ID_Counters`='$adres' AND `date`='$dt1a2'"));
		if ($in1[0] < "1") { $in1[0]="0"; }
		if ($in1[1] < "1") { $in1[1]="0"; }
		$in0a2=$in0a2 + $in1[0];
		$out0a2=$out0a2 + $in1[1];
		$n1a1++;
		$page->setCellValue("$namecol[inf]".$n1a1, "$dt1a2");
		$page->setCellValue("$namecol[in]".$n1a1, "$in1[0]");
		$page->setCellValue("$namecol[out]".$n1a1, "$in1[1]");
		for ($h=0;$h<24;$h++)
		{
			$in1=mysql_fetch_row(mysql_query("SELECT SUM(`in`),SUM(`out`) FROM `counters` WHERE `ID_Counters`='$adres' AND `date`='$dt1a2' AND `hour`='$h'"));
			if ($in1[0] < "1") { $in1[0]="0"; }
			if ($in1[1] < "1") { $in1[1]="0"; }
			$page->setCellValue("$namecol[$h]".$n1a1, "$in1[0] - $in1[1]");
			$in0h[$h]=$in0h[$h] + $in1[0];
			$out0h[$h]=$out0h[$h] + $in1[1];
		}
		echo "</tr>";
	}
	
	$n1a1=$n1a1 + 1;
	$page->setCellValue("$namecol[inf]".$n1a1, "ВСЕГО");
	$page->setCellValue("$namecol[in]".$n1a1, "$in0a2");
	$page->setCellValue("$namecol[out]".$n1a1, "$out0a2");
	for ($h=0;$h<24;$h++)
	{
		$page->setCellValue("$namecol[$h]".$n1a1, "$in0h[$h] - $out0h[$h]");
	}
	
	$n1a1=$n1a1 + 2;
	$page->setCellValue("$namecol[inf]".$n1a1, "Отчет по счетчику");
//	$page->setCellValue("$namecol[in]".$n1a1, "$dt1");
	$page->getColumnDimension("A")->setAutoSize(true);
	$page->setTitle("Отчет");
	$objWriter = PHPExcel_IOFactory::createWriter($phpexcel, 'Excel2007');
	$objWriter->save("xls/cont1d.xlsx");
	
}
























}
}
?>