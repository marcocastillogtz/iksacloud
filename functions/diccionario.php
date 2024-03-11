<?php



function getMessageSQL($ResponseSql)
{
   $xpl = explode("[",$ResponseSql);
   $xpl2 = explode("]",$xpl[1]);
   $msg = getCode($xpl2[0]);
   

    return $msg;
}


function getCode($code)
{
    $message = "";

    if($code=="23000") {
        $message = "El codigo o ID no se puede duplicar; Intente con otro codigo";
    }elseif ($code=="HY093") {
        $message = "Es posible que los campos no coincidan con la sintaxis SQL solicitada";
    }elseif ($code=="42S22") {
        $message = "La columna no se encuentra dentro de la tabla, verifique los campos de la misma";
    }else {
        $message ="NUEVO CODIGO: ".$code;
    }



    return $message;
}
