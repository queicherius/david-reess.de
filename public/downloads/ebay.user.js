// ==UserScript==
// @name             Ebay Automatische Aktualisierung
// @description      Aktualisiert das Auktionshaus ebay automatisch nach 10 Sekunden.
// @namespace        http://www.david-reess.de.ki
// @include          http://cgi.ebay.de*

window.setTimeout(ebay, 10000);

function ebay(){
location.reload()
}