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
if($post['accion']=="insertarU")
{
    $datos=array();
    $sentencia=sprintf("insert into usuarios (cedula, nombre, apellido,email,telefono,direccion, usuario, clave,tipo_usuario) 
    values ('%s','%s','%s','%s','%s','%s','%s','%s','%s')",$post['cedula'],$post['nombre'],$post['apellido'],$post['email'],$post['telefono'],$post['direccion'],$post['usuario'],md5($post['clave']),$post['tipo_usuario']);
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
if($post['accion']=="insertarC")
{
    $datos=array();
    $sentencia=sprintf("insert into clientes(cedula, nombre, apellido,email, 
    telefono,direccion) values ('%s','%s','%s','%s','%s','%s')",$post['cedula'], $post['nombre'],
     $post['apellido'],$post['email'], $post['telefono'],$post['direccion'] );
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
if($post['accion']=="insertarP")
{
    $datos=array();
    $sentencia=sprintf("insert into productos(nombre, detalle, precio ) values ('%s','%s','%s')",
     $post['nombre'],$post['detalle'], $post['precio']);
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
if($post['accion']=="insertarV")
{
    $datos=array();
    $sentencia=sprintf("insert into registro_ventas(fecha, idproducto,idcliente,idusuario, cantidad,precio_unit,total ) values ('%s','%s','%s','%s','%s','%s','%s')",
     $post['fecha'],$post['idproducto'], $post['idcliente'],$post['idusuario'],$post['cantidad'], $post['precio_unit'], $post['total']);
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
if($post['accion']=="ListarU")
{
    $datos=array();
    $sentencia=sprintf("select * from usuarios where idusuario='%s'",$post['cod']);
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
            'direccion'=>$row['direccion']));
            //'usuario'=>$row['usuario'],
            //'clave'=>$row['clave']));
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
if($post['accion']=="ListarC")
{
    $datos=array();
    $sentencia=sprintf("select * from clientes where idcliente='%s'",$post['cod']);
    $result=mysqli_query($mysqli, $sentencia);
    $f=0;
    while($row=mysqli_fetch_assoc($result))
    {
        array_push($datos,array(
            'idcliente'=>$row['idcliente'],
            'cedula'=>$row['cedula'],
            'nombre'=>$row['nombre'],
            'apellido'=>$row['apellido'],
            'email'=>$row['email'],
            'telefono'=>$row['telefono'],
            'direccion'=>$row['direccion']));
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
if($post['accion']=="ListarP")
{
    $datos=array();
    $sentencia=sprintf("Select * from productos where idproducto='%s'",$post['cod']);
    $result=mysqli_query($mysqli, $sentencia);
    $f=0;
    while($row=mysqli_fetch_assoc($result))
    {
        array_push($datos,array(
            'idproducto'=>$row['idproducto'],
            'nombre'=>$row['nombre'],
            'detalle'=>$row['detalle'],
            'precio'=>$row['precio']));
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
if($post['accion']=="ListarV")
{
    $datos=array();
    $sentencia=sprintf("Select * from registro_ventas where idventa='%s'",$post['cod']);
    $result=mysqli_query($mysqli, $sentencia);
    $f=0;
    while($row=mysqli_fetch_assoc($result))
    {
        array_push($datos,array(
            'idventa'=>$row['idventa'],
            'fecha'=>$row['fecha'],
            'idproducto'=>$row['idproducto'],
            'idcliente'=>$row['idcliente'],
            'idusuario'=>$row['idusuario'],
            'cantidad'=>$row['cantidad'],
            'precio_unit'=>$row['precio_unit'],
            'total'=>$row['total']));
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
if($post['accion']=="modificarU")
{
    $datos=array();
    $sentencia=sprintf("UPDATE usuarios SET  cedula='%',nombre='%s', apellido='%s',email='%s',  telefono='%s',direccion='%s',  where idusuario='%s'", 
    $post['cedula'],$post['nombre'], $post['apellido'],$post['email'],$post['telefono'],$post['direccion'], $post['cod']);
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
if($post['accion']=="modificarP")
{
    $datos=array();
    $sentencia=sprintf("UPDATE productos SET  nombre='%s', detalle='%s', precio='%s'  where idproducto='%s'", $post['nombre'], $post['detalle'],$post['precio'], $post['cod']);
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
if($post['accion']=="modificarV")
{
    $datos=array();
    $sentencia=sprintf("UPDATE registro_ventas SET  fecha='%s', cantidad='%s', precio_unit='%s',total='%s'  where idventa='%s'AND idproducto='%s' AND idcliente='%s' AND idusuario='%s'", $post['fecha'], $post['cantidad'],$post['precio_unit'],$post['total'], $post['idventa'], $post['idproducto'], $post['idcliente'], $post['idusuario']);
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
if($post['accion']=="eliminarU")
{
    $datos=array();
    $sentencia=sprintf("DELETE from usuarios where idusuario='%s'",$post['cod']);
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
if($post['accion']=="eliminarP")
{
    $datos=array();
    $sentencia=sprintf("DELETE from productos where idproducto='%s'",$post['idproducto']);
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
if($post['accion']=="eliminarV")
{
    $datos=array();
    $sentencia=sprintf("DELETE from registro_venta where idventa='%s'",$post['cod']);
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