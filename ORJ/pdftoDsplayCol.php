
<?php
    session_start();
    $index=0;
	include('pdf_mc_table3.php');
	$db= new PDO ('mysql:host=localhost;dbname=ovpretdb','root','');
    if($_SESSION['flag']==1){
        $pdf = new PDF_MC_Table();
	    $pdf->SetLeftMargin(15);
        $pdf->SetWidths(array(10,30,70,40,40,30,65,41));//width for each column
        $pdf->SetAligns(array('C','C','C','C','C','C','C','C'));
	    $pdf->SetLineHeight(5);//height of each line not rows
        $pdf->AddPage('L','Legal',0);
        $pdf->SetFont('Times','',12);
        $query="SELECT * FROM `uploaddata` WHERE `acronym`='{$_SESSION['col']}' ORDER by acronym ASC";
        $stmt = $db->query($query);
        $count=1;

        $pdf->SetTextColor(0,0,0);
        if($stmt->rowCount()>0){
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
            $pdf->SetFont('Times','',12);
            $pdf->SetTextColor(0,0,0);
            $pdf->Cell(326,10,'No Result Found',1,0,'C');
        }   
        $pdf->AliasNbPages();
        $pdf->Output();
    }else{
        $arr=explode(',',$_SESSION['col']);
        $arr2=explode(',',$_SESSION['sort']);
        
        $pdf = new PDF_MC_Table();
        foreach($arr as $array){
            $_SESSION['col']=$array;
            $_SESSION['sort']=$arr2[$index];
            $pdf->SetLeftMargin(15);
            $pdf->SetWidths(array(10,30,70,40,40,30,65,41));//width for each column
            $pdf->SetAligns(array('C','C','C','C','C','C','C','C'));
            $pdf->SetLineHeight(5);//height of each line not rows
            $pdf->AddPage('L','Legal',0);
            $pdf->SetFont('Times','',12);
            $query="SELECT * FROM `uploaddata` WHERE `acronym`='{$array}' ORDER by acronym ASC";
            $stmt = $db->query($query);
            $count=1;

            $pdf->SetTextColor(0,0,0);
            if($stmt->rowCount()>0){
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
                $pdf->SetFont('Times','',12);
                $pdf->SetTextColor(0,0,0);
                $pdf->Cell(326,10,'No Result Found',1,0,'C');
            }
            $index+=1;
        }
        $pdf->AliasNbPages();
        $pdf->Output();
    }

?>