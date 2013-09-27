# Pleroma Bootstrap
Plantilla de Wordpress diseñada y desarrollada para la [Facultad de Filosofía y Letras, UNAM](http://www.filos.unam.mx). Basado en [Bootstrap](https://twitter.github.com/bootstrap).

## ¿Cómo empezar?

    $ git clone git@github.com:filosunam/pleroma_bootstrap.git
    $ git submodule update --init

## Generar archivos

Es muy sencillo generar todos los archivos (css, js, imágenes) para la plantilla,  utilizando [Grunt.js](http://gruntjs.com):

    $ cd [path]/pleroma_bootstrap
    $ npm install && npm install -g grunt-cli
    $ grunt build

También puedes generar por tipo de archivo:

* `grunt less` para compilar LESS y generar CSS.
* `grunt uglify` para concatenar y minificar archivos javascript
* `grunt exec:bootstrap` para generar imágenes de [Boostrap](https://twitter.github.com/bootstrap)

## ¿Cómo contribuir?

Hay un *workflow* definido para el desarrollo web de esta plantilla.

Utiliza la tarea `grunt watch` para que el desarrollo web de la plantilla sea mucho más rápido y fácil. De tal manera que puedes editar archivos LESS y PHP con *livereload*.

