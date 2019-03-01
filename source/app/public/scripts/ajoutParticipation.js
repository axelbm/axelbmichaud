function rechercher() {
    let filter = $("#recherche").val().toUpperCase();

    $(".custom-control-label").each((i, lbl) => {
        if($(lbl).text().toUpperCase().indexOf(filter) > -1) {
            $(lbl).parent().show();
        } else {
            $(lbl).parent().hide();
        }
    });
}