$(document).ready(function () {
    //概况view-overview 看板view-board  列表view-listing  日程表view-calendar 甘特图view-gantt
    $("body").on("click", "a", function () {
        if (check_jump_function($(this))) {
            $("#jump_load").remove();
            $('body').append('<div id="modal-blurpic" style="backdrop-filter: blur(0);background: rgba(0, 0, 0, 0);"></div><div id="jump_load" style="height: 4px;width: 0;background: green;position: absolute;top:75px;z-index:99999"></div>');
            $("#jump_load").animate({width: "50%"}, 1000, function () {
                $(this).animate({width: "100%"}, 20000);
            });
        }
    });

    function check_jump_function(obj) {
        var href = obj.attr("href");
        var target = obj.attr("target");
        //过滤选择跳转
        if (target === "_blank") {
            return false;
        }
        if (obj.hasClass("filter-helper")) {
            return true;
        }
        if (obj.hasClass("js-subtask-toggle-status")) {
            return false;
        }
        if (href && href !== "#" ) {
            var check_modal = obj.attr("class").indexOf("js-modal");
            if(href.indexOf("FileViewerController") !== -1){
                return false;
            }else if(check_modal === -1){
                return true;
            }
        }
        return false;
    }
});