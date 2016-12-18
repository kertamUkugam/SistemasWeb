<?php

require_once('lib/nusoap.php');
require_once('lib/class.wsdlcache.php');



$server = new soap_server;

$ns = "http://localhost/Proyecto_SW";

$server->configureWSDL('compPs',$ns);
$server->wsdl->schemaTargetNamespace=$ns;

$server->register('compPs',array('pass'=>'xsd:string'),array('msg'=>'xsd:string'));



function compPs($pass){
    $fp=fopen("toppasswords.txt","r") or exit("Unable to open file!");;
    $res="VALIDA";
    while(!feof($fp)){
        $linea=fgets($fp);
        if (strcmp (trim($linea),$pass) == 0){
            $res="INVALIDA";
        }
    }
    fclose($fp);
    return $res;
}

$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA)? $HTTP_RAW_POST_DATA:'';
$server->service($HTTP_RAW_POST_DATA);



?>