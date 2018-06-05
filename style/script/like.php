<?php

session_start();

if (isset($_POST['like'])) {
    set_include_path('../');
    include_once 'config/database.php';
    include_once 'config/setup.php';
    $id = htmlspecialchars($_POST['like']);
    if (isset($_SESSION['login'])) {
        $login = $_SESSION['login'];
        $req = $bdd->prepare('SELECT id FROM users WHERE login = :login');
        $res = $req->execute(array('login' => $login));
        $res = $req->fetchAll();
        $uid = $res[0]['id'];
        $req = $bdd->prepare("SELECT * FROM likes WHERE uid = :uid AND img_id = :id");
        $res = $req->execute(array('uid' => $uid, "id" => $id));
        $res = $req->fetchAll();
        if (count($res) === 0) {
            $req = $bdd->prepare("INSERT INTO likes(uid, img_id) VALUES (:uid, :id);");
            $res = $req->execute(array("uid" => $uid, "id" => $id));
        }
        else {
            $req = $bdd->prepare("DELETE FROM likes WHERE uid = :uid AND img_id = :id;");
            $res = $req->execute(array("uid" => $uid, "id" => $id));
        }
    }
    $req = $bdd->prepare("SELECT * FROM likes WHERE img_id = :id");
    $res = $req->execute(array('id' => $id));
    $res = $req->fetchAll();
    echo count($res);
}

?>
