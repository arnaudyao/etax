<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Printer connector type
    |--------------------------------------------------------------------------
    |
    | Connection protocol to communicate with the receipt printer.
    | Valid values are: cups, network, windows
    |
    */
   // 'connector_type' => 'network',
    //'connector_type' => 'printer',
    'connector_type' => 'windows',
    /*
    |--------------------------------------------------------------------------
    | Printer connector descriptor
    |--------------------------------------------------------------------------
    |
    | Typically printer name or IP address.
    |
    */
    //'connector_descriptor' => '169.254.45.214',
   // 'connector_descriptor' => 'POS-80',
    'connector_descriptor' => 'printer',
    //'connector_descriptor' => 'USBPRINT\PrinterPOS-80\6&6b622ef&0&USB002',
    //'connector_descriptor' => 'USBPRINT\PrinterPOS-80\6&1cdd8bac&0&USB002',
    /*
    |--------------------------------------------------------------------------
    | Printer port
    |--------------------------------------------------------------------------
    |
    | Typically 9100.
    |
    */
    /*'connector_port' => 'com',*/
    'connector_port' => 'ESDPRT001',
    //'connector_port' => 'USB002',
];
