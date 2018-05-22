window._ = require('lodash');
window.Popper = require('popper.js').default;
window.$ = window.jQuery = require('jquery');
require('bootstrap');
window.WOW = require('wowjs');
window.CountUp = require('countup.js');
require('sweetalert');

new CountUp("stats-shelters", 0, 70).start();
new CountUp("stats-animals", 0, 4978).start();
new CountUp("stats-volunteers", 0, 211).start();
new CountUp("stats-visits", 0, 10769).start();
new CountUp("stats-pageviews", 0, 71508).start();

let wow = new WOW.WOW(
    {
        boxClass:     'wow',      // animated element css class (default is wow)
        animateClass: 'animated', // animation css class (default is animated)
        offset:       0,          // distance to the element when triggering the animation (default is 0)
        mobile:       false,       // trigger animations on mobile devices (default is true)
        live:         true,       // act on asynchronously loaded content (default is true)
        scrollContainer: null // optional scroll container selector, otherwise use window
    }
);
wow.init();

$('.select-country').on('change', function() {

    let country = $('.select-country option:selected').val();

    $('.select-city').find('option').remove();
    $('.select-city').prop('disabled', true);
    $('.select-city').append($('<option>', {
        value: '',
        text: 'Debe seleccionar una provincia',
        disabled: true,
        selected: true
    }));
    $('.select-state').find('option').remove();
    $('.select-state').prop('disabled', false);

    $('.select-state').append($('<option>', {
        value: '',
        text: 'Seleccione una provincia',
        disabled: true,
        selected: true
    }));

    $.ajax({
        url: '/api/location/states/' + country
    }).done(function(data) {
        $.each(data, function (i, state) {
            $('.select-state').append($('<option>', {
                value: state.id,
                text: state.name
            }));
        });
    });

});

$('.select-state').on('change', function() {

    let state = $('.select-state option:selected').val();

    if (state == '') {
        $('.select-state option:selected').prop('disabled', true);
        $('.select-city').find('option').remove();
        $('.select-city').prop('disabled', true);
        $('.select-city').append($('<option>', {
            value: '',
            text: 'Debe seleccionar una provincia',
            disabled: true,
            selected: true
        }));
    } else {
        $.ajax({
            url: '/api/location/cities/' + state
        }).done(function (data) {
            $('.select-city').find('option').remove();
            $('.select-city').prop('disabled', false);
            $('.select-city').append($('<option>', {
                value: '',
                text: 'Seleccione una ciudad',
                disabled: true,
                selected: true
            }));
            $.each(data, function (i, state) {
                $('.select-city').append($('<option>', {
                    value: state.id,
                    text: state.name
                }));
            });
        });
    }

});

$('.select-city').on('change', function() {

    let city = $('.select-city option:selected').val();

    if (city == '') {
        $('.select-city option:selected').prop('disabled', true);
    }
});

/**
 * Smooth scroll
 */
$('a[href*="#"]:not([href="#"])').click(function() {
    let target = $(this.hash);
    target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
    if (target.length) {
        $('html, body').animate({
            scrollTop: target.offset().top
        }, 500);
        return false;
    }
});