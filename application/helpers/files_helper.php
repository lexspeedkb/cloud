<?php
function rearrange( $arr ){
    foreach( $arr as $key => $all ){
        foreach( $all as $i => $val ){
            $new[$i][$key] = $val;
        }
    }
    return $new;
}

function getPath ($name) {
    $i=0;
    $array = array();

    while ($i <= 10) {
        $push = substr($name, $i, 2);
        $text .= $push."/";
        array_push($array, $push);
        $i+=2;
    }

    $return['text'] = $text;
    $return['array'] = $array;
    $return['name'] = $name;

    return $return;
}
?>