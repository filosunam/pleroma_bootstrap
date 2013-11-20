'use strict';

module.exports = function(grunt){

// load all grunt tasks
require('load-grunt-tasks')(grunt);

grunt.initConfig({
    less: {
      development: {
        options: {
          paths: [ 'css/less' ],
          yuicompress: true
        },
        files: [
          {
            expand: true,
            cwd: 'css/less',
            src: [
              'style*.less',
              'admin.less'
            ],
            dest: 'css' ,
            ext: '.css'
          }
        ]
      }
    },
    watch: {
      less: {
        files: [ 'css/less/*.less' ],
        tasks: [ 'less' ],
        options: { nospawn: true }
      },
      livereload: {
        options: { livereload: true },
        files: [
          '**/*.less',
          '**/*.php'
        ]
      }
    },
    uglify: {
      target: {
        files: {
          'js/pleroma_bootstrap.min.js': [
            "components/bootstrap/js/bootstrap-transition.js",
            "components/bootstrap/js/bootstrap-alert.js",
            "components/bootstrap/js/bootstrap-button.js",
            "components/bootstrap/js/bootstrap-carousel.js",
            "components/bootstrap/js/bootstrap-collapse.js",
            "components/bootstrap/js/bootstrap-dropdown.js",
            "components/bootstrap/js/bootstrap-modal.js",
            "components/bootstrap/js/bootstrap-tooltip.js",
            "components/bootstrap/js/bootstrap-popover.js",
            "components/bootstrap/js/bootstrap-scrollspy.js",
            "components/bootstrap/js/bootstrap-tab.js",
            "components/bootstrap/js/bootstrap-typeahead.js",
            "components/bootstrap/js/bootstrap-affix.js",
            "js/pleroma.js"
          ]
        }
      }
    },
    exec: {
      bootstrap: {
        command: 'cp ./components/bootstrap/img/* ./img'
      }
    },
    release: {
      options: {
        commit: true,
        push: false,
        pushTags: false,
        npm: false,
        commitMessage: 'Release <%= version %>',
        tagMessage: 'Version <%= version %>'
      }
    }
  });

  grunt.registerTask('build', ['less', 'uglify', 'exec']);
};
