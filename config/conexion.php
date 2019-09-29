<?php

require_once  "global.php";

$conexion = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

//Consulta a base de datos
mysqli_query( $conexion, 'SET NAMES "'.DB_ENCODE.'"');

//si tenemos error posible en la conexion mostramos:
if(mysqli_connect_errno())
{
    printf("Falló la conexion a la base de datos: %s \n", mysqli_connect_error());
}
if(!function_exists('ejecutarConsulta'))
{
    function ejecutarConsulta($sql)
    {
        global $conexion;
        $query= $conexion->query($sql);
        return $query;
        
    }

    //ejecuta la consulta que recibe por parametro, obtiene una fila como resultado en un array
    function ejecutarConsultaSimpleFila($sql)
	{
		global $conexion;
		$query = $conexion->query($sql);		
		$row = $query->fetch_assoc();
		return $row;
	}

    //devuelve llave primaria
    function ejecutarConsulta_retornarID($sql)
    {
        global $conexion;
        $query =$conexion->$query($sql);
        return $conexion->insert_id;

    }
    function limpiarCadena($str)
    {
        global $conexion;
         $str =mysqli_real_escape_string($conexion, trim($str));
         return htmlspecialchars($str);

    }
}
?>