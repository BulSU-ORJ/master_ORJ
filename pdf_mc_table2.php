<?php
//call main fpdf file
require('fpdf/fpdf.php');
//create new class extending fpdf class
class PDF_MC_Table extends FPDF {
	function header(){
        
			$this->Image('Icon/reportLogo.png',80,15);
			$this->SetFont('Arial','B',14);
			$this->Cell(0,10,'',0,0,"C");
			$this->Ln();
			$this->SetFont('Arial','B',14);
			$this->Cell(0,6,'Republic of the Philippines',0,0,"C");
			$this->Ln();
			$this->SetFont('Arial','B',28);
			$this->Cell(0,9,'Bulacan State University',0,0,"C");
			$this->Ln();
			$this->SetFont('Arial','B',16);
			$this->Cell(0,6,'City of Malolos, Bulacan',0,0,"C");
			$this->Ln(20);
			$this->SetFont('Arial','',16);
			$this->Cell(0,0,'OFFICE OF THE VICE-PRESIDENT FOR RESEARCH, EXTENSION AND TRAINING',0,0,"C");
			$this->Ln();
			$this->Cell(0,15,'',0,0,"C");
			$this->Ln();
			$this->Line(15, 60, 341, 60);
            
			$this->SetFont('Arial','',16);
			$this->Cell(0,0,$_SESSION['sort'],0,0,"C");
			$this->Ln(10);
			$this->SetFillColor(118,52,53);
			$this->SetTextColor(255,255,255);
			$this->SetDrawColor(118,52,53);
			$this->SetFont('Times','B',11);
			$this->Cell(10,10,'No.',1,0,'C',true);
			$this->Cell(30,10,'Research No.',1,0,'C',true);
			$this->Cell(70,10,'Research Title',1,0,'C',true);
			$this->Cell(40,10,'Author',1,0,'C',true);
			$this->Cell(40,10,'Email',1,0,'C',true);
			$this->Cell(20,10,'College',1,0,'C',true);
			$this->Cell(70,10,'Agenda',1,0,'C',true);
			$this->Cell(40,10,'Date Uploaded',1,0,'C',true);
			$this->Ln();
			
		}
		function footer(){
            date_default_timezone_set("Asia/Hong_Kong");
			$this->setY(-25);
			$this->setFont('Arial','',8);
			$this->Cell(0,0,'Prepared By: '.ucwords($_SESSION["adminName"]),0,0,'L');
            $this->Ln();
			$this->setFont('Arial','',8);
			$this->Cell(0,8,'As of:'.date("m/d/Y h:i a"),0,0,'L');
			$this->setFont('Arial','',8);
			$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'R');
		}
// variable to store widths and aligns of cells, and line height
var $widths;
var $aligns;
var $lineHeight;
//Set the array of column widths
function SetWidths($w){
    $this->widths=$w;
}
//Set the array of column alignments
function SetAligns($a){
    $this->aligns=$a;
}
//Set line height
function SetLineHeight($h){
    $this->lineHeight=$h;
}
//Calculate the height of the row
function Row($data)
{
    // number of line
    $nb=0;
    // loop each data to find out greatest line number in a row.
    for($i=0;$i<count($data);$i++){
        // NbLines will calculate how many lines needed to display text wrapped in specified width.
        // then max function will compare the result with current $nb. Returning the greatest one. And reassign the $nb.
        $nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
    }
    
    //multiply number of line with line height. This will be the height of current row
    $h=$this->lineHeight * $nb;
    //Issue a page break first if needed
    $this->CheckPageBreak($h);
    //Draw the cells of current row
    for($i=0;$i<count($data);$i++)
    {
        // width of the current col
        $w=$this->widths[$i];
        // alignment of the current col. if unset, make it left.
        $a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
        //Save the current position
        $x=$this->GetX();
        $y=$this->GetY();
        //Draw the border
        $this->Rect($x,$y,$w,$h);
        //Print the text
        $this->MultiCell($w,5,$data[$i],0,$a);
        //Put the position to the right of the cell
        $this->SetXY($x+$w,$y);
    }
    //Go to the next line
    $this->Ln($h);
}
function CheckPageBreak($h)
{
    //If the height h would cause an overflow, add a new page immediately
    if($this->GetY()+$h>$this->PageBreakTrigger)
        $this->AddPage('L','Legal',0);
}
function NbLines($w,$txt)
{
    //calculate the number of lines a MultiCell of width w will take
    $cw=&$this->CurrentFont['cw'];
    if($w==0)
        $w=$this->w-$this->rMargin-$this->x;
    $wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
    $s=str_replace("\r",'',$txt);
    $nb=strlen($s);
    if($nb>0 and $s[$nb-1]=="\n")
        $nb--;
    $sep=-1;
    $i=0;
    $j=0;
    $l=0;
    $nl=1;
    while($i<$nb)
    {
        $c=$s[$i];
        if($c=="\n")
        {
            $i++;
            $sep=-1;
            $j=$i;
            $l=0;
            $nl++;
            continue;
        }
        if($c==' ')
            $sep=$i;
        $l+=$cw[$c];
        if($l>$wmax)
        {
            if($sep==-1)
            {
                if($i==$j)
                    $i++;
            }
            else
                $i=$sep+1;
            $sep=-1;
            $j=$i;
            $l=0;
            $nl++;
        }
        else
            $i++;
    }
    return $nl;
}
}

?>