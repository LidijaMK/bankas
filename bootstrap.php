<?php
function getMessage()
{
    if (!isset($_SESSION['msg'])) {
        return false;
    }
    $msg = $_SESSION['msg'];
    unset($_SESSION['msg']);
    return $msg;
}

function setMessage(string $msg)
{
    $_SESSION['msg'] = $msg; 
}

function redirect() 
{
    header('Location: http://localhost/bankas/');
    die;
}

function redirectToAction($action, $id = 0) 
{
    if  ($id) {
        header('Location: http://localhost/bankas/?action=' . $action . '&id='. $id);
    }
    else {
        header('Location: http://localhost/bankas/?action=' . $action);
    }
    die;
}

?>
