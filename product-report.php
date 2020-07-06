<?php
ob_start();
 
	session_start();
	require_once('./TCPDF/tcpdf.php'); 
	
	$result='';
	$result = $_POST['printvalue'];
	$table .= '<table cellspacing="1" cellpadding="1" border="1">';
			$table .='<thead>
						<tr class="header-row">
						 <th>Option No </th>
						 <th>Type</th>
						 <th>Name</th>
						 <th>Cost Price</th>
						 <th>Option Hours</th>
						 <th>Weight</th>
						 <th>Site Contenet</th>
						 <th>Tech Talk</th>
						 </tr>
						</thead>';
			$table .=$result;
			$table .= '</table>';

  $obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
  $obj_pdf->SetCreator(PDF_CREATOR);  
  $obj_pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  
  $obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
  $obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
  $obj_pdf->SetDefaultMonospacedFont('helvetica');  
  $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
  $obj_pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT);  
  $obj_pdf->setPrintHeader(false);  
  $obj_pdf->setPrintFooter(false);  
  $obj_pdf->SetAutoPageBreak(TRUE, 5);  
 // $obj_pdf->SetFont('helvetica', '',8);  
   //$obj_pdf->SetTitle($scheme);
   $obj_pdf->AddPage('L', 'A4'); 
  $obj_pdf->SetY(20);
  //$obj_pdf->Cell(50,60,$scheme, 0, 0, 'C', 0, '', 1);
  $obj_pdf->SetFont('helvetica', '',12); 

  $obj_pdf->writeHTML($table, true, 0, true, 0);
  ob_end_clean();
  $obj_pdf->Output('product-Report.pdf');  


?>