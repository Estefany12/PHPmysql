<?php

//Activamos el almacenamiento en el buffer
ob_start();
<?php
if (strlen(session_id()) <1) 

session_start();

if (!isset($_SESSION["nombre"]))
{
  echo 'Debe ingresar al sistema correctamente para poder visualizar el reporte';
}
else
{
    
if ($_SESSION['almacen']==1)
{

    //incluimos a la clase pdf_mc_table
    require('PDF_MC_Table.php');

    //instanciamos a la clase para generar el documento pdf
    $pdf=new PDF_MC_Table();
    //agremamos la primera pagina al documento pdf
    $pdf->AddPage();
    //seteamos el inicio del margen superior en 25 pixeles
   
    $y_axis_initial = 25;

    //seteamos el tipo de letra y creamo el titulo de la pagina (No es un encabezado)
    $pdf->SetFont('Arial','B', 12);
    $pdf->Cell(40,6,'',0,0,'C');
    $pdf->Cell(100,6,'Lista de articulos',1,0,'C'); //titulo
    $pdf->Ln(10); //rectangulo, titulo en rectangulo

    //Creamos las celdas para los titulos de cada columna con fondo gris y tipo de letra
    $pdf->SetFillColor(252,232,232);
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(58,6,'Nombre',1,0,'C',1);
    $pdf->Cell(50,6, utf8_decode,('categoria'),1,0,'C',1);
    $pdf->Cell(50,6, utf8_decode,('codigo'),1,0,'C',1);
    $pdf->Cell(12,6,'Stock',1,0,'C',1);
    $pdf->Cell(15,6,utf8_decode,('descripcion'),1,0,'C',1);
    $pdf->Ln(10);

    //comenzamos a crear las filas de los registros segun la consulta mysql
    require_once "../modelos/Articulo.php";
    $articulo= new Articulo();

    $rspta= $articulo->listar();
    
   //Implementamos las celdas de la tabla con los registros a mostrar
$pdf->SetWidths(array(58,50,30,12,35));
 
while($reg= $rspta->fetch_object())
{  
    $nombre = $reg->nombre;
    $categoria = $reg->categoria;
    $codigo = $reg->codigo;
    $stock = $reg->stock;
    $descripcion =$reg->descripcion;
     
    $pdf->SetFont('Arial','',10);
    $pdf->Row(array(utf8_decode($nombre),utf8_decode($categoria),$codigo,$stock,utf8_decode($descripcion)));
}
 
//Mostramos el documento pdf
$pdf->Output();
}

else
{
  echo ' No tiene permiso para visualizar reporte';
}

}

ob_end_flush();
?>