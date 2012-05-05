# SkyPHP

```
 ____  __ _  _  _  ____  _  _  ____ 
/ ___)(  / )( \/ )(  _ \/ )( \(  _ \
\___ \ )  (  )  /  ) __/) __ ( ) __/
(____/(__\_)(__/  (__)  \_)(_/(__)  
```

## Introduction

This project aims to provide a PHP library to allow the extraction of television programme data from the Sky TV platform and to allow remote recording.

## What's what?

The main library code is in the "skyphp.php" file at the top of the repository. Some test files are in the test directory.

```
  cd test
  ./getlistings.php
  
```

should get some data.

## Functions

### getListings

Fetch Sky TV listings e.g.
 
```
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
```

You must supply a list of channel ids.

### getChannelList 

Get a list of channels e.g.

```
{
    "channels": [
        {
            "channelno": "101",
            "epggenre": "12",
            "title": "BBC 1 London",
            "channeltype": "1",
            "channelid": "2002",
            "genre": "3"
        },
        {
            "channelno": "102",
            "epggenre": "12",
            "title": "BBC 2 England",
            "channeltype": "1",
            "channelid": "2006",
            "genre": "3"
        }
        
        
        ]
}
```

### getRemoteRecordUrl

Calculates the URL to visit in your browser to remotely record a programme. (Must be logged into Sky)

### getSignInUrl

Returns the URL to visit to sign in a user to Sky (essential for remote recording).

## Credits

Based on SkyPy (https://github.com/vinczente/skypy)