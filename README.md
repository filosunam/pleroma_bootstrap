# Pleroma Bootstrap
Plantilla de Wordpress para la [Facultad de Filosofía y Letras, UNAM](http://www.filos.unam.mx). Basada en [Bootstrap](https://github.com/twbs/bootstrap).

## ¿Cómo empezar?

    $ git clone git@github.com:filosunam/pleroma_bootstrap.git
    $ npm install && bower install

## Generar archivos

Generar archivos (js, css) de producción para la plantilla, utilizando [Grunt.js](http://gruntjs.com):

    $ grunt build

Es posible generarlos por tipo de archivo:

* `grunt less` para compilar LESS y generar archivos CSS minificados.
* `grunt uglify` para concatenar y minificar archivos JavaScript.

## ¿Cómo contribuir?

Para que el desarrollo web de la plantilla sea más rápido y sencillo, con *livereload*, utilizar la tarea:

    $ grunt watch
