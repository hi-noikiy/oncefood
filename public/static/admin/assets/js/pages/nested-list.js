var output;
$(document).ready(function(){
	var updateOutput = function(e)
    {
        var list   = e.length ? e : $(e.target),
            output = list.data('output');
        if (window.JSON) {
            output.val(window.JSON.stringify(list.nestable('serialize')));//, null, 2));
        } else {
<<<<<<< HEAD
            output.val('JSON browser support required for this ydemo.');
=======
            output.val('JSON browser support required for this demo.');
>>>>>>> yzw
        }
    };

    // activate Nestable for list 1
    $('#nestable').nestable({
        group: 1
    }).on('change', updateOutput);

    $('#nestable2').nestable().on('change', updateOutput);
    updateOutput($('#nestable').data('output', $('#nestable-output')));
    updateOutput($('#nestable2').data('output', $('#nestable2-output')));
})