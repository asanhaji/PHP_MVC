<?php

class FormValidator
{
    
    public static function login_form($POST)
    {
        $error_str = "";
        if ((isset($_POST['email']) && $_POST['email'] != "")
        && (isset($_POST['password']) && $_POST['password'] != "")) {
            $pattern = '/^(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){255,})(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){65,}@)(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22))(?:\\.(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-+[a-z0-9]+)*\\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-+[a-z0-9]+)*)|(?:\\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\\]))$/iD';
            if (!preg_match($pattern, $_POST['email'])) {
                $error_str .=  'Invalid email <br />';
            }
            if (strlen($_POST['password']) < 3
                ||  strlen($_POST['password']) > 10) {
                $error_str .=  'Invalid password <br />';
            }
            if (strlen($error_str)) {
                $error_str = substr($error_str, 0, -6);
            }
        } else {
            $error_str =  'Invalid form, all fields are required';
        }
        return $error_str;
    }
    public static function register_add_form($POST)
    {
        $error_str = "";
        if ((isset($_POST['username']) && $_POST['username'] != "")
        && (isset($_POST['email']) && $_POST['email'] != "")
        && (isset($_POST['password']) && $_POST['password'] != "")
        && (isset($_POST['password_confirmation'])
        && $_POST['password_confirmation'] != "")) {
            $pattern = '/^(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){255,})(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){65,}@)(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22))(?:\\.(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-+[a-z0-9]+)*\\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-+[a-z0-9]+)*)|(?:\\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\\]))$/iD';
            if (strlen($_POST['username']) < 3) {
                $error_str .= 'Invalid username, username is incomplete <br />';
            } elseif (strlen($_POST['username']) > 10) {
                $error_str .= 'Invalid username, username is too long <br />';
            }
            if (!preg_match($pattern, $_POST['email'])) {
                $error_str .=  'Invalid email <br />';
            }
            if ($_POST['password'] != $_POST['password_confirmation'] || strlen($_POST['password']) < 3
                ||  strlen($_POST['password']) > 10) {
                $error_str .=  'Invalid password or password confirmation <br />';
            }
            if (strlen($error_str)) {
                $error_str = substr($error_str, 0, -6);
            }
        } else {
            $error_str =  'Invalid form, all fields are required';
        }
        return $error_str;
    }
    public static function register_form($POST)
    {
        $error_str = "";
        if ((isset($_POST['username']) && $_POST['username'] != "")
        && (isset($_POST['email']) && $_POST['email'] != "")
        && (isset($_POST['password']) && $_POST['password'] != "")
        && (isset($_POST['password_confirmation'])
        && $_POST['password_confirmation'] != "")) {
            $pattern = '/^(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){255,})(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){65,}@)(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22))(?:\\.(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-+[a-z0-9]+)*\\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-+[a-z0-9]+)*)|(?:\\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\\]))$/iD';
            if (strlen($_POST['username']) < 3) {
                $error_str .= 'Invalid username, username is incomplete <br />';
            } elseif (strlen($_POST['username']) > 10) {
                $error_str .= 'Invalid username, username is too long <br />';
            }
            if (!preg_match($pattern, $_POST['email'])) {
                $error_str .=  'Invalid email <br />';
            }
            if ($_POST['password'] != $_POST['password_confirmation'] || strlen($_POST['password']) < 3
                ||  strlen($_POST['password']) > 10) {
                $error_str .=  'Invalid password or password confirmation <br />';
            }
            if (strlen($error_str)) {
                $error_str = substr($error_str, 0, -6);
            }
        } else {
            $error_str =  'Invalid form, all fields are required';
        }
        return $error_str;
    }
    public static function user_edit_form($POST)
    {
        $error_str = "";
        if ((isset($_POST['username']) && $_POST['username'] != "")
        && (isset($_POST['email']) && $_POST['email'] != "")) {
            $pattern = '/^(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){255,})(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){65,}@)(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22))(?:\\.(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-+[a-z0-9]+)*\\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-+[a-z0-9]+)*)|(?:\\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\\]))$/iD';
            if (strlen($_POST['username']) < 3) {
                $error_str .= 'Invalid username, username is incomplete <br />';
            } elseif (strlen($_POST['username']) > 10) {
                $error_str .= 'Invalid username, username is too long <br />';
            }
            if (!preg_match($pattern, $_POST['email'])) {
                $error_str .=  'Invalid email <br />';
            }
            if ($_POST['password'] != "" || $_POST['password_confirmation'] != "") {
                if ($_POST['password'] != $_POST['password_confirmation'] || strlen($_POST['password']) < 3
                ||  strlen($_POST['password']) > 10) {
                    $error_str .=  'Invalid password or password confirmation <br />';
                }
            }
            if (strlen($error_str)) {
                $error_str = substr($error_str, 0, -6);
            }
        } else {
            $error_str =  'Invalid form, all fields are required';
        }
        return $error_str;
    }
    public static function product_edit_form($POST)
    {
        $error_str = "";
        if ((isset($_POST['name']) && $_POST['name'] != "")
        && (isset($_POST['price']))) {
            if (strlen($_POST['name']) < 3) {
                $error_str .= 'Invalid product name, name is incomplete <br />';
            } elseif (strlen($_POST['name']) > 20) {
                $error_str .= 'Invalid product name, name is too long <br />';
            }
            if ($_POST['categories'] == '0') {
                $error_str .=  'Invalid category selection <br />';
            }
            if (strlen($error_str)) {
                $error_str = substr($error_str, 0, -6);
            }
        } else {
            $error_str =  'Invalid form, all fields are required';
        }
        return $error_str;
    }
}
