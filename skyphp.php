<?php

  /**
  * @skyphp.php
  *       A library of utility functions to allow Sky EPG data to be used from PHP applications
  */
  
  /**
  * Definition of the SkyPHP class
  */
  class SkyPHP {
    
    // the url where Sky EPG listings come from
    const listingsURL = "http://epgservices.sky.com/tvlistings-proxy/TVListingsProxy/tvlistings.json";
    
    // some channel ids
    const BBC1_NE = 2155;
    const BBC1_HD = 2076;
    const BBC2 = 2006;
    const BBC3 = 2061;
    const BBC4 = 2018;
    const ITV1 = 6390;
    const ITV1_HD = 6505;
    const ITV2_HD = 6452;
    const ITV3_HD = 6533;
    const ITV4_HD = 6534;
    const CHANNEL4 = 1624;
    const CHANNEL4_HD = 4075;
    const CHANNEL5 = 1829;
    const CHANNEL5_HD = 4058;
    const SKY1_HD = 4061;
    const SKY_ATLANTIC_HD = 4053;
    const FX_HD = 4023;
    const FILM4 = 1627;
    
    /**
     * Get listings from the Sky EPG service  
     * @param channelFilter
     *          List of channel ids for filtering.
     * @param duration
     *          Duration in minutes, default 1 day
     * @param time
     *          Start time for the data. Default Current minute. Format - %Y%m%d%H%M, default now
     * @param detail
     *          Level of details required. 2 retrieves short desc. 1 basic data. Not sure about all possible values.
     * @return
     *          Listings details as JSON string
     */
    /*  
      {
          "channels": {
              "title": "Sky Comedy",
              "channeltype": "1",
              "channelid": "1002",
              "genre": "6",
              "program": {
                  "eventid": "492",
                  "channelid": "1002",
                  "date": "05/05/12",
                  "start": "1336205400000",
                  "dur": "6600",
                  "title": "The Back-Up Plan",
                  "shortDesc": "Single and longing for a baby, Jennifer Lopez resorts to artificial insemination. Minutes later she meets her dream man, but how will he react to her secret? Romcom fun. (2010)(100 mins) Also in HD",
                  "genre": "6",
                  "subgenre": "4",
                  "edschoice": "false",
                  "parentalrating": {
                      "k": "3",
                      "v": "12"
                  },
                  "widescreen": "",
                  "sound": {
                      "k": "3",
                      "v": "Digital surround sound"
                  },
                  "remoteRecordable": "false",
                  "record": "1",
                  "scheduleStatus": "PLAYING_NOW",
                  "blackout": "false",
                  "movielocator": "null"
              }
          }
      }
    */
    public static function getListings($channelFilter="", $duration="", $time="", $detail="") {
      
      // defaults
      if(!$channelFilter) {
        $channelFilter = "";
      }
      if(!$duration) {
        $duration=24*60;
      }
      if(!$time) {
        $time = date("YmdHi");
      }
      if(!$detail) {
        $detail=2;
      }
      
      // construct the url
      $url = SkyPHP::listingsURL;
      $params = "";
      if($channelFilter) {
        $params = "channels=".urlencode($channelFilter);
      }
      if($duration) {
        $params .= ($params)?"&":"";
        $params .= "dur=".urlencode($duration);
      }
      if($time) {
        $params .= ($params)?"&":"";
        $params .= "time=".urlencode($time);
      }
      if($detail) {
        $params .= ($params)?"&":"";
        $params .= "detail=".urlencode($detail);
      }
      if($params){
        $url .= "?".$params;
      }

      // fetch the data using curl with a 30s timeout
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_TIMEOUT, 30);
      curl_setopt($ch, CURLOPT_POST, false);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch,CURLOPT_ENCODING , "gzip");
      $output = curl_exec($ch);
      curl_close($ch);
			return $output;

    }
    
  }


?>