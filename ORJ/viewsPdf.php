<?php
	include('pdf_mc_table.php');
	$db= new PDO ('mysql:host=localhost;dbname=ovpretdb','root','');
	$pdf = new PDF_MC_Table();
	$pdf->SetLeftMargin(15);
	$pdf->AddPage('L','Legal',0);
	$pdf->SetWidths(array(15,30,70,40,20,70,40,20,21));//width for each column
	
	$pdf->SetAligns(array('C','C','C','C','C','C','C','C','C'));
	$pdf->SetLineHeight(5);//height of each line not rows

	//$pdf->SetFillColor(118,52,53);
	//$pdf->headerTable();
	$pdf->SetFont('Times','',12);
	$stmt = $db->query('SELECT * from visitedabstract WHERE count!=0 order by count DESC');
	$count=1;
	
	$pdf->SetTextColor(0,0,0);
	while($data=$stmt->fetch(PDO::FETCH_OBJ)){
		$pdf->Row(Array(
			$count,
			$data->researchNo,
			$data->title,
			$data->author,
			$data->acronym,
			$data->agenda,
			$data->date,
			$data->count,
			$data->accountType
		));
		$count+=1;
	}	
$pdf->AliasNbPages();
$pdf->Output();
?>