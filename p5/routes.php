<?php

# Define the routes of your application

return [
    # Ex: The path `/` will trigger the `index` method within the `AppController`
    '/' => ['AppController', 'index'],
    '/process'=> ['AppController', 'process'],
    '/play'=> ['AppController', 'play'],
    '/new'=> ['AppController', 'initialize'],
    '/history'=>['AppController', 'history'],
    '/game'=>['AppController', 'game'],
];