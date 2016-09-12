<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include(dirname(__FILE__)."/aws/aws-autoloader.php");

use Aws\S3\S3Client;

class S3
{
  protected $client;
  public function __construct()
  {


    $this->client = S3Client::factory(array(
        'credentials' => 
        [
          "key" => S3_KEY,
          "secret" => S3_SECRET
        ],
        "version" => "latest",
        "region" => S3_REGION
    ));


  }


  public function uploadGZ($fileName,$targetPath,$mime = null){

    if(strpos(strtolower($targetPath),".png") !== false){
      $mime = "image/png";
    }

    if(strpos(strtolower($targetPath),".jpg") !== false){
      $mime = "image/jpeg";
    }
    
    $result = $this->client->putObject(array(
        'Bucket'     => S3_Bucket,
        'Key'        => $targetPath,
        'SourceFile' => $fileName,
        'ContentType' => $mime,
        'ContentEncoding' => "gzip"
    ));

    // We can poll the object until it is accessible
    $this->client->waitUntil('ObjectExists', array(
        'Bucket' => S3_Bucket,
        'Key'    => $targetPath
    ));
    return $result;
  }
  

}

/* End of file htmlpurifier.php */
/* Location: ./application/libraries/htmlpurifier.php */

?>
