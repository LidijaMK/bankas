<?php
$users = [
    ['name' => 'Inga', 'passw' => md5(1234)],
    ['name' => 'Antanas', 'passw' => md5(1234)],
    ['name' => 'Gitanas', 'passw' => md5(1234)]
];
file_put_contents(__DIR__. '/users.json', json_encode($users));