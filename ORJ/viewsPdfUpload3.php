<?php
    session_start();
	include('pdf_mc_table2.php');
	$db= new PDO ('mysql:host=localhost;dbname=ovpretdb','root','');
	$pdf = new PDF_MC_Table();
	$pdf->SetLeftMargin(15);
	$pdf->AddPage('L','Legal',0);
    $query='SELECT * FROM `uploaddata` WHERE month(`date`)='.$_SESSION['month'].' order by ID DESC';
	$stmt = $db->query($query);
	$count=1;
	if($stmt->rowCount()>0){
        $pdf->SetWidths(array(10,30,70,40,40,30,65,41));//width for each column
        $pdf->SetAligns(array('C','C','C','C','C','C','C','C'));
        $pdf->SetLineHeight(5);//height of each line not rows

        //$pdf->SetFillColor(118,52,53);
        //$pdf->headerTable();
        $pdf->SetFont('Times','',12);
        $pdf->SetTextColor(0,0,0);
        while($data=$stmt->fetch(PDO::FETCH_OBJ)){
            $pdf->Row(Array(
                $count,
                $data->researchNo,
                $data->title,
                $data->author,
                $data->email,
                $data->acronym,
                $data->agenda,
                date('F d, Y',strtotime($data->date)),
            ));
            $count+=1;
        }
        $pdf->AliasNbPages();
        $pdf->Output();
    }else{
        $pdf->SetFont('Times','',12);
        $pdf->SetTextColor(0,0,0);
        $pdf->Cell(326,10,'No Result Found',1,0,'C');
        $pdf->AliasNbPages();
        $pdf->Output();
    }

?>