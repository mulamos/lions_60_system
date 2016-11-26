/*global $*/
$(document).ready(function(){
    
    //Navigate with navbar
    $("#rep_navbar ul li a").on("click", function(event){

        var logout = function(){
            var xmlhttp = new XMLHttpRequest();
            
            var dat ="logout=true";
        
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4){
                    if (this.status == 200) {
                        window.location.href = "/";
                    }
                }
            };
        
            xmlhttp.open("POST", "general_control.php", true);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send(dat);
        };
        event.preventDefault();
        var page = $(this).attr("href");
        
        if (page == "index.html"){
            logout();
        }
        else if (page == "report.html"){
            $("#main_view").load(page);
            $("#rep_navbar").hide();
            //getreport();
        }
        else{
            $("#main_view").load(page);
            $("#rep_navbar").show();
        }
        
        event.preventDefault();
        $(this).closest('li').addClass('active1').siblings().removeClass('active1');
    });
    
    $("#signupform").on('submit', function(event){
        
        event.preventDefault();
        
        var fname = $("#fname").val();
        var lname = $("#lname").val();
        var uname = $("#uname").val();
        var pword = $("#pword").val();
        var cpos  = $("#cpos").val();
        //var exp = /([A-Z])\w{8,}$/;
        
        /*if (exp.test(pword) == false){
            $("#status").text("Password Must Contain at least a letter, a capital letter, a number and be of at least 8 characters long.");
        }*/
        
        var params = 'firstname='+fname+'&lastname='+lname+'&username='+uname+'&password='+pword+'&cposition='+cpos;
        
        var link = 'general_control.php';
        
        var xmlhttp = new XMLHttpRequest();
        
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4){
                    if (this.status == 200) {
                        $("#status").text("Successfully Added!");
                    }
                    else{
                        $("#status").text("Some Unknown Error Occured");
                    }
            }
        };
        xmlhttp.open("POST", link, true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send(params);
    });
    
    $("#lookup").click(function(){
        
        if ($("#checkbox").is(":checked")) {
            
            getreport();
        }
        else if ($('#id_num').val() != '') {
            
            findbyID($('#id_num').val());
        }
    });
    
    function getreport() {
            var link = 'https://lions-60-system-rand2016.c9users.io/general_control.php?all=true';
            
            $.ajax(link, {
                method: 'GET',
            }).done(function(res){
                $('#result').html(res);
            }).fail(function(fail){
                $('#result').html('<b> PROCESSING ERROR!!</b>');
            });
    }
    
    function findbyID (query) {
        var link = 'https://lions-60-system-rand2016.c9users.io/general_control.php?id_num='+ query;
        
        $.ajax(link, {
            method: 'GET',
        }).done(function(res) {
            $('#result').html(res);
        }).fail(function(fail) {
            $('#result').html('<b> PROCESSING ERROR!!</b>');
        });
    }
});