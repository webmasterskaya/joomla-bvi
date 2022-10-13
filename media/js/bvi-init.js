document.addEventListener('DOMContentLoaded', function() {

    let bvi_open = document.querySelector('.bvi-open');

    if(
        bvi_open === null ||
        bvi_open === undefined
    ) {
        return;
    }

    new isvek.Bvi({
        "option":
            {
                'target' : '.bvi-open',
                "theme": "white",
                "font": "arial",
                "fontSize": 16,
                "letterSpacing": "normal",
                "lineHeight": "normal",
                "images": true,
                "reload": false,
                "speech": true,
                "builtElements": true,
                "panelHide": false,
                "panelFixed": false,
                "lang":"ru-RU"
            }
    });


    setTimeout(function (){
        let bvi_body = document.querySelector('.bvi-body');

        if(
            bvi_open.getAttribute('data-active') === '1' &&
            (bvi_body === undefined || bvi_body === null)
        ) {
            bvi_open.click();
        }

    }, 200);

});