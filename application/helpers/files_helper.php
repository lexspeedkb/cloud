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
    $kb = $bytes / 1024;
    $mb = $bytes / 1048576;
    $gb = $bytes / 1073741824;

    if ($kb > 1024) {
        if ($mb > 1024) {
            $return['size'] = $gb;
            $return['unit'] = 'GB';
        } else {
            $return['size'] = $mb;
            $return['unit'] = 'MB';
        }
    } else {
        $return['size'] = $kb;
        $return['unit'] = 'KB';
    }

    return $return;
}

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

?>