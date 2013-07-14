<?php
    //$xml=simplexml_load_file("http://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20cricket.scorecard.live.summary&diagnostics=true&env=store%3A%2F%2Fg2O6Dgedx7hVI5PwMkV1oE");
    //$xml = simplexml_load_file("http://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20flickr.photos.recent%20where%20api_key%3D%200da0552a1d6a84617eb45802eb0769b2%20&diagnostics=true");
    $xml = simplexml_load_file("http://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20flickr.photos.search%20where%20has_geo%3D%22true%22%20and%20text%3D%22san%20francisco%22%20and%20api_key%3D0da0552a1d6a84617eb45802eb0769b2%20&diagnostics=true&env=store%3A%2F%2Fg2O6Dgedx7hVI5PwMkV1oE");
    $loc_based_pics = simplexml_load_file("http://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20flickr.places%20where%20lat%3D%2222.000%22%20and%20api_key%3D0da0552a1d6a84617eb45802eb0769b2%22%20and%20lon%3D%2277.000%22&diagnostics=true");
    // echo $xml->results->Scorecard->mid;
    // echo $xml->results->Scorecard->series->series_name;
    $allPhotos = $loc_based_pics->results->photo;
    echo $allPhotos;
    $html="";
    if (count($allPhotos) > 0){
        foreach ($allPhotos as $photo){
        $html .= '<a href="http://www.flickr.com/photos/'.
        $photo['owner'].'/'.$photo['id'].
        '"><img src="http://farm'.$photo['farm'].
        '.static.flickr.com/'.$photo['server'].
        '/'.$photo['id'].'_'.$photo['secret'].
        '.jpg" alt="'.$photo['title'].
        '" /></a>';
        }
        } else {
        $html .= 'No Photos Found';
        }

        echo $html;
    /*
    foreach($photo in $allphotos){
      $farmid = $photo->id;
      echo $farmid;
    }
    */
    //"http://farm{farm-id}.staticflickr.com/{server-id}/{id}_{secret}_mstzb.jpg"
    //"http://farm{farm-id}.staticflickr.com/{server-id}/{id}_{secret}_mstzb.jpg"

?>