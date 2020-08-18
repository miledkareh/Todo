<?php
//============================================================+
// File name   : example_001.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 001 for TCPDF class
//               Default Header and Footer
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: Default Header and Footer
 * @author Nicola Asuni
 * @since 2008-03-04
 */

// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola ');
$pdf->SetTitle('TCPDF Example 001');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
$pdf->setFooterData(array(0,64,0), array(0,64,128));

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$pdf->SetFont('dejavusans', '', 14, '', true);

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();

// set text shadow effect
$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));

// Set some content to print
  session_start();
   
  		if (!isset($_SESSION['Login']) || $_SESSION['Login']!=true  )
								{
									header("Location: ./blank.php");
									echo "<script>location='./blank.php'</script>";
								}
  
require('fpdf/fpdf.php');
class PDF_MC_Table extends FPDF
{
var $widths;
var $aligns;
	function Header()
{
	$this->SetFont('Arial','B',15);
	$this->SetTextColor(53,63,75);
	$this->Image('philka.png',10,10,50);
	// Title
	$this->Cell(187,20,'Timesheet',0,0,'R');
	$this->SetFont('Arial','',10);
$this->ln(10);
		if(isset($_GET['f']))
	$this->Cell(187,20,'From date: '.date("d/m/Y",strtotime($_GET['f'])),0,0,'R');
	$this->ln(5);
	if(isset($_GET['t']))
	$this->Cell(187,20,'To date: '.date("d/m/Y",strtotime($_GET['t'])),0,0,'R');	
	$this->ln(25);
	
	
}
function Footer()
{
	// Position at 1.5 cm from bottom
	$this->SetY(-30);
	// Arial italic 8
	$this->SetFont('Arial','I',8);
	// Page number
	$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
	
}
function SetWidths($w)
{
	//Set the array of column widths
	$this->widths=$w;
}

function SetAligns($a)
{
	//Set the array of column alignments
	$this->aligns=$a;
}

function Row($data,$fill)
{
	//Calculate the height of the row
	$nb=0;
	for($i=0;$i<count($data);$i++)
		$nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
	$h=5*$nb;
	//Issue a page break first if needed
	$this->CheckPageBreak($h);
	//Draw the cells of the row
	for($i=0;$i<count($data);$i++)
	{
		$w=$this->widths[$i];
		$a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
		//Save the current position
		$x=$this->GetX();
		$y=$this->GetY();
		//Draw the border
		$this->SetDrawColor(53,63,75);
		$this->Rect($x,$y,$w,$h);
		//Print the text
		$this->MultiCell($w,5,$data[$i],0,$a,$fill);
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
		$this->AddPage($this->CurOrientation);
}

function NbLines($w,$txt)
{
	//Computes the number of lines a MultiCell of width w will take
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
$pdf=new PDF_MC_Table();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',14);

//Table with 20 rows and 4 columns
$pdf->SetWidths(array(25,27,50,20,20,20,28));
include('configdb.php');
require_once(dirname(__FILE__).'/fpdf/lang/eng.php');
$strp_txt = stripslashes("اه نششيش");
$pdf->SetFont('dejavusans', '', 14, '', true);
$pdf->Cell(187,20,$strp_txt."dsv",0,0,'R');

	$totalm=0;
$totalh=0;
$countt=0;
$totalmns=0;
$totalhrs=0;
//$totalcost=0;
//$totalcost1=0;
if(isset($_GET['p']))
	{
		$query = "Select distinct(ticketid)as project,(select subject from tickets where serial = timesheet.ticketid)as taskN  from timesheet where ticketid=".$_GET['p'];
	}
else
	$query = "Select distinct(ticketid)as project,(select subject from tickets where serial = timesheet.ticketid)as taskN  from timesheet";
	//echo $query;
	 $result = mysqli_query($dbhandle,$query)  or die(mysqli_error());
	 while($y = mysqli_fetch_array($result)){
		 $query = "Select *,(select Fullname from users where serial=timesheet.employee) as Employee,
    (select subject from tickets where serial = timesheet.ticketid)as taskN from timesheet where ticketid =".$y['project']." ";
if(isset($_GET['u']))
$query=$query." and employee=".$_GET['u'];
if(isset($_GET['f']))
$query=$query." and fromdate >='".$_GET['f']."' ";
if(isset($_GET['t']))
$query=$query." and todate <='".$_GET['t']."' ";	
	
$results = mysqli_query($dbhandle,$query)  or die(mysqli_error());
if(mysqli_num_rows($results)>0){
		 		$pdf->SetFont('Arial','',12);
				$pdf->SetTextColor(53,63,75);
		  $pdf->Cell(0,0,"Task: ".$y['taskN'],0,0,'L');
   $pdf->Ln(3);
		$pdf->SetFont('Arial','B',9);
$pdf->SetWidths(array(35,35,50,35,35));
		$pdf->setFillColor(53,63,75);
$pdf->setTextColor(255,255,255); 	
		$pdf->Row(array('Employee','Description','From Date','To Date','Hours'),true);
			$pdf->SetFont('Arial','',9);
				$pdf->setFillColor(255,255,255); 
				$pdf->setTextColor(0,0,0); 
	
		$balance=0;

	 
    
	while($x = mysqli_fetch_array($results)){
				 $t1 = StrToTime ( $x["fromdate"] );
$t2 = StrToTime ( $x["todate"] );
$diff = $t2 - $t1;
$mns = $diff / ( 60);
$mns= ( $mns % 60);
$hours = $diff / ( 60 *60);
$hours=round($hours, 0, PHP_ROUND_HALF_DOWN);;
$totalmns=$totalmns+$mns;
$totalhrs=$totalhrs+$hours;
		$pdf->Row(array($x['Employee'],$x['description'],date('d-m-Y H:i',strtotime($x["fromdate"])),date('d-m-Y H:i',strtotime($x["todate"])),$hours.":".$mns),false);
	 }
	 	$mns=floor($totalmns/60);
		  $modmns=$totalmns%60;
		  $totalhrs=$totalhrs+$mns;
		  $totalh=$totalh+ $totalhrs;
		  $totalm=$modmns+$totalm;
		$pdf->Cell(187,20,'Total Task Hours: '.(string)$totalhrs."hrs ,".(string)$modmns." mns",0,0,'R');
	$pdf->Ln();
	
	 }}
	 $totalm1=floor($totalm/60);
		  $totalm=$totalm%60;
		  $totalh=$totalh+$totalm1;	  
		  	$pdf->SetFont('Arial','B',12);
		  	$pdf->Cell(187,20,'Total Hours: '.(string)$totalh."hrs ,".(string)$totalm." mns",0,0,'R');

$pdf->Output();

// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('example_001.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
