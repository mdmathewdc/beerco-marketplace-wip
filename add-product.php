<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

$ds          = DIRECTORY_SEPARATOR;  //1
 
$storeFolder = 'img/uploads';   //2
 
if (!empty($_FILES)) {
     
    $tempFile = $_FILES['file']['tmp_name'];          //3             
      
    $targetPath = dirname( __FILE__ ) . $ds. $storeFolder . $ds;  //4
     
    $targetFile =  $targetPath. $_FILES['file']['name'];  //5
 
    move_uploaded_file($tempFile,$targetFile); //6

}

$fileNames = array();
$base64Data = array();

foreach (new DirectoryIterator(__DIR__ . "/img/uploads") as $file) {
    if ($file->isFile()) {
        //print $file->getFilename() . "\n";
        array_push($fileNames, "img/uploads/".$file->getFilename());
    }
  }

foreach ($fileNames as $fileName) {
    //print $fileName . "\n";
    $image = file_get_contents($fileName);
    $base64 = base64_encode($image);
    array_push($base64Data, $base64);
}

$images = array();

foreach ($base64Data as $base64) {
    array_push($images, array('attachment' => $base64));
}

/* Convert image to Base64 */

$image = file_get_contents("img/uploads/11.png");
$base64 = base64_encode($image);
// echo $base64;

/////////////////////////////////////////////////

$productName = $_POST['productName'];
$productDescription = $_POST['productDescription'];
$vendorName = $_POST['vendorName'];
$productCategory = $_POST['productCategory'];

$apiKey = "5e0c9d0ee789975147ebd70d5d71cb1f";
$pwd = "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";

$baseUrl = "https://".$apiKey .":". $pwd ."@beerco-pty-ltd.myshopify.com";


// $product =
//     array('title' => $productName,
//         'body_html' => $productDescription,
//         'vendor'=> $vendorName,
//         'product_type'=> $productCategory,
//         'variants' => array(
//             array('option1' => 'Default',
//                 'price' => '100.00',
//                 'sku' => 'ABC123',
//                 'inventory_quantity'=> '999',
//                 'inventory_management' => 'shopify',
//                 'taxable' => true,
//                 'requires_shipping' => true
//             )
//         ),
//         'status' => 'draft',
//         'images' => array(
//             array(
//             'attachment' => $base64Data[2]
//             ),
//             array(
//             'attachment' => $base64Data[0]
//                 )
//         )
//     );

    $product =
    array('title' => $productName,
        'body_html' => $productDescription,
        'vendor'=> $vendorName,
        'product_type'=> $productCategory,
        'variants' => array(
            array('option1' => 'Default',
                'price' => '100.00',
                'sku' => 'ABC123',
                'inventory_quantity'=> '999',
                'inventory_management' => 'shopify',
                'taxable' => true,
                'requires_shipping' => true
            )
        ),
        'status' => 'draft'
    );

    $product['images'] = $images;

$ch = curl_init($baseUrl.'/admin/products.json'); //set the url
$data_string = json_encode(array('product'=>$product)); //encode the product as json
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");  //specify this as a POST
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string); //set the POST string
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); //specify return value as string
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen($data_string))
); //specify that this is a JSON call
echo $server_output = curl_exec ($ch); //get server output if you wish to error handle / debug
curl_close ($ch); //close the connection
//echo $data_string;


