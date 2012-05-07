<?php

  class SkyRender {
    
    // the height of a programme div if it is one hour long
    const HEIGHT_FOR_ONE_HOUR=200;
    
    public static function renderProgramme($p) {
      /* e.g.
      Array
      (
          [_id] => MongoId Object
              (
                  [$id] => 4fa77b75ed8899ee030001de
              )

          [eventid] => 54979
          [channelid] => 2076
          [date] => 07/05/12
          [start] => 1336411800000
          [dur] => 3600
          [title] => Who Do You Think You Are?
          [shortDesc] => 1/10. June Brown: Celebrity genealogy series. National treasure June Brown unravels her Jewish heritage, and discovers how momentous historical events shaped her family's destiny. [HD] [AD,S]
          [genre] => 5
          [subgenre] => 6
          [edschoice] => false
          [parentalrating] => Array
              (
                  [k] => 0
                  [v] => --
              )

          [widescreen] => 
          [sound] => Array
              (
                  [k] => 3
                  [v] => Digital surround sound
              )

          [remoteRecordable] => true
          [record] => 1
          [scheduleStatus] => NOT_STARTED
          [blackout] => false
          [movielocator] => null
      )
    */
    
      $html = sprintf("  <div class=\"programme\" style=\"height:%dpx\">\n".
                      "    <div class=\"programme_title\">%s</div>\n".
                      "    <div class=\"programme_body\">%s</div>\n".
                      "  </div>\n",
                      SkyRender::HEIGHT_FOR_ONE_HOUR*$p['dur']/3600,
                      $p['title'],
                      $p['shortDesc']);
      return $html;
    
    }
    
  }

?>