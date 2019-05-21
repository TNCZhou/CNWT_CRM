    $('#checkall').on('click',function(){
        if($(this).is(':checked')){
            $(this).parents('.am-table').find('td>input[type=checkbox]').prop("checked",true);
        }else{
            $(this).parents('.am-table').find('td>input[type=checkbox]').prop("checked",false);
        }
    });
    $('.am-table td>input[type=checkbox]').on('click',function(){
        if($('#checkall').is(':checked')){
            $('#checkall').prop("checked",false);
        }
    })
    // ==========================
    // 侧边导航下拉列表
    // ==========================

    $('.tpl-left-nav-link-list').on('click', function() {
        $(this).siblings('.tpl-left-nav-sub-menu').slideToggle(80)
            .end()
            .find('.tpl-left-nav-more-ico').toggleClass('tpl-left-nav-more-ico-rotate');
    })
    // ==========================
    // 头部导航隐藏菜单
    // ==========================

    $('.tpl-header-nav-hover-ico').on('click', function() {
        $('.tpl-left-nav').toggle();
        $('.tpl-content-wrapper').toggleClass('tpl-content-wrapper-hover');
    })


