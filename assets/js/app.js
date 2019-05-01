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
    $('select').formSelect();
}

$(document).ready(initMaterializeElements);

$(document).ready(function () {
    if (window.toast !== '[]' && typeof window.toast != 'undefined') {
        var toastJson = JSON.parse(window.toast);
        $.each(toastJson, function (index, value) {
            var message = '<i class="material-icons">' + index + '</i> &nbsp;' + value;
            if (index === 'success') {
                message = '<i class="material-icons">looks</i> &nbsp;' + value;
            }
            M.toast({html: message, classes: index});
        });
    }
});

