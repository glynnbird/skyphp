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
    const LISTINGS_URL = "http://epgservices.sky.com/tvlistings-proxy/TVListingsProxy/tvlistings.json";
    
    // the url where Sky Channel lists come from
    const CHANNEL_LIST_URL = "http://epgservices.sky.com/tvlistings-proxy/TVListingsProxy/init.json";
    
    // the url where sky users sign in
    const SIGN_IN_URL = "https://skyid.sky.com/signin/";
    
    // the remote record url
    const REMOTE_RECORD_URL = "http://epgservices.sky.com/tvlistings-proxy/TVListingsProxy/remoteRecord.json?channelId=%d&eventId=%d&siteId=1";
    
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
      $url = SkyPHP::LISTINGS_URL;
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
    
    /**
     * Get full list of Sky Channels
     * @return
     *          channel list as a JSON string
     */
    public static function getChannelList() {
     
      // fetch channel list
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, SkyPHP::CHANNEL_LIST_URL);
      curl_setopt($ch, CURLOPT_TIMEOUT, 30);
      curl_setopt($ch, CURLOPT_POST, false);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch,CURLOPT_ENCODING , "gzip");
      $output = curl_exec($ch);
      curl_close($ch);
      return $output;
    }
    
    /**
     * Calculate the url to remote-record a programme
     * @param channelid
     *          the id of the channel to record
     * @param eventid
     *          the id of the event to record
     * @return
     *          channel list as a JSON string
     */
    public static function getRemoteRecordUrl($channelid,$eventid) {
      // calculate the url
      return sprintf(SkyPHP::REMOTE_RECORD_URL,
                      $channelid,
                      $eventid);
    }
    
    /**
     * Get the url where users sign in the Sky platform
     * @return
     *          sign-in url
     */
    public static function getSignInUrl() {
      return SkyPHP::SIGN_IN_URL;
    }
    
  }


?>