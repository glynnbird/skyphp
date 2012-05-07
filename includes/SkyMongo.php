<?php

  class SkyMongo {
    
    const MONGO_SERVER = "localhost";
    
    // connect to mongo server and set up collections
    static public function connect() {
      global $db,$programmes,$channels;
      
      $conn = new Mongo(SkyMongo::MONGO_SERVER);
      $db = $conn->epg;
      $programmes = $db->programmes;
      $channels = $db->channels;
      
      // setup indexes
      $programmes->ensureIndex(array("eventid"=>1) , array("unique" => true));
      $channels->ensureIndex(array("channelid"=>1) , array("unique" => true));
    }

  }
  
  SkyMongo::connect();

?>