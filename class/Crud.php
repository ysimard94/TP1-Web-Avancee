<?php

class Crud extends PDO 
{
    // Configuration de la connexion vers la base de données
    public function __construct()
    {
        parent::__construct('mysql:host=localhost; dbname=librairie; port=3306; charset=utf8', 'root', '');
    }

    // Va retourner les informations de la table selon les champs spécifiés
    public function select($table, $field='id', $order='ASC' )
    {
        $sql = "SELECT * FROM $table ORDER BY $field $order";
        $stmt  = $this->query($sql);
        return  $stmt->fetchAll();
    }

    // Va retourner la valeur d'un champ si la comparaison correspond à un des champs spécifiés
    public function selectCompare($id, $col='*', $table)
    {
        $sql = "SELECT $col FROM $table WHERE $id = id";
        $stmt  = $this->query($sql);
        return  $stmt->fetch();
    }

    // Va servir à retourner un tableau de manière sécure à l'aide des méthodes PDO pour éviter qu'un utilisateur puisse envoyer des requêtes
    // avec la méthode GET qui pourraient toucher à la base de données
    public function selectId($table, $value, $field = 'id', $url = 'client-index.php')
    {
        $sql ="SELECT * FROM $table WHERE $field = :$field";
        $stmt = $this->prepare($sql);
        $stmt->bindValue(":$field", $value);
        $stmt->execute();
        $count = $stmt->rowCount();
        
        // Si l'exécution de la requête a bel et bien retourné un résultat, retourner celui-ci, sinon rediriger l'utilisateur vers la page spécifiée
        if($count == 1 )
        {
            return $stmt->fetch();
        }
        else
        {
            header("location: $url");
        }
    }


    // Méthode qui sert à insérer les données envoyées dans la table spécifiée de la base de données
    public function insert($table, $data, $url = 'index.php')
    {
        $nomChamp = implode(", ",array_keys($data));
        $valeurChamp = ":".implode(", :", array_keys($data));

        $sql = "INSERT INTO $table ($nomChamp) VALUES ($valeurChamp)";
        
        $stmt = $this->prepare($sql);

        foreach($data as $key=>$value)
        {
            $stmt->bindValue(":$key", $value);
        }

        // Si la requête ne s'exécute pas, retourner les informations de l'erreur, si elle s'exécute, renvoyer l'utilsateur à la page spécifiée
        if(!$stmt->execute())
        {
            print_r($stmt->errorInfo());
        }
        else
        {
            header('Location: ' . $url);
        }
    }
    
    // Méthode pour mettre à jour les informations d'une donnée déjà enregistrée
    public function update($table, $data, $champId = 'id', $url = 'client-index.php')
    {
        $champRequete = null;

        // Une boucle pour concatonner le nom des clés dans une variable pour avoir automatiquement les colonnes où mettre les informations à jour
        foreach($data as $key=>$value)
        {
            $champRequete .= "$key = :$key, ";
        }

        // Va formater les données de manière à ce qu'elles puissent être dans les sélections des colonnes d'une requête SQL
        $champRequete = rtrim($champRequete, ", ");

        $sql = "UPDATE $table SET $champRequete WHERE $champId = :$champId";

        $stmt = $this->prepare($sql);

        foreach($data as $key=>$value)
        {
            $stmt->bindValue(":$key", $value);
        }

        // Si la requête ne s'exécute pas, retourner les informations de l'erreur, si elle s'exécute, renvoyer l'utilsateur à la page spécifiée
        if(!$stmt->execute())
        {
            print_r($stmt->errorInfo());
        }
        else
        {
            header('Location: ' . $url);
        }
    }

    // Méthode pour supprimer le champ d'une table avec la valeur renvoyée
    public function delete($table, $id, $champId = 'id', $url='index.php')
    {
        $sql = "DELETE FROM $table WHERE $champId = :$champId";

        $stmt = $this->prepare($sql);
        $stmt->bindValue(":$champId", $id);

        // Si la requête ne s'exécute pas, retourner les informations de l'erreur, si elle s'exécute, renvoyer l'utilsateur à la page spécifiée
        if(!$stmt->execute())
        {
            print_r($stmt->errorInfo());
        }
        else
        {
            header('Location: ' . $url);
        }

    }
}
?>