# Pleroma Bootstrap (Wordpress Theme)
Desarrollado para la [Facultad de Filosofía y Letras, UNAM](http://www.filos.unam.mx). Basado en [Twitter Bootstrap](https://twitter.github.com/bootstrap)

# ¿Cómo empezar?

Esta plantilla utiliza el *core* [Boostrap](https://twitter.github.com/bootstrap).

    $ git clone https://github.com/markotom/pleroma_bootstrap.git

# Generar archivos

Hay un *workflow* definido para el desarrollo web de esta plantilla.

Es muy sencillo generar todos los archivos necesarios (css, js, imágenes) para la plantilla,  utilizando [Grunt.js](http://gruntjs.com):

    $ cd [path]/pleroma_bootstrap
    $ grunt build

También puedes generar por tipo de archivo.

* `grunt less` para compilar LESS y generar CSS.
* `grunt uglify` para concatenar y minificar archivos javascript
* `grunt exec:bootstrap` para generar imágenes de [Boostrap](https://twitter.github.com/bootstrap)

# ¿Cómo contribuir?

Utiliza la tarea `grunt watch` para que el desarrollo web de la plantilla sea mucho más rápido y fácil. De tal manera que puedes editar archivos LESS y PHP con *livereload*.

