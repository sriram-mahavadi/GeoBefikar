<div class="pure-g-r">
<?php
$xml = simplexml_load_file("https://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20foursquare.venues.search%20where%20oauth_token%3D30EDOPJVE4VYDF0UDKZZ550X5Z5QCKD4UHEKKIU4ZQCAAGXT%20%20and%20ll%3D'17.3667%2C78.4667'&env=store%3A%2F%2Fdatatables.org%2Falltableswithkeys");
$groupItems = $xml->results->json->response->groups->items;
foreach($groupItems as $item){
    $itemName = $item->name;
    $itemLocation = $item->location->address . ", " . $item->location->crossStreet;
    $itemCategory = $item->categories->name;
    $itemParent = $item->categories->parents;
    $itemIcon = $item->categories->icon;
?>
<div class="pure-u-1-3">
<?php
    $html="";
    $html .= "<img src=$itemIcon /><br>Item Name:$itemName<br>Item Location:$itemLocation<br>Item Category:$itemCategory<br>Item Parent:$itemParent</div>";
    echo $html;
}
?>
</div>