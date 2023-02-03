<?php
    //Inicia consulta de subastas
    $res_1 = $bd->select("SELECT * from subasta where estado = 0");
    if($res_1->num_rows > 0){
      while($row = $res_1->fetch_assoc()){
        $id_subasta = $row["id_subasta"];
        $min = $row["min"];
        $max = $row["max"];
        $ini = $row["tiempo_ini"];
        $fin = $row["tiempo_fin"];
        $comprador = $row["comprador"];
        $id_producto = $row["id_producto"];

        $datetime_actual = date("Y-m-d H:i:s");
        $datetime1 = date_create($datetime_actual);
        $datetime2 = date_create($fin);
        $interval = $datetime1->diff($datetime2);
        $signo = $interval->format("%R");


        if($signo == "-"){
        //Si tiene un ofertante se pasa a su cesta y cambia el estado de la puja
          if($comprador != null){ 
              $res_2 = $bd->query("INSERT into cesta(id_usuario, id_subasta) values($comprador,$id_subasta);");
              if($res_2 == false){
                echo "<script>alert('Estamos manejando errores');</script>";
              }else{
                $res_2_1 = $bd->query("UPDATE subasta set estado=1 where id_subasta=$id_subasta;");
                if($res_2_1 == false){
                  echo "<script>alert('Estamos manejando errores');</script>";
                }
              }
              //Si no tiene ofertante solo se cambia su estado y en comprador se queda con null
          }else{ 
              $res_3 = $bd->query("UPDATE subasta set estado=1 where id_subasta=$id_subasta;");
              if($res_3 == false){
                echo "<script>alert('Estamos manejando errores');</script>";
              }
          }
        }
      }
    }
?>
