<?php

require('vendor/autoload.php');

use Html\Html;
use Html\CSS;


$array = [
    "https://deutscher-fenstershop.de/",
    "https://deutscher-fenstershop.de/konfigurator/fenster",
    "https://deutscher-fenstershop.de/konfigurator/psktuer/material",
    "https://deutscher-fenstershop.de/konfigurator/tueren",
    "https://deutscher-fenstershop.de/konfigurator/rolladen",
    "https://deutscher-fenstershop.de/kaufen/kunststofffenster",
    "https://deutscher-fenstershop.de/veka-fenster",
    "https://deutscher-fenstershop.de/drutex-fenster",
    "https://deutscher-fenstershop.de/knipping-fenster",
    "https://deutscher-fenstershop.de/salamander",
    "https://deutscher-fenstershop.de/aluplast-fenster",
    "https://deutscher-fenstershop.de/schueco/living",
    "https://deutscher-fenstershop.de/gealan",
    "https://deutscher-fenstershop.de/fenster/alufenster-mb45",
    "https://deutscher-fenstershop.de/fenster/aluminium-fenster-mb70",
    "https://deutscher-fenstershop.de/fenster/aluminium-fenster-mb70hi",
    "https://deutscher-fenstershop.de/kaufen/alu-fenster",
    "https://deutscher-fenstershop.de/kaufen/holzfenster",
    "https://deutscher-fenstershop.de/kaufen/holz-alu-fenster",
    "https://deutscher-fenstershop.de/fenster/holz-aluminium-fenster-kiefer-68-mm",
    "https://deutscher-fenstershop.de/fenster/holz-aluminium-fenster-kiefer-78-mm",
    "https://deutscher-fenstershop.de/fenster/holz-aluminium-fenster-kiefer-88-mm",
    "https://deutscher-fenstershop.de/fenster/holz-aluminium-fenster-meranti-68-mm",
    "https://deutscher-fenstershop.de/fenster/holz-aluminium-fenster-meranti-78-mm",
    "https://deutscher-fenstershop.de/fenster/holz-aluminium-fenster-meranti-88-mm",
    "https://deutscher-fenstershop.de/brandschutzfenster",
    "https://deutscher-fenstershop.de/schiebefenster",
    "https://deutscher-fenstershop.de/konfigurator/balkontueren/material",
    "https://deutscher-fenstershop.de/eingangstueren",
    "https://deutscher-fenstershop.de/kaufen/eingangstuer",
    "https://deutscher-fenstershop.de/nebeneingangstueren",
    "https://deutscher-fenstershop.de/brandschutztuer",
    "https://deutscher-fenstershop.de/balkontuer",
    "https://deutscher-fenstershop.de/hebeschiebetuer",
    "https://deutscher-fenstershop.de/schiebetuer-smart-slide-aluplast",
    "https://deutscher-fenstershop.de/faltschiebetueren-terrasse",
    "https://deutscher-fenstershop.de/parallel-schiebe-kipptuer",
    "https://deutscher-fenstershop.de/wintergarten",
    "https://deutscher-fenstershop.de/rollladen/aufsatzrollladen",
    "https://deutscher-fenstershop.de/vorbaurollladen",
    "https://deutscher-fenstershop.de/sektionaltore",
    "https://deutscher-fenstershop.de/konfigurator/sektionaltor",
    "https://deutscher-fenstershop.de/fensterlaeden",
    "https://deutscher-fenstershop.de/kaufen/alles-rund-um-beschlaege",
    "https://deutscher-fenstershop.de/fenstergriffe",
    "https://deutscher-fenstershop.de/fenster/maco-montagegriff-schluessel-zum-ausheben-von-bolzen",
    "https://deutscher-fenstershop.de/lueftungssysteme-fenster",
    "https://deutscher-fenstershop.de/fenster/fenster-farbmuster-fensterfolien-dekore-drutex/",
    "https://deutscher-fenstershop.de/festerkralle",
    "https://deutscher-fenstershop.de/kaufen/steinbankanschluesse",
    "https://deutscher-fenstershop.de/fenster/feststellbremse",
    "https://deutscher-fenstershop.de/kaufen/wasserschlitzkappen",
    "https://deutscher-fenstershop.de/kaufen/rollladenzubehoer",
    "https://deutscher-fenstershop.de/fenstersprossen",
    "https://deutscher-fenstershop.de/kaufen/ersatzteile-zubehoer",
    "https://deutscher-fenstershop.de/callback",
    "https://deutscher-fenstershop.de/anmeldung/",
    "https://deutscher-fenstershop.de/anmeldung/registration",
    "https://deutscher-fenstershop.de/search?q=window&search=1",
    "https://deutscher-fenstershop.de/bestellverfolgung",
    "https://deutscher-fenstershop.de/job-vertrieb",
];

//(new CSS())->parse('src/main.css', $array);
$parser = (new \Html\UrlParser('https://deutscher-fenstershop.de/'));
print_r($parser->getAllUrls());

//$html = new Html("https://deutscher-fenstershop.de/");
//var_dump($html->get());
