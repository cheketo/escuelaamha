<?php

include('../../includes/inc.main.php');

$Action	= $_POST['action'] ? $_POST['action'] : $_GET['action'];

switch($Action)
{
	case 'import':
	
		/*if($_GET['movefile'])
		{*/
			$Table		= "personas_".$_POST['year']."_".$_POST['month'];
			$Ext		= array_reverse(explode(".",$_FILES['excel']['name']));
			
			$ExcelURL	= "../../../skin/files/excel/".$Table.".".$Ext[0];
			if(file_exists($ExcelURL)) unlink($ExcelURL);
			copy($_FILES['excel']['tmp_name'], $ExcelURL);
			
			$SQL 	= "SHOW TABLES FROM ".$DB->DataBase;
			$Tables	= $DB->fetchRow("show",$SQL);
			
			for($i=0;$i<count($Tables);$i++) 
			{
				if(in_array($Table,$Tables[$i]))
				{
					$SQL = "DROP TABLE ".$Table;
					$DB->execQuery("drop",$SQL);
				}
			}
			
			$SQL = "CREATE TABLE ".$Table." LIKE personas";
			$DB->execQuery("create",$SQL);
			
			
			//exec("php files/modules/personas/process.abm.php?action=importasinc&name=".$Table."&ext=".$Ext[0]);
			//exec("php.exe");
			//header("Location: list.php"); die;
			$Interval	= 100;
			header("Location: process.abm.php?action=importasinc&name=".$Table."&ext=".$Ext[0]."&interval=".$Interval); die;
	break;
	
	case 'importasinc':
		//}
		
		include('process.reader.php');
		echo "INICIANDO IMPORTACION<br><br>";
		$Table		= $_GET['name'];
		$Ext		= $_GET['ext'];
		$To			= $_GET['to'];
		$From		= $_GET['from'];
		$Interval	= $_GET['interval'];
		
		$Reader	= new Spreadsheet_Excel_Reader();
		$Reader ->setOutputEncoding('CP1251');
		$Reader	->read("../../../skin/files/excel/".$Table.".".$Ext);
		
		//$Rows	= intval($Reader->sheets[0]['numRows']);
		
		//print_r($Rows);die;
		
		//echo $From." hasta ".$To." INTERVALO: ".$Interval;die;
		
		if(!$From){
			for ($i = 1; $i <= $Reader->sheets[0]['numRows']; $i++) {
				for ($j = 1; $j <= $Reader->sheets[0]['numCols']; $j++) {
					if($Reader->sheets[0]['cells'][$i][$j] && $i!=1)
					{
						
						
						$Excel[$x][$j]	= addslashes($Reader->sheets[0]['cells'][$i][$j]);
						if($j==$Reader->sheets[0]['numCols']) $x++;
						//echo ($x)." - ".$Excel[$x][$j];
						//if($j==$Reader->sheets[0]['numCols']) echo "<br><br>";
					}
						
				}
				
			}
			
			
			$_SESSION['excel']	= $Excel;
		}else{
			$Excel = $_SESSION['excel']; 
		}
		
		
		if(!$From) $From	= 1;
		$x=1;
		
		$Rows	= count($Excel);
		
		if(!$Interval)
			$Interval	= $Rows;
		
		if(!$To)
			$To	= $Interval;
		
		//print_r($To);
		
		//if($To>$Rows) $To = $Rows;
		
		//print_r($Excel);die;
		
		//echo $From." a ".$To." INTERVALO: ".$Interval; die;
		
		//$To	= count($Excel);//$From + 10;
		
		$NextTo		= $To + $Interval;
		$NextFrom	= $To + 1;
		
		$j=1;
		
		if(!$Excel[1][1]) $j=2;
		
		//$SQL	= "INSERT INTO ".$Table." (legajo,nya,cuil,cct,afiliado,categoria,puesto,area,ubicacion,remunerativo,no_remunerativo,bruto,linea)VALUES('".$Excel[$From][$j]."','".$Excel[$From][$j+1]."','".$Excel[$From][$j+2]."','".$Excel[$From][$j+3]."','".$Excel[$From][$j+4]."','".$Excel[$From][$j+5]."','".$Excel[$From][$j+6]."','".$Excel[$From][$j+7]."','".$Excel[$From][$j+8]."','".$Excel[$From][$j+9]."','".$Excel[$From][$j+10]."','".$Excel[$From][$j+11]."','".$Excel[$From][$j+12]."')";
		
		//print_r($Excel);die;
		
		//if($To >= $Rows){print_r($Excel);die;}
		
		$Imported = 1;
		
		if($To > $Rows) $To = $Rows;
		
		//print_r($Rows); die;
		
		
		//$Cont	= $From;
		
		
		
		/*for($i=$From;$i<=$To;$i++)
		{	
				$SQL	= "INSERT INTO ".$Table." (legajo,nya,cuil,cct,afiliado,categoria,puesto,area,ubicacion,remunerativo,no_remunerativo,bruto,linea)VALUES('".$Excel[$i][$j]."','".$Excel[$i][$j+1]."','".$Excel[$i][$j+2]."','".$Excel[$i][$j+3]."','".$Excel[$i][$j+4]."','".$Excel[$i][$j+5]."','".$Excel[$i][$j+6]."','".$Excel[$i][$j+7]."','".$Excel[$i][$j+8]."','".$Excel[$i][$j+9]."','".$Excel[$i][$j+10]."','".$Excel[$i][$j+11]."','".$Excel[$i][$j+12]."')";
				$DB->execQuery("free",$SQL);
				$Imported++;
				
			//$Print	= "IMPORTANDO REGISTRO Nro ".($Cont)."<br>";
			//echo "IMPORTANDO REGISTRO Nro <b>".$i."</b><br>";
			//$Cont++;
			
			$Status	= ($i*100)/$Rows;
			if($Status>=100) 
			{
				$Status	= number_format($Status,2);
				//sleep(10);
				echo "<br>REGISTROS RECIENTEMENTE IMPORTADOS: <b>".$Imported."</b> (<b>".($From)."</b> A <b>".($To)."</b>)<br><br> REGISTROS IMPORTADOS: <b>".$To."</b> DE <b>".$Rows."</b> <br><br> ESTADO DE LA IMPORTACION: <b>".$Status."%</b>";
				
				$List	= array_reverse(explode("_",$Table));
				echo "<script>document.location.href= 'list.php?year=".$List[1]."&month=".$List[0]."';</script>";
			}
			
		}
		
		$Status	= number_format($Status,2);
		
		if($To < $Rows)
		{
			echo "<br>REGISTROS RECIENTEMENTE IMPORTADOS: <b>".$Imported."</b> (<b>".($From)."</b> A <b>".($To)."</b>)<br><br> REGISTROS IMPORTADOS: <b>".$To."</b> DE <b>".$Rows."</b> <br><br> ESTADO DE LA IMPORTACION: <b>".$Status."%</b>";
			echo "<script>document.location.href= 'process.abm.php?action=importasinc&name=".$Table."&ext=".$Ext."&from=".$NextFrom."&to=".$NextTo."&interval=".$Interval."';</script>";
		}*/
		
		$SQL	= "INSERT INTO ".$Table." (legajo,nya,cuil,cct,afiliado,categoria,puesto,area,ubicacion,remunerativo,no_remunerativo,bruto,linea)VALUES('".$Excel[1][$j]."','".$Excel[1][$j+1]."','".$Excel[1][$j+2]."','".$Excel[1][$j+3]."','".$Excel[1][$j+4]."','".$Excel[1][$j+5]."','".$Excel[1][$j+6]."','".$Excel[1][$j+7]."','".$Excel[1][$j+8]."','".$Excel[1][$j+9]."','".$Excel[1][$j+10]."','".$Excel[1][$j+11]."','".$Excel[1][$j+12]."')";
		
		for($i=$From+1;$i<=$To;$i++)
		{	
				$SQL	.= ",('".$Excel[$i][$j]."','".$Excel[$i][$j+1]."','".$Excel[$i][$j+2]."','".$Excel[$i][$j+3]."','".$Excel[$i][$j+4]."','".$Excel[$i][$j+5]."','".$Excel[$i][$j+6]."','".$Excel[$i][$j+7]."','".$Excel[$i][$j+8]."','".$Excel[$i][$j+9]."','".$Excel[$i][$j+10]."','".$Excel[$i][$j+11]."','".$Excel[$i][$j+12]."')";
				$Imported++;
				
			//$Print	= "IMPORTANDO REGISTRO Nro ".($Cont)."<br>";
			//echo "IMPORTANDO REGISTRO Nro <b>".$i."</b><br>";
			//$Cont++;
			
			$Status	= ($i*100)/$Rows;
			if($Status>=100) 
			{
				$DB->execQuery("free",$SQL);
				
				$Status	= number_format($Status,2);
				//sleep(10);
				echo "<br>REGISTROS RECIENTEMENTE IMPORTADOS: <b>".$Imported."</b> (<b>".($From)."</b> A <b>".($To)."</b>)<br><br> REGISTROS IMPORTADOS: <b>".$To."</b> DE <b>".$Rows."</b> <br><br> ESTADO DE LA IMPORTACION: <b>".$Status."%</b>";
				
				$List	= array_reverse(explode("_",$Table));
				echo "<script>document.location.href= 'list.php?year=".$List[1]."&month=".$List[0]."';</script>";
			}
			
		}
		
		
		
		$Status	= number_format($Status,2);
		
		if($To < $Rows)
		{
			$DB->execQuery("free",$SQL);
			echo "<br>REGISTROS RECIENTEMENTE IMPORTADOS: <b>".$Imported."</b> (<b>".($From)."</b> A <b>".($To)."</b>)<br><br> REGISTROS IMPORTADOS: <b>".$To."</b> DE <b>".$Rows."</b> <br><br> ESTADO DE LA IMPORTACION: <b>".$Status."%</b>";
			echo "<script>document.location.href= 'process.abm.php?action=importasinc&name=".$Table."&ext=".$Ext."&from=".$NextFrom."&to=".$NextTo."&interval=".$Interval."';</script>";
		}		
		
		
		
	break;
	
	case 'delete': 
		$Admin_id	= $_POST['id'];
		$Result		= $DB->fetchAssoc('select','admin_user','img',"admin_id = ".$Admin_id);
		$Delete		= $DB->execQuery('delete','admin_user',"admin_id=".$Admin_id);
		if(file_exists($Result[0]['img'])) unlink($Result[0]['img']);
		print_r($Delete);
		die;
	break;
}

?>