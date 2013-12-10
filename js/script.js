(function($) {
  $(window).load(function() {
    
    var Global = (function() {
      var s;
      function privateFunction() {

      }
      return {
        settings: {
          body: $("body"),
          isLoggedIn: $("body").hasClass("logged-in") ? true : false,
          bodyClassList: obj = {
            Home: "front",
          }
        },
        init: function(settings) {
          if (settings && typeof (settings) === 'object')
            $.extend(this.settings, settings);
          s = this.settings;
          this.initPage();
          this.bindActions();
        },
        initPage: function() {
          for (var pageName in s.bodyClassList) {
            var c = s.bodyClassList[pageName];
            if ((c.charAt(c.length - 1) == '-' && s.body.attr('class').indexOf(c) != -1)
                    || (s.body.hasClass(c) && s.body.attr('class').indexOf(c + '-') == -1)) {
              eval(pageName + ".init()");
            }

          }
        },
        bindActions: function() {
        }
      };
    })();

    var Home = (function() {
      var s;
      function privateFunction() {
      }
      return {
        settings: {
        },
        init: function(settings) {
          if (settings && typeof (settings) === 'object')
            $.extend(this.settings, settings);
          s = this.settings;
          this.bindActions();
        },
        bindActions: function() {
        }
      };
    })();

    Global.init();

  });
})(jQuery);
