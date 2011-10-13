<?php

class URLParse {
    private static $_re = '@^(([^:/?#]+):)?(//([^/?#]*))?([^?#]*)(\?([^#]*))?(#(.*))?@i';
    private static $_fieldmap = array(
        'scheme'    => 2,
        'authority' => 4,
        'path'      => 5,
        'query'     => 7,
        'fragment'  => 9
    );
    
    public static function parse_url($url)
    {
        if (preg_match(self::$_re, $url, $matches))
        {
            // map to fields
            $ret = array();
            foreach (self::$_fieldmap as $k => $v)
            {
                $ret[$k] = isset($matches[$v]) ? $matches[$v] : null;
            }
            return $ret;
        }
        else
        {
            return false;
        }
    }
}

// tests
print_r(URLParse::parse_url('http://forrst.com')); echo "\n";
print_r(URLParse::parse_url('http://forrst.com/')); echo "\n";
print_r(URLParse::parse_url('https://forrst.com/foo#bar')); echo "\n";
print_r(URLParse::parse_url('http://forrst.com/this.html?what=that')); echo "\n";
print_r(URLParse::parse_url('http://forrst.com/this.html?foo=that.bar')); echo "\n";
