/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

window.$ = window.jQuery = require('jquery');

// any CSS you require will output into a single css file (app.css in this case)
require('../css/app.scss');
require('materialize-css');

// Need jQuery? Install it with "yarn add jquery", then uncomment to require it.
//const $ = require('jquery');


function initMaterializeElements() {
    $(".dropdown-trigger:not(input)").dropdown({coverTrigger: false, constrainWidth: false});
    $('.fixed-action-btn').floatingActionButton();
    $('.tabs').tabs();
    $('.modal').modal();
    $('.tooltipped').tooltip();
    $('.datepicker').datepicker();
}

$(document).ready(initMaterializeElements);

