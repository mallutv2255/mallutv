<?php

error_reporting(0);

header("Content-Type: application/vnd.apple.mpegurl");

$id = $_GET['id'];

$data = json_decode(file_get_contents("redbox_channels.json"), true);



foreach($data["channels_list"] as $keys => $values) {

	foreach ($values["stream_list"] as $stream) {

	    if ($stream["stream_id"] == $id) {

	        $blink = $stream["stream_url"];



$burl = str_replace("playlist.m3u8", "", $blink);

}}}

$opts = array(

  'http'=>array(

    'method'=>"GET",

    'header'=>"User-Agent: Dalvik/2.1.0 (Linux; U; Android 8.1.0; vivo 1724 Build/OPM1.171019.011)\r\n" .

              "authorization: Basic QDA3NzEyMSM6QDA3NzEyMSM=\r\n"

  )

);



$context = stream_context_create($opts);

$basetoken = file_get_contents('http://135.181.2.111:8800/cip/4c.rbt/', false, $context);

$token = file_get_contents(base64_decode("aHR0cHM6Ly9pbmRzdHJlYW0ueHl6L3JlZGJveGFwaS5waHA=").$basetoken);



$link = $blink.$token;

$e = file_get_contents($link);

preg_match("/(?=chunks.m3u8).*/", $e, $m);

$f = file_get_contents($burl.$m[0]);

$g = preg_replace("/l_/", "stream.php?stream=".$burl."l_", str_replace(".ts?", ".ts&", $f));

if(strpos($g, "EXTM3U") !== false) {

echo $g;


} else {

$relink = "redbox.php?id=".$id."&e=.m3u8";

header("Location: ".$relink);


}
?>