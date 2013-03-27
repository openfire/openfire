(function($) {
    $.fn.extend( {
        limiter: function(limit, threshold, elem) {
            $(this).on("keyup focus", function() {
                setCount(this, elem);
            });
            function setCount(src, elem) {
                var chars = src.value.length;
                if (chars > limit) {
                    src.value = src.value.substr(0, limit);
                    chars = limit;
                }
                if(limit - chars > threshold){
                       elem.html( limit - chars );
                }else{
                    elem.html("<span style='color: #f00'>" + (limit - chars) + "</span>");
                }
            }
            setCount($(this)[0], elem);
        }
    });
})(jQuery);