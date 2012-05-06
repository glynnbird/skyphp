<?php

  class SkyMongo {
    
    const MONGO_SERVER = "localhost";
    
    static public function connect() {
      global $db,$programmes,$channels;
      
      $conn = new Mongo(SkyMongo::MONGO_SERVER);
      $db = $conn->epg;
      $programmes = $db->programmes;
      $channels = $db->programmes;
    }
  }
  
  SkyMongo::connect();

?>