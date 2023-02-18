<?php
require_once 'config.php';

function sanitize($input)
{
    return htmlentities(htmlspecialchars(strip_tags(trim($input))));
}

function sanitize_body($body)
{
    global $link;
    $body = strip_tags($body, "<h1><h2><h3><a><blockquotes><img><p><i><b><span>");
    $body = mysqli_real_escape_string($link, $body);

    return $body;
}

function ALLOW_SAFE_SYMBOLS($input) {
    return str_replace("'", "&#39;", "$input");
}

function redirect_to($url)
{
    $url = urldecode($url);
    header("Location: $url");
    exit();
}

function capitalize($str) {
    $my_arr = str_split($str);
    return strtoupper($my_arr[0]) . strtolower(join("", array_slice($my_arr, 1)));
}

function sub_word(string $word, int $len = 5):string {
    $words = explode(" ", $word);
    return count($words) > 1 ? implode(" ", array_slice($words, 0, $len)) . "..." : $words[0];
}

function get_image_path(Array $file = null,  &$err)
{
    $err_flag = false;
    if (!is_null($file)) {
        extract($file);
        if ($size > 1022976) {
            $err_flag = true;
            $err[] = "image type not supported!";
        }

        $allowed_ext = ['jpg', 'jpeg',  'gif', 'png'];

        $file_exts = explode('/', $type);

        $image_ext = strtolower(end($file_exts));

        if (!in_array($image_ext, $allowed_ext)) {
            $err_flag = true;
            $errors[] = "image type not found";
        }

        $upload_dir = 'uploads/';
        $image_path = $upload_dir . 'techblog-' . uniqid(time()) . '.' . $image_ext;

        if ($err_flag === false) {
            if (move_uploaded_file($tmp_name, $image_path)) {
                return $image_path;
            }
        }
    }return false;
}

function generateID ($prefix = "id_", $len = 7) {
    for($i = 0; $i < $len; $i++) {
        $prefix .= rand(0, 9);
    }
    return $prefix;
}

function sendEmail($email, $subject, $msg) {
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= 'From: <info@bekofcu.com>' . "\r\n";

    $send = mail("$email", "$subject", "$msg", $headers);
    return $send;
}

function generateNumber($len) {
    return rand(pow(10, $len-1), pow(10, $len)-1);
}

function generateTransactionId($id) {
    return "trx_" . rand(1000000, 9999999999) . "-r$id";
}

// function checkIfIsset($super_global, $submit, $data_from_db {
//     if (isset($super_global[$submit])) {
//         $query_result = $data_from_db();
//         return $query_result;
//     }
// }