<?php

$archivoXml = base64_encode(file_get_contents('tmp/factura.xml'));

$alta = '
<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:stam="http://facturacion.finkok.com/stamp">
<soapenv:Header/>
<soapenv:Body>
   <stam:stamp>
      <!--Optional:-->
      <stam:xml>'.$archivoXml.'</stam:xml>
      <!--Optional:-->
      <stam:username>ricardo.garcia.cuellar@gmail.com</stam:username>
      <!--Optional:-->
      <stam:password>Talos_88</stam:password>
   </stam:stamp>
</soapenv:Body>
</soapenv:Envelope>';

$endpoint = 'https://demo-facturacion.finkok.com/servicios/soap/stamp.wsdl';

$soap_do = curl_init();
curl_setopt($soap_do, CURLOPT_URL, $endpoint) ;  
curl_setopt($soap_do, CURLOPT_CONNECTTIMEOUT, 5000); 
curl_setopt($soap_do, CURLOPT_TIMEOUT, 5000); 
curl_setopt($soap_do, CURLOPT_RETURNTRANSFER, true );
//curl_setopt($soap_do, CURLOPT_SSLCERTTYPE, "PEM");
//curl_setopt($soap_do, CURLOPT_SSLCERT,  $cert_path);
//curl_setopt($soap_do, CURLOPT_SSLKEY,  $key_path);
//curl_setopt($soap_do, CURLOPT_SSLCERTPASSWD, $cert_password);
curl_setopt($soap_do, CURLOPT_POST,  true ); 
curl_setopt($soap_do, CURLOPT_SSL_VERIFYPEER, 0);  
curl_setopt($soap_do, CURLOPT_SSL_VERIFYHOST, 0); 
curl_setopt($soap_do, CURLOPT_POSTFIELDS, $alta); 
curl_setopt($soap_do, CURLOPT_HTTPHEADER, array('Content-Type: text/xml'));

$response = curl_exec($soap_do);
//echo $response->CodEstatus/*['stampResult ']['CodEstatus']*/;
curl_close($soap_do);


