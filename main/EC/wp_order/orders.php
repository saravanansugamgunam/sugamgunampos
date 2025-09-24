<?php
require __DIR__ . '/vendor/autoload.php';

use Automattic\WooCommerce\Client;

$woocommerce = new Client(
    'https://sugamgunam.com/',
    'ck_db9e8bfe128b879f2db6778446cb7d94c62bc9f1',
    'cs_81fdb5c3b8c87768c0b95d3dd8a0390b9051583f',
    [
        'wp_api' => true,
        'version' => 'wc/v3',
        'query_string_auth' => true // Force Basic Authentication as query string true and using under HTTPS
    ]
);


$products = array();
$data = array(  
    'per_page' => 30 
     
);

// $products=$woocommerce->get('products',$data);

//   echo json_encode($woocommerce->get('orders',$data)); 
  echo json_encode($woocommerce->get('orders',$data)); ?>