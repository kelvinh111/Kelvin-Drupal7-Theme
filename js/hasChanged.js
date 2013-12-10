/* this plugin following post on the jQuery-dev mailing list: https://groups.google.com/forum/?fromgroups=#!topic/jquery-dev/ZaMw2XB6wyM  */
/* inspired by Wil Stuckey's plugin */
/*!
 * jQuery element hasChanged event
 * https://gist.github.com/ballast67/5371975/
 *
 * Copyright, Arnaud Wolff.  arnwolff@gmail.com
 * Dual licensed under the MIT or GPL Version 2 licenses.
 *
 * MIT-LICENSE
 * GPL-LICENSE
 */
 /* please feel free to use/modificate/distribute */
;(function ($) {
    var fctsToObserve = {
        append: [$.fn.append, 'self'],
        prepend: [$.fn.prepend, 'self'],
        remove: [$.fn.remove, 'parent'],
        before: [$.fn.before, 'parent'],
        after: [$.fn.after, 'parent']
    }, fctsObserveKeys = '';
    $.each(fctsToObserve, function (key, element) {
        fctsObserveKeys += "hasChanged." + key + " ";
    });
    var oOn = $.fn.on;
    $.fn.on = function () {
        if (arguments[0].indexOf('hasChanged') != -1) arguments[0] += " " + fctsObserveKeys;
        return oOn.apply(this, arguments);
    };
    $.fn.hasChanged = function (types, data, fn) {
        return this.on(fctsObserveKeys, types, null, data, fn);
    };
    $.extend($, {
        observeMethods: function (namespace) {
            var namespace = namespace ? "." + namespace : "";
            var _len = $.fn.length;
            delete $.fn.length;
            $.each(fctsToObserve, function (key) {
                var _pre = this;
                $.fn[key] = function () { 
                    var target = _pre[1] === 'self' ? this : this.parent(),
                        ret = _pre[0].apply(this, arguments);
                    target.trigger("hasChanged." + key + namespace, arguments);
                    return ret;
                };
            });
            $.fn.length = _len;
        }
    });
    $.observeMethods()
})(jQuery);