<?php

//incluimos conexion a base de datos
require "../config/conexion.php";

Class Categoria
{
    //implementamos  nuestro constructor

    public function __construc()
    {

    }
    //metodo para insertar registros
    public function insertar($nombre, $descripcion) 
    {
        //variable para ejecutar CADENA  codigo sql
        $sql ="INSERT INTO categoria(nombre,descripcion,condicion)
        VALUES('$nombre','$descripcion','1')";
        return ejecutarConsulta($sql);

    }
      //implementamos metodo para editar registros
     
      public function editar($idcategoria, $nombre, $descripcion )
      {
          $sql="UPDATE categoria SET nombre= '$nombre', descripcion='$descripcion'
           WHERE idcategoria='$idcategoria'";
           return ejecutarConsulta($sql);

      }
      //metodo para desactivar categorias
      public function desactivar($idcategoria){
          $sql= "UPDATE categoria SET condicion='0' WHERE idcategoria='$idcategoria'";
          return ejecutarConsulta($sql);
      }

       //metodo para activar categorias
       public function activar($idcategoria){
        $sql= "UPDATE categoria SET condicion='1' WHERE idcategoria='$idcategoria'";
        return ejecutarConsulta($sql);
    }
    //metodo para mostrar datos de un registro a modificar
    public function mostrar($idcategoria) 
    {
        $sql="SELECT * FROM categoria WHERE idcategoria='$idcategoria'";
        return ejecutarConsultaSimpleFila($sql);
    }

    //metodo listar registros
    public function listar()
    {
        $sql="SELECT * FROM categoria";
        return ejecutarConsulta($sql);
    }
     //metodo listar registros y mostrar en select
    public function select()
    {
        $sql="SELECT * FROM categoria WHERE condicion=1";
        return ejecutarConsulta($sql);
    }
    }
?>