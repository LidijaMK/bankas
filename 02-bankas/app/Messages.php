<?php
namespace Bank;

class Messages {
   
    public static function getMessage()
    {
        if (!isset($_SESSION['msg'])) {
            return false;
        }
        $msg = $_SESSION['msg'];
        unset($_SESSION['msg']);

        if (isset($_SESSION['old'])) {
            $old = $_SESSION['old'];
            unset($_SESSION['old']);
        }
        return [$msg, $old ?? ''];
    }

    public static function setMessage(string $msg, string $type)
    {
        $_SESSION['msg'] = "<div class=\"alert alert-$type\" role=\"alert\">$msg</div>"; 
    }

    public static function setOld(string $name, string $value)
    {
        $_SESSION['old'][$name] = $value; 
    }
}