var elixir = require('laravel-elixir');

//Not sure I am 100% keen on elixir to be honest. It feels quite heavy for limited improvement over straight gulp?
elixir(function(mix) {
    //Move css files
    mix.styles([
        '../bower/bootstrap/dist/css/bootstrap.css'
    ]);

    //Move js files
    mix.scripts([
        '../bower/bootstrap/dist/js/bootstrap.js',
    ]);
});
