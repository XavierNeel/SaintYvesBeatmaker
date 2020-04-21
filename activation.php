<?php

include "sql.php";
include "fonction.php";
include "header.php";

?>

<?php

// Récupération des variables nécessaires à l'activation
$login = $_GET['log'];
$cle = $_GET['cle'];
@$active = htmlspecialchars($_POST["active"]);

// Récupération de la clé correspondant au $login dans la base de données
$list_cle = list_cle($login);

// On teste la valeur de la variable $actif récupérée dans la BDD
if ($active == '1') // Si le compte est déjà actif on prévient
{
    echo "Votre compte est déjà actif !";
} else // Si ce n'est pas le cas on passe aux comparaisons
{
    if ($cle == $cle) // On compare nos deux clés    
    {
        // Si elles correspondent on active le compte !    
        echo "Votre compte a bien été activé !";

        // La requête qui va passer notre champ actif de 0 à 1
        $valid = valid($login);
    } else // Si les deux clés sont différentes on provoque une erreur...
    {
        echo "Erreur ! Votre compte ne peut être activé...";
    }
}
//...    
// Fermeture de la connexion    
//...
// Votre code
//...
