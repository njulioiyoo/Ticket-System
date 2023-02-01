<?php
function parse_url_query_string() {
    $str = parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY);
    parse_str($str, $output);
    return $output;
}