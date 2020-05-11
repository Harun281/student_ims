
$(document).ready(function(){
    $("#drp1").hide();
    $(".dpChange").slideUp();
    $(".editform").slideUp();

    $("#fees").click(function(){
        $("#drp1").slideToggle();
    });
    $("#drp2").hide();
    $("#exam").click(function(){
        $("#drp2").slideToggle();
    });
    $("#drp3").hide();
    $("#academics").click(function(){
        $("#drp3").slideToggle();
    });

    
    $(".closebtn").click(function(){
        $("#drp1").hide();
        $("#drp2").hide();
        $("#drp3").hide();
    });

    $("#dpChange").click(function(){
        $(".dpChange").slideToggle();
    });

    //show edit profile
    $("#edit").click(function(){
        $(".edit").slideUp();
        $(".editform").slideDown();
    })
    $("#editCancel").click(function(){
        $(".edit").slideDown();
        $(".editform").slideUp();
    })

    });


//scripts
