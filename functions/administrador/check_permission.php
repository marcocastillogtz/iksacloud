<?php

    require('../../entidades/login.php');

    $object_login = new Login;
    $data_login = $object_login->getPermission();

    if($data_login>0){
        foreach($data_login as $value){
            $json[]=array(
                'id_user' => $value['ID'],
                'name'=> $value['NOMBRE'],
                'middle_name'=> $value['APELLIDO_P'],
                'last_name'=> $value['APELLIDO_M'],
                'mail'=> $value['CORREO'],
                'phone'=> $value['TELEFONO'],
                'id_register'=> $value['ID_REGISTRO'],
                'status_user'=> $value['ESTATUS'],
                'user'=> $value['USUARIO'],
                'password'=> $value['CONTRASENA'],
                'classification'=> $value['CLASIFICACION'],
                'text'=> $value['TEXTO'],
                'fk_user'=> $value['USUARIO_FK'],
                'roll'=> $value['ROLL'],
                'agrement_client'=> $value['CLIENTE_ASIGNADO'],
                'avatar'=> $value['AVATAR'],
                'log'=> $value['LOG'],
                'level'=> $value['NIVEL'],
                'description'=> $value['DESCRIPCION'],
                'id_permision'=> $value['id_permiso'],
                'user_permision'=> $value['usuario'],
                'rol_permision'=> $value['rol'],
                'field_administrador'=> $value['administrador'],
                'feld_ventas'=> $value['ventas'],
                'field_cobranza'=> $value['cobranza'],
                'field_facturacion'=> $value['facturacion'],
                'field_checkout'=> $value['checkout'],
                'field_planeacion'=> $value['productos y servicios'],
                'field_administrativo'=> $value['administrativo'],
                'field_paqueteria'=> $value['paqueteria'],
                'field_bancos'=> $value['bancos'],
                'field_scannloot'=> $value['scannloot'],
                'field_PUA'=> $value['PUA'],
                'field_kyc'=> $value['kyc'],
                'field_copy_paste'=> $value['copy_paste']
            );
        }

        $jsonString = json_encode($json);
        echo $jsonString; 
    }
