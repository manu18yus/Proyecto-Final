<?php

    session_start();
    include ("config/database.php");

    //Seleccionaremos los datos de la base de datos que queremos que se muestren para la impresión 
    $conn=mysqli_connect("localhost", "root", "root", "blog");
    $query="SELECT nombre, precio, descripcion, codigo FROM productos WHERE id=".$_GET['id'].";";
    $res=mysqli_query($conn, $query);
    $row=mysqli_fetch_assoc($res);

    if($row){
?>
<style>
    table{
        width: 100%;
        border: 100%;
    }
    td, th{
        width: 33%;
        border: 1px solid #000;
    }
    thead{
        font-weight: bold;
        text-align:center;
    }
</style>
<!-- Creación de una tabla para la impresión a pdf -->
   <table cellspacing="0">
        <thead>
            <tr>
                <th colspan="4">Productos</th>
            </tr>
            <tr>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Descripcion</th>
                <th>Codigo</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?php echo $row['nombre'] ?></td>
                <td><?php echo $row['precio'] ?></td>
                <td><?php echo $row['descripcion'] ?></td>
                <td><?php echo $row['codigo'] ?></td>
            </tr>
        </tbody>
    </table>
<?php
    }else{
        echo "No hay datos";
    }

?>
  
 
    


