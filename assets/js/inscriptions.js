$(".btn-inscription").on("click", function(){
    const idSeance = $(this).data("id-seance");
    window.location.href="ajouter_inscriptions.php?id_seance="+idSeance;

})


