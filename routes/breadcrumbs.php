<?php

 

    // Home
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Home', '/');
});

// Home > contacto
Breadcrumbs::for('contacto', function ($trail) {
    $trail->parent('home');
    $trail->push('Contacto', '/contacto');
});


// Home > franquicia
Breadcrumbs::for('franquicia', function ($trail) {
    $trail->parent('home');
    $trail->push('franquicia', '/franquicia');
});


// Home > cotizador
Breadcrumbs::for('cotizador', function ($trail) {
    $trail->parent('home');
    $trail->push('cotizador', '/cotizador');
});


// Home > sucursales
Breadcrumbs::for('sucursales', function ($trail) {
    $trail->parent('home');
    $trail->push('sucursales', '/sucursales');
});


// Home > regalos-empresariales
Breadcrumbs::for('regalos-empresariales', function ($trail) {
    $trail->parent('home');
    $trail->push('Regalos empresariales', '/regalos-empresariales');
});



    // Home  > [Category]

 Breadcrumbs::for('supercategory', function ($trail, $supercategory) {
    $trail->parent('home');
    $trail->push($supercategory->name, $supercategory->slug);
});

 Breadcrumbs::for('category', function ($trail, $category) {
    $trail->parent('supercategory',$category->supercategory);
    $trail->push($category->name, $category->slug);
});

 

// Home > [Category] > [Product]
Breadcrumbs::for('product', function ($trail, $product) {
    $trail->parent('category', $product->category);
    $trail->push($product->name, $product->slug);
});

