
$(document).ready(
     //Call them by their names :) if they dont hv parameters
    index
);

function index() {
    CheckZimeBakiNgapi();
    //wekaMaduara();
    KunaKituNajaribBabFeisal();
    AlertBoxByDefault();
    //CheckKamaNumber();
}

function CheckKamaNumber(){
   //imegoma :(
//    $("#mobile").keyup(function(){
//        var val = $(this).val();
//        if(isNaN(val)){
//            val = val.replace(/[^0-9\.]/g,'');
//            if(val.split('.').length>2) val =val.replace(/\.+$/,"");
//        }
//        $(this).val(val);
//    });
}
function AlertBoxByDefault(){
    if($(window).width() > 999){


        $("#wekaKatiAlertBox").animate({marginTop:'150px'})
            .fadeIn(930).delay(200)
            .animate({marginTop:'10px'});
        $("#deliveryReports").delay(2300).slideDown(500);

    }
}


function wekaMaduara(){
//    var check ;
//    $("#mobile").keyup(
//
//        function(){
//            check = $("#mobile").val().length;
//                      if(check==12){
//                      $(this).addClass("tag");
//
//                      }
//
//        }
//    );

}

function CheckZimeBakiNgapi(){
    var max_Chars = 160;
    var no_msg=1;

    var remaining_Chars;
    $('#msg').keyup(function(){
        remaining_Chars = max_Chars - $('#msg').val().length;//length sio jquery


        $('#check').html(no_msg+"/"+remaining_Chars+" of "+ "5");
        if(remaining_Chars<0){
           $("#msg").removeClass("limitError");
           $('#check').html("<span style='color:#343434;font-weight: lighter'>"+
               "You have exceeded "+"<strong>"+(-1)*remaining_Chars+"</strong>"+" characters"+
               "</span>");

        }

        //"("+"<strong>"+(-1)*remaining_Chars+")</strong>"
        if(remaining_Chars < -640){ //800 chars produces 5 msgs
            $('#check').html("<span style='color:darkred;font-weight: lighter'>"+

                "You have reached the limit"+
                "</span>");
            $("#msg").addClass("limitError");

        }



    });


}

function fahad(){
    $(this).hide("slow");
    $(this).delay(2000).show("slow"); // The delay fxn works great
}

/*
 Check call back
 */

function mimi (){
    $(this).slideDown(3000,fahad); // right if no parameter
   // $(this).slideDown(3000,function(){fahad(12,gogo)});//Call it inside an anonimous function if you have multiple params

}




function KunaKituNajaribBabFeisal(){


    function onAddTag(tag) {
        alert("Added a tag: " + tag);
        }
    function onRemoveTag(tag) {
        alert("Removed a tag: " + tag);
        }

    function onChangeTag(input,tag) {
        alert("Changed a tag: " + tag);
        }

    $(function() {

        $('#mobile').tagsInput({width:'auto'});
        $('#tags_2').tagsInput({
        width: 'auto',
        onChange: function(elem, elem_tags)
        {
        var languages = ['php','ruby','javascript'];
        $('.tag', elem_tags).each(function()
        {
        if($(this).text().search(new RegExp('\\b(' + languages.join('|') + ')\\b')) >= 0)
        $(this).css('background-color', 'yellow');
        });
    }
    });
        $('#tags_3').tagsInput({
        width: 'auto',

        //autocomplete_url:'test/fake_plaintext_endpoint.html' //jquery.autocomplete (not jquery ui)
        autocomplete_url:'test/fake_json_endpoint.html' // jquery ui autocomplete requires a json endpoint
        });


    // Uncomment this line to see the callback functions in action
    //			$('input.tags').tagsInput({onAddTag:onAddTag,onRemoveTag:onRemoveTag,onChange: onChangeTag});

    // Uncomment this line to see an input with no interface for adding new tags.
    //			$('input.tags').tagsInput({interactive:false});
    });



}



function engeza(){
    var test =
        '<div class="row">' +
        '<div class="col-lg-6">' +
        '<div class="input-group">' +
        '<label>Name ' +
        '<input type="text" class="form-control"></label>' +
        '</div><!-- /input-group -->' +
        '</div><!-- /.col-lg-6 -->' +
        '<div class="col-lg-6">' +
        '<div class="input-group">' +
        '<label>Phone <input type="number" class="form-control"></label>' +
        '</div><!-- /input-group -->' +
        '</div><!-- /.col-lg-6 -->' +
        '</div><!-- /.row -->' +
        '<br/>';
    $('#populate').append(test);
}