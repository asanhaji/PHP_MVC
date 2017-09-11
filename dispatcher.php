<?php

class Dispatcher
{
  const CONTROLLER_NOT_FOUND = "controller_not_found";
  const METHOD_NOT_FOUND = "method_not_found";
  const ARGUMENT_NOT_FOUND = "argument_not_found";

  public static function returnLoadError($err_type)
  {
    $ret_arr = [];
    array_push($ret_arr, "IndexController");
    array_push($ret_arr, "loadError");
    array_push($ret_arr, $err_type);
    return $ret_arr;
  }

  public static function getController($url)
  {
    $ret_arr = [];
    $controller;
    $method;
    $argument;
    $matches = false;
    $url = trim($url, "/");
    $url = explode("/", $url);
    array_shift($url);
    $url = array_map('strtolower', $url);

    if (!count($url) || preg_match('/^index\.(html?|php)$/', $url[0])) {
      array_push($ret_arr, "IndexController");
      array_push($ret_arr, "loadDefaultHomepage");
      return $ret_arr;
    }
    foreach (ROUTES as $key => $value) {
      if ($key == $url[0]) {
        if (!isset($url[1])) {
          if(isset($value['none']['controller'])) {
            array_push($ret_arr, $value['none']['controller']);
            array_push($ret_arr, $value['none']['method']);
          }
          else return self::returnLoadError(self::METHOD_NOT_FOUND);
          return $ret_arr;
        }
        foreach ($value as $rkey => $route) {
          if ($url[1] == $rkey) {
            array_push($ret_arr, $value[$rkey]['controller']);
            array_push($ret_arr, $value[$rkey]['method']);
            if ($value[$rkey]['need_args']) {
              if (isset($url[2])) {
                array_push($ret_arr, $url[2]);
              }
               else {
                return self::returnLoadError(self::ARGUMENT_NOT_FOUND);
              }
            }
            return $ret_arr;
          }
        }
        return self::returnLoadError(self::METHOD_NOT_FOUND);
      }
    }
    return self::returnLoadError(self::CONTROLLER_NOT_FOUND);
  }
}
