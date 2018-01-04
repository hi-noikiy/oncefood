$(document).ready(function(){
    var i = 0;
    var timer = setInterval(gun,3000);
    function gun(){
        $('#photo img:eq('+ i +')').css('display','block').siblings('img').css('display','none');
        ++i;
        if (i > $('#photo img').length - 1) {
            i = 0;
        }
    }

    $('#banner_left').click(function(){
        clearInterval(timer);
       $('#photo img:eq('+ (i) +')').css('display','block').siblings('img').css('display','none');
       --i;
       if (i < 0) {
            i = $('#photo img').length - 1;
        }
        timer = setInterval(gun,3000);
    });

    $('#banner_right').click(function(){
        clearInterval(timer);
       $('#photo img:eq('+ (i) +')').css('display','block').siblings('img').css('display','none');
       ++i;
       if (i > $('#photo img').length - 1) {
            i = 0;
        }
        timer = setInterval(gun,3000);
    });

    for(var l = $('.item').length - 1; l >=0; l--){
        (function(l){
            $('.item:eq('+ l +')').mouseover(function(){
                clearInterval(timer);
                $('#photo img:eq('+ (l) +')').css('display','block').siblings('img').css('display','none');
                });
            $('.item:eq('+ l +')').mouseout(function(){
               timer = setInterval(gun,3000);
                });
        })(l);
    }
});
