<?php 
    require_once 'vendor/autoload.php';
    require_once 'config.php';

    //Init cURL  

    $document = curl_init( 'https://mirinstrumenta.ua/category/pnevmogaykoverti.html' );

    //Set cURL options
    curl_setopt( $document, CURLOPT_RETURNTRANSFER, true );
    curl_setopt( $document, CURLINFO_HEADER_OUT, true );
    curl_setopt( $document, CURLOPT_FOLLOWLOCATION, true );

    $html = curl_exec( $document );
    
    //Init library phpQuery
    phpQuery::newDocument( $html );
    
    $items = pq( '.price' );

    //Create request to datatable
    $sql = "INSERT INTO site_info (domain, page_url, price, discount, product_discount) VALUES ";

    //Generate options and save to the datable
    foreach ( $items as $item  ) {
        
        $info = curl_getinfo($document);

        $domain = array_map('trim',explode("/" ,$info['url']));


        $item = pq($item)->text();
        $arrayStr = explode(" ", $item);

        $price          = $arrayStr[1];
        $discount       = $arrayStr[3];
        $priceDiscount  = $arrayStr[5];
        $pageUrl        = $info['url'];
        
        $sql .= "( '" . $domain[2] . "', '" . $pageUrl . "', '" . $price . "', '" . $discount . "', '" . $priceDiscount . "') ,";
    }

    
    $sql = rtrim($sql,",");
    
    phpQuery::unloadDocuments($html);
    
    if($connect->query($sql) === false) {
        echo "Error: " . $sql . "<br>" . $connect->error;
    }

    mysqli_close($connect);
