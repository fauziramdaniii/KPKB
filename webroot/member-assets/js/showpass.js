
function shopPass() {
    var $showHidePassword = $('.show-hide-password');
    if ($showHidePassword.length > 0) {
        $showHidePassword.each(function() {
            var elem = $(this),
                $iconEye = 'la-eye',
                $iconClosedEye = 'la-eye-slash',
                elemShowHideIcon = elem.find('.input-group-append i'),
                elemInput = elem.children('input');
            elem.find('.input-group-append i').css({
                'cursor': 'pointer'
            });
            elemShowHideIcon.on('click', function(event) {
                event.preventDefault();
                if (elem.children('input').attr("type") == "text") {
                    elemInput.attr('type', 'password');
                    elemShowHideIcon.removeClass($iconEye);
                    elemShowHideIcon.addClass($iconClosedEye);
                } else if (elem.children('input').attr("type") == "password") {
                    elemInput.attr('type', 'text');
                    elemShowHideIcon.addClass($iconEye);
                    elemShowHideIcon.removeClass($iconClosedEye);
                }
            });
        });
    }
}


shopPass();