/*
	Miniport by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
*/

/*Chargement de chacune des sous-pages */
var pages = ['tab_plans.html','tab_c_interactives.html','tab_donnees_geo.html','contact.html'];
for (var i=0;i<pages.length;i++){
    addHTMLFileContent(pages[i]);
}

(function($) {

    var	$window = $(window),
        $body = $('body'),
        $nav = $('#nav');

    // Breakpoints.
        breakpoints({
            xlarge:  [ '1281px',  '1680px' ],
            large:   [ '981px',   '1280px' ],
            medium:  [ '737px',   '980px'  ],
            small:   [ null,      '736px'  ]
        });

    // Play initial animations on page load.
        $window.on('load', function() {
            window.setTimeout(function() {
            $body.removeClass('is-preload');
                init();
            }, 200);
        });
        
        $window.on('hashchange', function() {
            window.setTimeout(function() {
                init();
            }, 200);
        });

    // Scrolly.
        $('#nav a, .scrolly').scrolly({
            speed: 1000,
            offset: function() { return $nav.height(); }
        });

})(jQuery);

function addHTMLFileContent(url){
    console.log("AJOUT DE LA PAGE " + url);
    fetch(url)
        .then(response=> response.text())
        .then(text=> {
            //console.log (text);
            document.getElementById('main_').innerHTML +=text;
        });
}

function init(){
    
    
    /*Ouverture du panneau/article passé en ancre de l'URL */
    var url = window.location.href;
    if (url.indexOf("#") > 0) {
        let activeTab = url.substring(url.indexOf("#") + 1);
        let activelem = $('#'+ activeTab)[0];
        let tabpanellnk = $('a[href="#'+ activeTab +'"]')[0];
        if (activelem !== undefined) {
            if (activelem.tagName.toLowerCase() !== 'div' || activelem.getAttribute("role") == undefined || activelem.getAttribute("role") !== 'tabpanel') {
                let tabpanelId = activelem.closest("div[role='tabpanel']").id;
                $('a[href="#'+ tabpanelId +'"]').tab('show');;
                window.location.href = '#'+ activeTab;
            } else {
                $('a[href="#'+ activeTab +'"]').tab('show');
                document.body.scrollTop = 0;
                document.documentElement.scrollTop = 0;
            }
        } else {
            $('a[href="#c_plans"]').tab('show');
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
        }
    } else {
        $('a[href="#c_plans"]').tab('show');
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    }

}


