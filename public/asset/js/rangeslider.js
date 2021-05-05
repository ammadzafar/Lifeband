$(document).on('change','.range', function(){
    console.log($(this).val());
    if($(this).val() > 20){
        $(this).addClass('ltpurple');
    }
    if($(this).val() > 40){
        $(this).addClass('purple');
    }
    if($(this).val() > 60){
        $(this).addClass('pink');
    }

    // if($(this).val() > 20){
    //     $(this).addClass('bg1');
    // }
    // if($(this).val() > 40){
    //     $(this).addClass('bg2');
    // }
    // if($(this).val() > 60){
    //     $(this).addClass('bg3');
    // }

});

$(document).on('change','.at-colortwo .range', function(){
    console.log($(this).val());
    if($(this).val() > 33){
        $(this).addClass('bg1');
    }
    if($(this).val() > 66){
        $(this).addClass('bg2');
    }
    if($(this).val() > 100){
        $(this).addClass('bg3');
    }

});
$(document).on('change','.at-spotwocontent .range', function(){
    console.log($(this).val());
    if($(this).val() > 20){
        $(this).addClass('bg1');
    }
    if($(this).val() > 40){
        $(this).addClass('bg2');
    }
    if($(this).val() > 60){
        $(this).addClass('bg3');
    }
    if($(this).val() > 80){
        $(this).addClass('bg4');
    }

});
// $(document).on('change','.at-range', function(){
//     console.log($(this).val());
//     // if($(this).val() < 20){
//     //     $(this).addClass('at-red1');
//     // }
//     if($(this).val() > 20){
//         $(this).addClass('at-yellow1');
//     }
//     if($(this).val() > 40){
//         $(this).addClass('at-green1');
//     }
//     if($(this).val() > 60){
//         $(this).addClass('at-yellow2');
//     }
//     if($(this).val() > 80){
//         $(this).addClass('at-red2');
//     }
// })