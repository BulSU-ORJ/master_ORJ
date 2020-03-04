
<?php
    session_start();
	include('pdf_mc_table3.php');
	$db= new PDO ('mysql:host=localhost;dbname=ovpretdb','root','');
	$pdf = new PDF_MC_Table();
	$pdf->SetLeftMargin(18);
	$pdf->SetWidths(array(10,30,70,40,40,20,70,40,25));//width for each column
	
	$pdf->SetAligns(array('C','C','C','C','C','C','C','C','C'));
	$pdf->SetLineHeight(5);//height of each line not rows

	if($_SESSION['flag']==1){
        $pdf->AddPage('L','Legal',0);
        $pdf->Image('Icon/reportLogo.png',80,15);
        //$pdf->Image('Icon/collegeHeader/'.$_SESSION['col'].'.png',250,15);
        $pdf->SetFont('Arial','B',14);
        $pdf->Cell(0,10,'',0,0,"C");
        $pdf->Ln();
        $pdf->SetFont('Arial','B',14);
        $pdf->Cell(0,6,'Republic of the Philippines',0,0,"C");
        $pdf->Ln();
        $pdf->SetFont('Arial','B',28);
        $pdf->Cell(0,9,'Bulacan State University',0,0,"C");
        $pdf->Ln();
        $pdf->SetFont('Arial','B',16);
        $pdf->Cell(0,6,'City of Malolos, Bulacan',0,0,"C");
        $pdf->Ln(20);
        $pdf->SetFont('Arial','',16);
        $pdf->Cell(0,0,'OFFICE OF THE VICE-PRESIDENT FOR RESEARCH, EXTENSION AND TRAINING',0,0,"C");
        $pdf->Ln();
        $pdf->Cell(0,15,'',0,0,"C");
        $pdf->Ln();
        $pdf->Line(15, 60, 341, 60);
        $pdf->SetFont('Arial','',16);
        $pdf->Cell(0,0,'List of Researches from '.$_SESSION['agd'],0,0,"C");
        $pdf->Ln(10);
        $pdf->SetFillColor(118,52,53);
        $pdf->SetTextColor(255,255,255);
        $pdf->SetDrawColor(118,52,53);
        $pdf->SetFont('Times','B',11);
        $pdf->Cell(10,10,'No.',1,0,'C',true);
        $pdf->Cell(30,10,'Research No.',1,0,'C',true);
        $pdf->Cell(70,10,'Research Title',1,0,'C',true);
        $pdf->Cell(40,10,'Author',1,0,'C',true);
        $pdf->Cell(40,10,'Email',1,0,'C',true);
        $pdf->Cell(20,10,'College',1,0,'C',true);
        $pdf->Cell(70,10,'Agenda',1,0,'C',true);
        $pdf->Cell(40,10,'Date Uploaded',1,0,'C',true);
        $pdf->Ln();

        $pdf->SetFont('Times','',12);
        $query="SELECT * FROM `uploaddata` WHERE `agenda`='{$_SESSION['agd']}' ORDER by agenda ASC";
        $stmt = $db->query($query);
        $count=1;

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
    }else{
        $arr=explode(',',$_SESSION['agd']);
        foreach($arr as $array){
            $pdf->AddPage('L','Legal',0);
            $pdf->Image('Icon/reportLogo.png',80,15);
            //$pdf->Image('Icon/collegeHeader/'.$array.'.png',250,15);
            $pdf->SetFont('Arial','B',14);
            $pdf->Cell(0,10,'',0,0,"C");
            $pdf->Ln();
            $pdf->SetFont('Arial','B',14);
            $pdf->Cell(0,6,'Republic of the Philippines',0,0,"C");
            $pdf->Ln();
            $pdf->SetFont('Arial','B',28);
            $pdf->Cell(0,9,'Bulacan State University',0,0,"C");
            $pdf->Ln();
            $pdf->SetFont('Arial','B',16);
            $pdf->Cell(0,6,'City of Malolos, Bulacan',0,0,"C");
            $pdf->Ln(20);
            $pdf->SetFont('Arial','',16);
            $pdf->Cell(0,0,'OFFICE OF THE VICE-PRESIDENT FOR RESEARCH, EXTENSION AND TRAINING',0,0,"C");
            $pdf->Ln();
            $pdf->Cell(0,15,'',0,0,"C");
            $pdf->Ln();
            $pdf->Line(15, 60, 341, 60);
            $pdf->SetFont('Arial','',16);
            $pdf->Cell(0,0,'List of Researches from '.$array,0,0,"C");
            $pdf->Ln(10);
            $pdf->SetFillColor(118,52,53);
            $pdf->SetTextColor(255,255,255);
            $pdf->SetDrawColor(118,52,53);
            $pdf->SetFont('Times','B',11);
            $pdf->Cell(10,10,'No.',1,0,'C',true);
            $pdf->Cell(30,10,'Research No.',1,0,'C',true);
            $pdf->Cell(70,10,'Research Title',1,0,'C',true);
            $pdf->Cell(40,10,'Author',1,0,'C',true);
            $pdf->Cell(40,10,'Email',1,0,'C',true);
            $pdf->Cell(20,10,'College',1,0,'C',true);
            $pdf->Cell(70,10,'Agenda',1,0,'C',true);
            $pdf->Cell(40,10,'Date Uploaded',1,0,'C',true);
            $pdf->Ln();

            $pdf->SetFont('Times','',12);
            $query="SELECT * FROM `uploaddata` WHERE `agenda`='{$array}' ORDER by agenda ASC";
            $stmt = $db->query($query);
            $count=1;

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
        }
    }
$pdf->AliasNbPages();
$pdf->Output();
?>