$(document).ready(function() {
    console.log("Document ready");

    // Suppression d'un produit
    $(document).on('click', '.delete_product_btn', function(e) {
        e.preventDefault();
        console.log("Delete product button clicked");

        var id = $(this).val();
        console.log("Product ID: " + id);

        swal({
            title: "Etes-vous sûr ?",
            text: "Cliquez sur OK pour supprimer définitivement ce produit.",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                console.log("Will delete confirmed");

                $.ajax({
                    method: "POST",
                    url: "code.php",
                    data: {
                        'product_id': id,
                        'delete_product_btn': true,
                    },
                    success: function(response) {
                        console.log("AJAX success response: " + response);

                        if (response.trim() == 200) {
                            console.log("Product deleted successfully");
                            swal("Supprimé !", "Produit supprimé avec succès !", "success")
                            .then((value) => {
                                setTimeout(function() {
                                    location.reload();
                                }, 1000); // Délai de 1 seconde
                            });
                        } else if (response.trim() == 500) {
                            console.log("Error deleting product");
                            swal("Erreur !", "Erreur lors de la suppression du produit !", "error");
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log("AJAX error: " + error);
                    }
                });
            }
        });
    });

    // Suppression d'une catégorie
    $(document).on('click', '.delete_category_btn', function(e) {
        e.preventDefault();
        console.log("Delete category button clicked");

        var id = $(this).val();
        console.log("Category ID: " + id);

        swal({
            title: "Etes-vous sûr ?",
            text: "Cliquez sur OK pour supprimer définitivement cette catégorie.",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                console.log("Will delete confirmed");

                $.ajax({
                    method: "POST",
                    url: "code.php",
                    data: {
                        'category_id': id,
                        'delete_category_btn': true,
                    },
                    success: function(response) {
                        console.log("AJAX success response: " + response);

                        if (response.trim() == 200) {
                            console.log("Category deleted successfully");
                            swal("Supprimé !", "Catégorie supprimée avec succès !", "success")
                            .then((value) => {
                                setTimeout(function() {
                                    location.reload();
                                }, 1000); // Délai de 1 seconde
                            });
                        } else if (response.trim() == 500) {
                            console.log("Error deleting category");
                            swal("Erreur !", "Erreur lors de la suppression de la catégorie !", "error");
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log("AJAX error: " + error);
                    }
                });
            }
        });
    });
});