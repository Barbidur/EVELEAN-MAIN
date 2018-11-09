if (typeof jQuery === 'undefined') {
  throw new Error('PassRequirements requires jQuery')
}

+(function ($) {

    $.fn.PassRequirements = function (options) {

        /*
         * TODO
         * ====
         * 
         * store regexes in variables so they can be used by users through string 
         * specifications,ex 'number', 'special', etc
         * 
         */

        var defaults = {
//            defaults: true
        };
        
        if(
            !options ||                     //if no options are passed                                  /*
            options.defaults == true ||     //if default option is passed with defaults set to true      * Extend options with default ones
            options.defaults == undefined   //if options are passed but defaults is not passed           */
        ){
            if(!options){                   //if no options are passed, 
                options = {};               //create an options object
            }
            defaults.rules = $.extend({
                minlength: {
                    text: "be at least 8 characters",
                    minLength: 8,
                },
                containNumbers: {
                    text: "Your input should contain at least minLength number",
                    minLength: 1,
                    regex: new RegExp('[^0-9]', 'g')
                },
                containLowercase: {
                    text: "contain at least 1 lower case character",
                    minLength: 1,
                    regex: new RegExp('[^a-z]', 'g')
                },
                containUppercase: {
                    text: "Your input should contain at least minLength upper case character",
                    minLength: 1,
                    regex: new RegExp('[^A-Z]', 'g')
                }
            }, options.rules);
        }else{
            defaults = options;     //if options are passed with defaults === false
        }
        

        
        var i = 0;

        return this.each(function () {
            
            if(!defaults.defaults && !defaults.rules){
                console.error('You must pass in your rules if defaults is set to false. Skipping this input with id:[' + this.id + '] with class:[' + this.classList + ']');
                return false;
            }
            
            var requirementList = "";
            $(this).data('pass-req-id', i++);

            $(this).keyup(function () {
                var this_ = $(this);
                Object.getOwnPropertyNames(defaults.rules).forEach(function (val, idx, array) {
                    if (this_.val().replace(defaults.rules[val].regex, "").length > defaults.rules[val].minLength - 1) {
                        if (this_.next('.popover').find('#' + val).hasClass('invalid')) {
                            this_.next('.popover').find('#' + val).removeClass('invalid');
                        }
                        this_.next('.popover').find('#' + val).addClass('valid');
                    } else {
                        if (this_.next('.popover').find('#' + val).hasClass('valid')) {
                            this_.next('.popover').find('#' + val).removeClass('valid');
                        }
                        this_.next('.popover').find('#' + val).addClass('invalid');
                    }

                })
            });

            Object.getOwnPropertyNames(defaults.rules).forEach(function (val, idx, array) {
                requirementList += (("<li id='" + val + "'>" + defaults.rules[val].text).replace("minLength", defaults.rules[val].minLength));
            })
            try{
            $(this).popover({
                title: 'Password Requirements',
                trigger: options.trigger ? options.trigger : 'focus',
                html: true,
                placement: options.popoverPlacement ? options.popoverPlacement : 'bottom',
                content: 'Your password should contain:<ul class="check">' + requirementList + '</ul>'
            });
            }catch(e){
                throw new Error('PassRequirements requires Bootstraps Popover plugin');
            }
            $(this).focus(function () {
                $(this).keyup();
            });
        });
    };

}(jQuery));
