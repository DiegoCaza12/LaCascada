<?php
header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Credentials:true');
header('Access-Control-Allow-Methods: PUT,GET,POST,DELETE,OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, Authorization, Accept, X-Request-Width, x-xsrf-token');
header('Content-Type: application/json; charset=utf-8');
include 'config.php';
$post=json_decode(file_get_contents('php://input'),true);
if($post['accion']=="loggin")
{
    $datos=array();
    $sentencia=sprintf("Select * from usuarios where usuario='%s' and clave='%s'",$post['usuario'],md5($post['clave']));
    $result=mysqli_query($mysqli, $sentencia);
    $f=0;
    while($row=mysqli_fetch_assoc($result))
    {
        array_push($datos,array(
            'idusuario'=>$row['idusuario'],
            'cedula'=>$row['cedula'],
            'nombre'=>$row['nombre'],
            'apellido'=>$row['apellido'],
            'email'=>$row['email'],
            'telefono'=>$row['telefono'],
            'direccion'=>$row['direccion'],
            'tipo_usuario'=>$row['tipo_usuario']));
            $f++;
    }
    if($f>0)
    {
        $respuesta= json_encode(array('estado'=>true, 'datos'=>$datos));
    }
    else
    {
        $respuesta= json_encode(array('estado'=>false));
    }
echo $respuesta;
}
if($post['accion']=="ListarU")
{
    $datos=array();
    $sentencia=sprintf("select * from usuarios");
    $result=mysqli_query($mysqli, $sentencia);
    $f=0;

    while($row=mysqli_fetch_assoc($result))
    {
        array_push($datos,array(
            'cedula'=>$row['cedula'],
            'nombre'=>$row['nombre'],
            'apellido'=>$row['apellido'],
            'email'=>$row['email'],
            'telefono'=>$row['telefono'],
            'direccion'=>$row['direccion'],
            'usuario'=>$row['usuario'],
            'clave'=>$row['clave'],
            'tipo usuario'=>$row['tipo usuario']));
            $f++;
    }
    if($f>0)
    {
        $respuesta= json_encode(array('estado'=>true, 'datos'=>$datos));
    }
    else
    {
        $respuesta= json_encode(array('estado'=>false));
    }
    echo $respuesta;
}
if($post['accion']=="insertarU")
{
    $datos=array();
    $sentencia=sprintf("insert into usuarios (cedula, nombre, apellido, email, telefono, direccion, usuario, clave, tipo usuario) 
    values ('%s','%s','%s','%s','%s','%s','%s','%s','%s')",$post['cedula'],$post['nombre'],$post['apellido'],$post['email'],$post['telefono'],$post['direccion'],$post['usuario'],md5($post['clave'],$post['tipo usuario']));
    $result=mysqli_query($mysqli, $sentencia);

    if($result)
    {
        $respuesta= json_encode(array('estado'=>true));
    }
    else
    {
        $respuesta= json_encode(array('estado'=>false));
    }
echo $respuesta;
}

if($post['accion']=="insertc")
{
    $datos=array();
    $sentencia=sprintf("insert into contacto(persona_codigo, nombre, apellido, 
    telefono) values ('%s','%s','%s','%s')",$post['codigo'], $post['nombre'],
     $post['apellido'], $post['telefono'] );
    $result=mysqli_query($mysqli, $sentencia);

    if($result)
    {
        $respuesta= json_encode(array('estado'=>true));
    }
    else
    {
        $respuesta= json_encode(array('estado'=>false));
    }
echo $respuesta;
}

if($post['accion']=="Listar2")
{
    $datos=array();
    $sentencia=sprintf("select * from contacto where codigo='%s'",$post['cod']);
    $result=mysqli_query($mysqli, $sentencia);
    $f=0;
    while($row=mysqli_fetch_assoc($result))
    {
        array_push($datos,array(
            'codigo'=>$row['codigo'],
            'nombre'=>$row['nombre'],
            'apellido'=>$row['apellido'],
            'telefono'=>$row['telefono']));
            $f++;
    }
    if($f>0)
    {
        $respuesta= json_encode(array('estado'=>true, 'datos'=>$datos));
    }
    else
    {
        $respuesta= json_encode(array('estado'=>false));
    }
    echo $respuesta;
}
if($post['accion']=="modificar")
{
    $datos=array();
    $sentencia=sprintf("UPDATE contacto SET  nombre='%s', apellido='%s',  telefono='%s'  where codigo='%s'", 
    $post['nombre'], $post['apellido'],$post['telefono'], $post['codigo']);
    $result=mysqli_query($mysqli, $sentencia);

    if($result)
    {
        $respuesta= json_encode(array('estado'=>true));
    }
    else
    {
        $respuesta= json_encode(array('estado'=>false));
    }
echo $respuesta;
}
if($post['accion']=="eliminar")
{
    $datos=array();
    $sentencia=sprintf("delete from contacto where codigo='%s'",$post['cod']);
    $result=mysqli_query($mysqli, $sentencia);

    if($result)
    {
        $respuesta= json_encode(array('estado'=>true));
    }
    else
    {
        $respuesta= json_encode(array('estado'=>false));
    }
echo $respuesta;
}