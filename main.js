/* global $ */

$(document).ready(function(){
    //Navigate with navbar
    $("#navbar ul li a").on("click", function(event){
        event.preventDefault();
        
        var page = $(this).attr("href");
        
        if (page == "regis.html"){
            $("#main").load(page);
            $("#navbar").show();
        }
        else{
            $("#main").load(page);
            $("#navbar").show();
        }
        
        event.preventDefault();
        $(this).closest('li').addClass('active').siblings().removeClass('active');
    });
    
    
    //login
    $("#logBtn").on('click', function(event){
        
        event.preventDefault();
        
        var name = $("#usname").val();
        var pass = $("#pass").val();
        
        var link = 'general_control.php';
        
        var params = "logname="+name+"&logpass="+pass;
        
        var xmlhttp = new XMLHttpRequest();
        
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4){
                    if (this.status == 200) {
                        //make correct navbar visible if successful login
                        if (xmlhttp.responseText == "User Found"){
                            $("#navbar").hide();
                            $("#rep_navbar").show();
                            $("#main").load("report.html");
                        }
                        else{
                            $("#status").text("User Info Not Found! Check Login Info!");
                        }
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
});