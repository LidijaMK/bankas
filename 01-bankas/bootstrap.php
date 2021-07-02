<?php
session_start();
function getMessage()
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
    return [$msg, $old];
}

function setMessage(string $msg, string $type)
{
    $_SESSION['msg'] = "<div class=\"alert alert-$type\" role=\"alert\">$msg</div>"; 
}

function setOld(string $name, string $value)
{
    $_SESSION['old'][$name] = $value; 
}



function redirect() 
{
    header('Location: http://localhost/bankas/01-bankas/');
    die;
}

function redirectToAction($action, $id = 0) 
{
    if  ($id) {
        header('Location: http://localhost/bankas/01-bankas/?action=' . $action . '&id='. $id);
    }
    else {
        header('Location: http://localhost/bankas/01-bankas/?action=' . $action);
    }
    die;
}
?>