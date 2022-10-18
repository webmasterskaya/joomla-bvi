document.addEventListener('DOMContentLoaded', function () {

    let bvi_open = document.querySelector('.bvi-open');

    if (
        bvi_open === null ||
        bvi_open === undefined
    ) {
        return;
    }

    new isvek.Bvi({
        "option":
            {
                'target': '.bvi-open',
                "theme": "white",
                "fontFamily": "arial",
                "fontSize": 16,
                "letterSpacing": "normal",
                "lineHeight": "normal",
                "images": true,
                "reload": true,
                "speech": true,
                "builtElements": true,
                "panelHide": false,
                "panelFixed": false,
                "lang": "ru-RU"
            }
    });

});