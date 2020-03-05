<?php
declare(strict_types=1);

require 'vendor/autoload.php';

use PhpCfdi\Finkok\FinkokEnvironment;
use PhpCfdi\Finkok\FinkokSettings;
use PhpCfdi\Finkok\QuickFinkok;


$setting = new FinkokSettings('ricardo.garcia.cuellar@gmail.com',	'Talos_88', FinkokEnvironment::makeDevelopment());
$finkok = new QuickFinkok($setting);

$precfdi =	file_get_contents('tmp/factura.xml');

$stampResult	=	$finkok->stamp($precfdi);

if ($stampResult->hasAlerts()) { // stamp es un objeto con propiedades nombradas
    foreach ($stampResult->alerts() as $alert) {
        echo $alert->id() . ' - ' . $alert->message() . PHP_EOL;
    }
} else {
    file_put_contents($stampResult->uuid() . '.xml', $stampResult->xml()); // CFDI firmado
}