function changearticleColor(type) {
    var color = null;
    switch (type) {
        case 1:
            color = "#f00";
            break;
        case 2:
            color = "#000";
            break;
        case 3:
            color = "#00f";
            break;
    }
    $("#article-title").css("color", color);
    $("#article-title-color").val(color);
}

