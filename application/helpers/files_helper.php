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

function getTypeByMIME ($mime) {
    $type = explode('/', $mime);

    // switch ($type[0]) {
    //     case 'text':
    //         return 'text';
    //     case 'image':
    //         return 'image';
    //     case 'video':
    //         return 'video';
    //     case 'application':
    //         return 'document';
    //     default:
    //         return 'document';
    // }

    $ret['primary'] = $type[0];
    $ret['sub']     = $type[1];
    $ret['full']    = $mime;

    return $ret;
}

function bytesConvert ($bytes) {
    number_format($allFilesSize / 1048576, 2); //TODO This f-tion
}
?>