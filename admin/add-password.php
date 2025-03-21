<?php
include("../config/dbconfig.php");

if (isset($_GET['id'])) {
    $client_id = intval($_GET['id']);
    $query = $con->prepare("SELECT * FROM clients WHERE id = ?");
    $query->bind_param("i", $client_id);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
    } else {
        echo "Client introuvable.";
        exit();
    }
} else {
    echo "ID client manquant.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Définir le mot de passe</title>
</head>
<body>
    <div class="card">
        <div class="card-header">
            Ajouter le mot de passe client
        </div>
        <div class="card-body">
            <form action="code.php" method="POST">
                <div class="col-md-12">
                    <input type="hidden" name="id_client" value="<?= $data['id'] ?>">
                    <label for="">Mot de passe</label>
                    <input type="password" name="password" placeholder="Entrer le nouveau mot de passe" class="form-control" required>
                </div>
                <div class="col-md-12">
                    <label for="">Confirmer le mot de passe</label>
                    <input type="password" name="confirm_password" placeholder="Confirmer le mot de passe" class="form-control" required>
                </div>
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary" name="add_pwd_client_btn">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>