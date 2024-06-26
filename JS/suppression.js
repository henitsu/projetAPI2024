function confirmDelete(id, baseUrl, entity) {
    var confirmation = confirm("Voulez-vous vraiment supprimer ce " + entity + " ?");
    if (confirmation) {
        const requestOptions = {
            method: 'DELETE', // Méthode HTTP
            headers: { 
                'Access-Control-Allow-Origin': '*',
                'Content-Type': 'application/json' }, // Type de contenu
        };

        var url = baseUrl + id;
        fetch(url, requestOptions)
        .then(response => {
            if (response.ok) {
                // Entité supprimée avec succès, actualiser la page
                location.reload();
            } else {
                throw new Error('Erreur lors de la suppression de ' + entity + ' ! ' + response.status + ' : ' + response.statusText);
            }
        })
        .catch(error => {
            console.error('Erreur Fetch:', error);
        });
    }
}