<?php

// demmarage des sessions
session_start();

//  Recuperation des post et de la session $id_blog

function insert_blog($title_blog, $display, $blog, $id_blog_cat, $view, $tags, $img, $id_user)
{

    // recup de la connection
    global $connection;
    // insert dans la table articles
    $sql = "INSERT INTO blogs(title_blog,display,blog,id_blog_cat,view,tags,id_user) VALUES (:title_blog,:display,:blog,:id_blog_cat,:view,:tags,:id_user)";

    $sth = $connection->prepare($sql);
    $sth->execute(array(
        ':title_blog' => $title_blog,
        ':display' => $display,
        ':blog' => $blog,
        ':id_blog_cat' => $id_blog_cat,
        ':view' => $view,
        ':tags' => $tags,
        ':id_user' => $id_user

    ));

    // recuperation de id_article
    $id_blog = $connection->lastInsertId();

    $id_user = $_SESSION["id_user"];
    // appel la function pour passer les id

    //recuperation du fichier img
    $filename = img_load($id_blog);


    $sql = "UPDATE blogs
 SET img = '$filename'
 WHERE id_blog= $id_blog";
    $sth = $connection->prepare($sql);
    $sth->execute();
}



function recup_blog()
{
    global $connection;



    global $connection;
    $sql = "SELECT * FROM blogs
    WHERE active=1";
    $sth = $connection->prepare($sql);
    $sth->execute();

    $resultat = $sth->fetchAll(PDO::FETCH_OBJ);

    return $resultat;
}


function insert_blog_cat($name_blog_cat)
{
    global $connection;
    $sql = "INSERT INTO blog_cat(name_blog_cat) VALUES (:name_blog_cat)";

    $sth = $connection->prepare($sql);
    $sth->execute(array(
        ':name_blog_cat' => $name_blog_cat


    ));
    header("Location: blog_categorie.php");
}



function modif_blog_cat($name_blog_cat)
{
    global $connection;
    $sql = "UPDATE blog_cat
SET name_blog_cat ='$name_blog_cat'";
    $sth = $connection->prepare($sql);
    $sth->execute();
}

function delete_blog_cat($id_blog_cat)
{

    global $connection;

    $sql = "UPDATE blog_cat
SET active = 0
WHERE id_blog_cat= $id_blog_cat";
    $sth = $connection->prepare($sql);
    $sth->execute();
    header("location:blog_categorie.php");
}

function list_cat()
{
    global $connection;
    $sql = "SELECT * FROM blog_cat";
    $sth = $connection->prepare($sql);
    $sth->execute();

    $resultat = $sth->fetchAll(PDO::FETCH_OBJ);

    return $resultat;
}

function list_title()
{
    global $connection;
    // req ordonnée pas titre_article
    $sql = "SELECT id_blog, title_blog FROM blogs
WHERE active=1
ORDER BY title_blog ASC";
    $sth = $connection->prepare($sql);
    $sth->execute();

    $resultat = $sth->fetchAll(PDO::FETCH_OBJ);

    return $resultat;
}

function blog_unique($id_blog)
{

    global $connection;
    // recupere un article par id_article

    $sql = "SELECT * FROM blogs
INNER JOIN blog_cat on blogs.id_blog_cat = blog_cat.id_blog_cat
INNER JOIN users on blogs.id_user = users.id_user
WHERE blogs.id_blog= $id_blog";

    // echo $sql;


    //NE PAS OUBLIER QUAND BUG DE RAJOUTER UN INNER EX(user bug sur le nom et prenom dans article.php)

    $sth = $connection->prepare($sql);

    $sth->execute();

    $resultat = $sth->fetch(PDO::FETCH_OBJ);

    return $resultat;
}


// fonction modif article et liaison

function modif_blog($id_blog, $title_blog, $display, $blog, $id_blog_cat, $view, $tags)
{




    //modif article
    global $connection;
    $sql = "UPDATE blogs
SET title_blog='$title_blog', display='$display', blog ='$blog', id_blog_cat='$id_blog_cat',  view='$view' ,  tags='$tags'
WHERE id_blog= $id_blog";
    $sth = $connection->prepare($sql);
    $sth->execute();

    //modif liaison


    //recuperation du nom de l image



    //supprimer automatiquement un fichier deja present


    $sql = "SELECT * FROM blogs
WHERE id_blog=$id_blog";
    $sth = $connection->prepare($sql);
    $sth->execute();
    $resultat = $sth->fetch(PDO::FETCH_OBJ);



    //lorsqu on veut en modifiant que l image ne s efface pas
    if ($_FILES["image"]["name"] != "") {

        //detruire image si differente de la nouvelle image uploadé
        if (isset($resultat->img)) {
            if ($resultat->img != $_FILES["image"]["name"]) {
                @unlink("upload/" . $resultat->img);
            }
        }
    }
    //probleme si on ne met aucun fichier la photo sefface


    $filename = img_load($id_blog);


    //update pour le nom de l'image
    if (isset($filename)) {


        $sql = "UPDATE blogs
SET img = '$filename'
WHERE id_blog= $id_blog";
        $sth = $connection->prepare($sql);
        $sth->execute();

        //supprimer article
    }
}
function delete_blog($id_blog)
{

    global $connection;

    $sql = "UPDATE blogs
SET active = 0
WHERE id_blog= $id_blog";
    $sth = $connection->prepare($sql);
    $sth->execute();
    header("location:admin.php");
}

function select_display()
{
    global $connection;

    // $sql = "SELECT * FROM liaisons, articles, categories, users
    // WHERE users.id_user = liaisons.id_user AND articles.id_article = liaisons.id_article AND categories.id_categorie = liaisons.id_categorie";

    $sql = "SELECT * FROM blog_liaisons
INNER JOIN users ON users.id_user = blog_liaisons.id_user
INNER JOIN blogs ON blogs.id_blog = blog_liaisons.id_blog
INNER JOIN blog_cat ON blog_cat.id_blog_cat = blog_liaisons.id_blog_cat
WHERE blogs.active=1";
    $sth = $connection->prepare($sql);
    $sth->execute();

    $resultat = $sth->fetchAll(PDO::FETCH_OBJ);
    return $resultat;
}


function insert_view($id_blog, $view)
{

    global $connection;


    @$lastname = $_SESSION["lastname"];
    @$firstname = $_SESSION["firstname"];

    $sql_ins = "INSERT INTO views(id_blog, view, author) VALUES (:id_blog,:view,:author)";

    $sth = $connection->prepare($sql_ins);
    $sth->execute(array(
        ':id_blog' => $id_blog,
        ':view' => $view,
        ':author' => "$lastname $firstname"


    ));
}
function list_view($id_blog)
{

    global $connection;
    $sql = " SELECT * FROM views
WHERE id_blog=$id_blog AND valid=1
ORDER BY date_crea DESC";
    $sth = $connection->prepare($sql);
    $sth->execute();
    $resultat = $sth->fetchAll(PDO::FETCH_OBJ);
    return $resultat;
}


// fonction date qui mermet de recuperer le timelaps de phpmyadmin et de le convertir en version francaise
function frdate($date1)
{
    setlocale(LC_TIME, "fr_FR.UTF-8");
    $date2  = strftime("%A %d %b %Y", strtotime($date1));
    return $date2;
}


//detruire image si differente de la nouvelle image uploadée



function list_view_complet()
{
    global $connection;

    $sql = "SELECT *,views.view AS view FROM views
INNER JOIN blogs ON blogs.id_blog =blogs.id_blog
WHERE valid =0
ORDER BY date_crea DESC";
    $sth = $connection->prepare($sql);
    $sth->execute();

    $resultat = $sth->fetchAll(PDO::FETCH_OBJ);
    return $resultat;
}

function valid_view($id_view)
{
    global $connection;

    $sql = "UPDATE views 
SET valid = 1
WHERE id_view= $id_view";
    $sth = $connection->prepare($sql);
    $sth->execute();
}

function delete_view($id_view)
{
    global $connection;

    $sql = "DELETE FROM views
WHERE id_view= $id_view";
    $sth = $connection->prepare($sql);
    $sth->execute();
}




function search($search)
{

    global $connection;

    $sql = "SELECT * FROM blogs

INNER JOIN users ON users.id_user = blogs.id_user
INNER JOIN blog_cat ON blog_cat.id_blog_cat = blogs.id_blog_cat
WHERE  blogs.active= 1 AND blogs.blog Like '%$search%' OR  blogs.active= 1 AND blog_cat.name_blog_cat Like '%$search%' OR blogs.active= 1";
    $sth = $connection->prepare($sql);
    $sth->execute();
    $resultat = $sth->fetchAll(PDO::FETCH_OBJ);
    return $resultat;
}
