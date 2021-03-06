/**
 * Frontend
 *
 * @author Your Inspiration Themes
 * @package YITH WooCommerce Ajax Navigation
 * @version 1.3.2
 */
jQuery(function($){
    /**
     Copyright (c) 2010, All Right Reserved, Wong Shek Hei @ shekhei@gmail.com
     License: GNU Lesser General Public License (http://www.gnu.org/licenses/lgpl.html)
     **/
    var expr=/[.#\w].([\S]*)/g,classexpr=/(?!(\[))(\.)[^.#[]*/g,idexpr=/(#)[^.#[]*/,tagexpr=/^[\w]+/,varexpr=/(\w+?)=(['"])([^\2$]*?)\2/,simpleselector=/^[\w]+$/,parseSelector=function(d){for(var c={sel:[],val:[]},a=[],j=!1,h="",e=[],f=0,m=d.length;f<m;f++){var g=d.charAt(f);if(j)if("\\"===g&&f+1<d.length)e.push(d.charAt(++f));else if(h===g)h="",e.push(g);else if(("'"===g||'"'===g)&&""===h)h=g,e.push(g);else if("]"===g&&""===h)c.val.push(e.join("")),e=[],j=!1;else{if("]"!==g||""!==h)""===h&&","===g?(c.val.push(e.join("")),
        e=[]):e.push(g)}else"\\"===g&&f+1<d.length?j&&e.push(d.charAt(++f)):"["===g&&""===h?j=!0:" "===g||"+"===g?(c.sel=c.sel.join(""),a.push(c),"+"===g&&a.push({sel:"+",val:""}),c={sel:[],val:[]}):" "!==g&&"]"!==g&&c.sel.push(g)}if(0!=c.sel.length||0!=c.val.length)c.sel=c.sel.join(""),a.push(c);for(f=0;f<a.length;f++){c=a[f].sel;if("+"===c)b.tag=c;else{var b=[];b.tag=tagexpr.exec(c);b.id=idexpr.exec(c);b.id&&$.isArray(b.id)&&(b.id=b.id[0].substr(1));b.tag||(b.tag="div");b.vars=[];for(d=0;d<a[f].val.length;d++)h=
        a[f].val[d].indexOf("="),j=a[f].val[d].substr(0,h),h=a[f].val[d].substr(h+1),h=h.replace(/^[\s]*[\"\']*|[\"\']*[\s]*$/g,""),"text"===j?b.text=h:b.vars.push([j,h]);c=c.match(classexpr);j=[];if(c){for(d=0;d<c.length;d++)j.push(c[d].substr(1));b.className=j.join(" ")}}a[f]=b}return a},rmFromParent=function(d){var c=d.parentNode,a=d.nextSibling;c.removeChild(d);return a?function(){c.insertBefore(d,a)}:function(){c.appendChild(d)}},nonArrVer=function(d,c){var a=[],a=simpleselector.test(d)?[{tag:d}]:parseSelector(d),
        j=[];"undefined"===typeof c&&(c=1);for(var h=[],e=[],f=[],m=document.createElement("div"),g=0,b=0;b<a.length;b++){if("+"==a[b].tag)e=f.slice(),--g;else{for(var l=0;l<c;l++)if("input"==a[b].tag){var k=[];k.push("<"+a[b].tag);a[b].id&&k.push("id='"+a[b].id+"'");a[b].className&&(k.push("class='"+a[b].className),b+1===a.length&&k.push(lastClass),k.push("'"));if(a[b].vars)for(var n=0;n<a[b].vars.length;n++)k.push(a[b].vars[n][0]+"='"+a[b].vars[n][1]+"'");a[b].text&&k.push("value='"+a[b].text+"'");k.push("/>");
        f[l]=e[l];e[l]?(e[l].innerHTML+=k.join(" "),e[l]=e[l].lastChild):(m.innerHTML=k.join(" "),e[l]=m.removeChild(m.firstChild))}else{k=document.createElement(a[b].tag);if(a[b].vars)for(n=0;n<a[b].vars.length;n++)console.log(a[b].tag,a[b].vars[n]),k.setAttribute(a[b].vars[n][0],a[b].vars[n][1]);a[b].id&&(k.id=a[b].id);a[b].className&&(k.className=a[b].className);a[b].text&&k.appendChild(document.createTextNode(a[b].text));f[l]=e[l];e[l]=e[l]?e[l].appendChild(k):k}g++||Array.prototype.push.apply(h,e)}j=
        $.merge(j,e)}return $(h)},arrVer=function(d,c,a){for(var j=d.match(/%[^%]*%/g)||[],h=[],e=0;e<c.length;e++){for(var f=d,m=0;m<j.length;m++)var g=j[m].substr(1,j[m].length-2),f=f.replace(j[m],c[e][g]);h=$.merge(h,nonArrVer(f,a))}return $(h)};
    $.jseldom=function(d){if(2==arguments.length&&$.isPlainObject(arguments[1]))return arrVer.apply(this,[arguments[0],[arguments[1]]]);if(1==arguments.length||2==arguments.length&&!$.isArray(arguments[1]))return nonArrVer.apply(this,arguments);if(2==arguments.length)return arrVer.apply(this,arguments)};

    //wrap the container
    $(yith_wcan.container).wrap('<div class="yit-wcan-container"></div>');
    $('.woocommerce-info').wrap('<div class="yit-wcan-container"></div>');

   $(document).on('click', '.yith-wcan a', function(e){

       e.preventDefault();
       var href = this.href;

       if( $(this).data('type') == 'select' ) {

           $(this).parents('div.yith-woo-ajax-navigation').find('a.yit-wcan-select-open').removeClass('active');

           $(this).parent().find('div.yith-wcan-select-wrapper').animate({

                visibility: "hidden",
                opacity: 0

            }, 300);
       }

        //loading
        $(yith_wcan.container).html('').addClass('yith-wcan-loading');
        $(yith_wcan.pagination).hide();
        $(yith_wcan.result_count).hide();

        $.ajax({
            url: href,
            success: function( response ){
                $(yith_wcan.container).removeClass('yith-wcan-loading');

                //container
                if( $(response).find(yith_wcan.container).length > 0 ) {
                    $('.yit-wcan-container').html( $(response).find(yith_wcan.container) );
                } else {
                    $('.yit-wcan-container').html( $(response).find('.woocommerce-info') );
                }


                //pagination
                if( $(response).find(yith_wcan.pagination).length > 0 ) {
                    //se non esiste lo creo
                    if( $(yith_wcan.pagination).length == 0 ) {
                        $.jseldom( yith_wcan.pagination ).insertAfter( $(yith_wcan.container) );
                    }

                    $(yith_wcan.pagination)
                        .html( $(response).find(yith_wcan.pagination).html())
                        .show();
                }

                //result count
                if( $(response).find(yith_wcan.result_count).length > 0 ) {
                    $(yith_wcan.result_count).html( $(response).find(yith_wcan.result_count).html()).show();
                }


                //load new widgets
                $('.yith-woo-ajax-navigation').each(function(){
                    var id = $(this).attr('id');
                    $(this).html( $(response).find('#'+id).html() );

                    if( $(this).text() == '' ) {
                        $(this).hide();
                    } else {
                        $(this).show();
                    }
                });

                //update browser history (IE doesn't support it)
                if ( !navigator.userAgent.match(/msie/i) ) {
                    window.history.pushState({"pageTitle":response.pageTitle},"", href);
                }

                //trigger ready event
                $(document).trigger("ready");
                $(document).trigger("yith-wcan-ajax-filtered");
            }

        });
    });

    /*AJAX NAVIGATION DROPDOWN STYLE*/

    function yit_open_select_dropdown(element){

        $(element).parent().find('div.yith-wcan-select-wrapper').css("z-index", "1").animate({

            visibility: "visible",
            opacity: 1


        }, 300);

        $(element).parent().find('a.yit-wcan-select-open').addClass('active');
    }

    function yit_close_select_dropdown(element){

        $(element).parent().find('div.yith-wcan-select-wrapper').css("z-index", "-1").animate({

            visibility: "hidden",
            opacity: 0

        }, 300);

        $(element).parent().find('a.yit-wcan-select-open').removeClass('active');
    }

    var yit_hidden_filters_wrapper = function () {

        $('div.yith-wcan-select-wrapper').animate({

            visibility: "hidden",
            opacity: 0

        }, 0);

        $('a.yit-wcan-select-open').removeClass('active');
    }

    var yit_active_filter = function() {

        var filter_number = $('div.yith-wcan-select-wrapper ul.yith-wcan-select li.chosen').length;

        yit_hidden_filters_wrapper();

        $('div.yith-wcan-select-wrapper').each(function() {

            var filter_name="";
            var chosen =  $(this).find('ul.yith-wcan-select li.chosen').each(function(){
                filter_name += $(this).text() + ', ';
            });

            filter_name = filter_name.substring(0, filter_name.length - 2);

            if(filter_name != "") {
                $(this).parent().find('a.yit-wcan-select-open').text(filter_name);
            }
       })
    }

    $(document).on('click' , 'a.yit-wcan-select-open.active' , function(e) {
        e.preventDefault();
        yit_close_select_dropdown(this);
    });

    $(document).on('click' , 'a.yit-wcan-select-open:not(.active)' , function(e) {
        e.preventDefault();
        yit_open_select_dropdown(this);
    });

    $(document).on('ready yith-wcan-ajax-filtered', yit_active_filter);

    $(document).on('ready', yit_hidden_filters_wrapper );

    $('body').on('click', function(e){

        if( !$(e.target).hasClass('yit-wcan-select-open') ) {
            yit_hidden_filters_wrapper();
        }

    });

});
