const el3 = document.createElement("script");
el3.setAttribute("type", "text/javascript");
el3.setAttribute("src", "https://cdn.jsdelivr.net/gh/Cao0220/D2305@master/js/jquery.js");
document.getElementsByTagName("body")[0].insertAdjacentElement("afterbegin", el3);

var a_idx = 0;
jQuery(document).ready(function($) {
    $("body").click(function(e) {
        var a = new Array("D2305", "五班进攻", "称霸效东", "富强", "文明", "和谐", "自由", "平等", "公正", "法治", "爱国", "敬业", "诚信", "友善", "Welcome", "666");
        var $i = $("<span/>").text(a[a_idx]);
        a_idx = (a_idx + 1) % a.length;
        var x = e.pageX,
            y = e.pageY;
        this.r = Math.floor(Math.random() * 255);
        this.g = Math.floor(Math.random() * 255);
        this.b = Math.floor(Math.random() * 255);
        $i.css({
            "z-index": 99,
            "top": y - 20,
            "left": x,
            "position": "absolute",
            "font-weight": "bold",
            "color": "rgb(" + this.r + "," + this.g + "," + this.b + ")"
        });
        $("body").append($i);
        $i.animate({
                "top": y - 180,
                "opacity": 0
            },
            1500,
            function() {
                $i.remove();
            });
    });
});

const el1 = document.createElement("script");
el1.setAttribute("type", "text/javascript");
el1.setAttribute("src", "https://cdn.jsdelivr.net/gh/Cao0220/D2305@master/live2d/autoload.js");
document.getElementsByTagName("body")[0].insertAdjacentElement("afterend", el1);

const el2 = document.createElement("script");
el2.setAttribute("type", "text/javascript");
el2.setAttribute("color", "rgb(" + this.r + "," + this.g + "," + this.b + ")");
el2.setAttribute("opacity", "0.7");
el2.setAttribute("zIndex", "1");
el2.setAttribute("count", "99");
el2.setAttribute("src", "https://cdn.jsdelivr.net/gh/Cao0220/D2305@master/js/canvas-nest.min.js");
document.getElementsByTagName("body")[0].insertAdjacentElement("afterend", el2);