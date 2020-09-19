<?php
include "upload.php";
///////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////// demarage des sessions/////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////
session_start();
///////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////// creation compte client////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////

function add_login($lastname, $firstname, $adress, $login, $pass_hash, $cle)
{
global $connection;
$sqlInsert = "INSERT INTO users (lastname,firstname,mail,login,passe,lvl,cle,active)
            VALUES (:lastname, :firstname, :mail,:login,:passe,:lvl,:cle,:active)";
$sql = $connection->prepare($sqlInsert);
$sql->execute(array(
        ':lastname' => $lastname,
        ':firstname' => $firstname,
        ':mail' => $adress,
        ':login' => $login,
        ':passe' => $pass_hash,
        ':lvl' => 5,
        ':cle' => $cle,
        ':active' => 0

    ));
}

function list_cle($login)
{
global $connection;
$sql = "SELECT cle, active FROM users
        WHERE login like :login ";
$sth = $connection->prepare($sql);
if ($sth->execute(array(':login' => $login)) && $row = $sth->fetch()) {
    $cle = $row['cle'];
    $active = $row['active'];
}

}


function valid($login)
{
global $connection;
$sql = "UPDATE users 
SET active = 1
WHERE login like :login ";
$sth = $connection->prepare($sql);
$sth->bindParam(':login', $login);
$sth->execute();
}

////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////fonction login////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////

function decrypt($passe)
{
$pass_hash = password_hash($passe, PASSWORD_DEFAULT);
return $pass_hash;
}

function doublon_user($login)
{
global $connection;
$sql = "SELECT * FROM users WHERE login = '$login'";
$sth = $connection->prepare($sql);
$sth->execute();
@$resultat = $sth->fetch(PDO::FETCH_OBJ);
return @$resultat;
}

////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////modif compte client////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////

function modif_login($id_user, $lastname, $firstname, $mail, $login, $passe)
{
global $connection;
$sql = "UPDATE users 
SET  lastname='$lastname',firstname='$firstname',mail='$mail',login='$login',passe='$passe'
where id_user=$id_user";
$sth = $connection->prepare($sql);
$sth->execute();
echo "vos données on ete modifié";
}

//////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////list user////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////

function user_uni()
{
global $connection;
$id_user =  $_SESSION["id_user"];
$sql = "SELECT * FROM users WHERE id_user = $id_user";
$sth = $connection->prepare($sql);
$sth->execute();
$resultat = $sth->fetch(PDO::FETCH_OBJ);
return $resultat;
}

///////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////// connexion admin moderateur client/////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////
function verif_login($login, $passe)
{
global  $connection;
$sql = "SELECT * FROM users WHERE login='$login'";
$sth = $connection->prepare($sql);
$sth->execute();
$resultat = $sth->fetch(PDO::FETCH_OBJ);

    if (@$login == @$resultat->login) {
      if (password_verify($passe, $resultat->passe)) {
// redirection sur les pages 
            if ($resultat->lvl == "1") 
            {
            $_SESSION["id_user"] = $resultat->id_user;
            $_SESSION["lvl"] = $resultat->lvl;
            $_SESSION["lastname"] = $resultat->lastname;
            $_SESSION["firstname"] = $resultat->firstname;
            header('Location: admin.php?login');
            exit();
            }
             elseif ($resultat->lvl == "2") {
                $_SESSION["id_user"] = $resultat->id_user;
                $_SESSION["lvl"] = $resultat->lvl;
                $_SESSION["lastname"] = $resultat->lastname;
                $_SESSION["firstname"] = $resultat->firstname;
                header('Location: admin_blog.php?login');
                exit();
            } elseif ($resultat->lvl == "5") 
            {
                $_SESSION["id_user"] = $resultat->id_user;
                $_SESSION["lvl"] = $resultat->lvl;
                $_SESSION["lastname"] = $resultat->lastname;
                $_SESSION["firstname"] = $resultat->firstname;
                header('Location: index.php?login');
                exit();
            }
        } 
        else 
        {
        header('Location: index.php?message=true');
        exit();
        }

    } else 
    {
    header('Location: index.php?message=true');
    exit();
    }
}

function update_password($id_user, $passwordverif, $newpassword)
{
global  $connection;
$crypt_pass = decrypt($newpassword);
//$passwordverif= addslashes($passwordverif);
$sql = "SELECT password FROM users 
WHERE id_user='$id_user'";
$sth = $connection->prepare($sql);
$sth->execute();
$resultat = $sth->fetch(PDO::FETCH_OBJ);
  if (password_verify($passwordverif, $resultat->password)) {
    $sql =  "UPDATE users
    SET password = '$crypt_pass'
    WHERE id_user=$id_user";
    $sth = $connection->prepare($sql);
    $sth->execute();
    }
    else 
    {
    echo ("mot de passe incorrect");
    }
}
/////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////// insert video son image/////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////

function insert_link($title_link, $id_cat, $link)
{
// recup de la connection
global $connection;
// insert dans la table articles
$sql_ins = "INSERT INTO links(title_link,id_cat,link) VALUES (:title_link,:id_cat,:link)";
 $sth = $connection->prepare($sql_ins);
    $sth->execute(array(
        ':title_link' => $title_link,
        ':id_cat' => $id_cat,
        ':link' => $link
     ));
    // recuperation de id_article
    $id_link = $connection->lastInsertId();
    $id_user = $_SESSION["id_user"];
    // appel la function pour passer les id
    insert_liaison($id_link, $id_user, $id_cat);
}

/*** recuperation des id*/
function insert_liaison($id_link, $id_user, $id_cat)
{
// recup de la connection
global $connection;
$sql_ins = "INSERT INTO liaisons(id_link,id_user,id_cat) VALUES (:id_link, :id_user,:id_cat)";
$sth = $connection->prepare($sql_ins);
$sth->execute(array(
    ':id_link' => $id_link,
    ':id_user' => $id_user,
    ':id_cat' => $id_cat
      ));
}
/*** liste des categories*///
function list_cat()
{
global $connection;
$sql = "SELECT * FROM categories";
$sth = $connection->prepare($sql);
$sth->execute();
$resultat = $sth->fetchAll(PDO::FETCH_OBJ);
return $resultat;
}

/*** recuperation des articles sur la base liaisons*/

function links()
{
global $connection;
$sql = "SELECT * FROM liaisons
INNER JOIN users ON users.id_user = liaisons.id_user
INNER JOIN links ON links.id_link= liaisons.id_link
INNER JOIN categories ON categories.id_cat = liaisons.id_cat
WHERE links.active=1  ORDER BY categories.id_cat ASC";
$sth = $connection->prepare($sql);
$sth->execute();
$resultat = $sth->fetchALL(PDO::FETCH_OBJ);
return $resultat;
}

function list_title()
{
global $connection;
// req ordonnée pas titre_article
$sql = "SELECT id_link, title_link FROM links
WHERE active=1
ORDER BY title_link ASC";
$sth = $connection->prepare($sql);
$sth->execute();
$resultat = $sth->fetchAll(PDO::FETCH_OBJ);
return $resultat;
}

function link_unique($id_link)
{
global $connection;
// recupere un article par id_article
$sql = "SELECT * FROM liaisons
INNER JOIN links on links.id_link = liaisons.id_link
INNER JOIN categories on categories.id_cat = liaisons.id_cat
INNER JOIN users on users.id_user = liaisons.id_user
WHERE liaisons.id_link= $id_link";
    //NE PAS OUBLIER QUAND BUG DE RAJOUTER UN INNER EX(user bug sur le nom et prenom dans article.php)
     $sth = $connection->prepare($sql);
     $sth->execute();
     $resultat = $sth->fetch(PDO::FETCH_OBJ);
    return $resultat;
}
// fonction modif article et liaison
function modif_link($id_link, $title_link, $id_cat, $link)
{
//modif article
global $connection;
$sql = "UPDATE links
SET title_link ='$title_link',id_cat='$id_cat',link='$link'
WHERE id_link= $id_link";
    $sth = $connection->prepare($sql);
    $sth->execute();

    $sql = "UPDATE liaisons
SET id_cat ='$id_cat'
WHERE id_link= $id_link";
    $sth = $connection->prepare($sql);
    $sth->execute();
}


function delete_link($id_link)
{
global $connection;
$sql = "UPDATE links
SET active = 0
WHERE id_link= $id_link";
$sth = $connection->prepare($sql);
$sth->execute();
header("location:admin.php");
}

/////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////mdp oublie/////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////

function passe_oublie($mail)
{
global $connection;
$sql = "SELECT *FROM users
         WHERE mail = $mail";
$sth = $connection->prepare($sql);
$sth->execute(array(
        ':mail' => $mail
));
$resultat = $sth->fetch(PDO::FETCH_OBJ);
return @$resultat->mail;
}

function recup_id($mail)
{
global $connection;
$sql = "SELECT * FROM users
WHERE mail='$mail'";
$sth = $connection->prepare($sql);
$sth->execute();
$resultat = $sth->fetch(PDO::FETCH_OBJ);
return @$resultat->mail;
}

function verification_id()
{
global $connection;
$sql = "SELECT * FROM users";
$sth = $connection->prepare($sql);
$sth->execute();
$resultat = $sth->fetchALL(PDO::FETCH_OBJ);
return $resultat;
// var_dump($resultat);

}

function modifier_motdepasse($id_user, $passe)
{
$cryptage =  decrypt($passe, PASSWORD_DEFAULT);
global $connection;
$sql = "UPDATE users
SET passe = '$cryptage'
WHERE id_user = $id_user";
$sth = $connection->prepare($sql);
$sth->execute();
var_dump($passe);
}
