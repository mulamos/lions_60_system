/*global $*/
$(document).ready(function(){
    
    $('input[name=host_country]').click(function(){
        if($(this).attr("value")=="Yes") {
            $(".airline_option").hide();
        }
        if($(this).attr("value")=="No") {
            $(".airline_option").show();
        }
    });

    // Registration Form Submission
    $("form #wf-form").on('submit', function(event){
        event.preventDefault();
        
        var fname = $("#fname").val();
        var midinit = $("#middleinit").val();
        var lname = $("#lname").val();
        var gender = $("#gender_radio").val();
        var club = $("#club").val();
        var position = $("#position").val();
        var country = $("#country").val();
        var email = $("#email").val();
        var cell = $("#cell").val();
        var tel = $("#tel").val();
        var ishost = $("#host_country").val();
        var aD = $("#arrival_date").val();
        var aT = $("#arrival_time").val();
        var aA = $("#a_airline").val();
        var dD = $("#dep_date").val();
        var dT = $("#dep_time").val();
        var dA = $("#d_airline").val();
        var rate = $("#roomrate").val();
        
        var params = 'submit=Submit&fname='+fname+'&middle_initial='+midinit+'&lname='+lname+'&gender_radio='+gender+'&club='+club+'&position='+position+'&country='+
        country+'&email='+email+'&cell='+cell+'&tel='+tel+'&host_country='+ishost+'&arrival_date='+aD+'&arrival_time='+aT+'&arr_airline='+aA+'&dep_date='+
        dD+'&dep_time='+dT+'&dest_airline='+dA+'&roomrate='+rate;
        
        var link = 'general_control.php';
        
        var xmlhttp = new XMLHttpRequest();
        
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 || this.readyState == "complete"){
                    if (this.status == 200) {
                        if (xmlhttp.responseText == "Registered Successfully"){
                            $("#result").text("Registered Successfully");
                        }
                        else{
                            $("#result").text("OOPS! Something went wrong with your submission");
                        }
                    }
                    else{
                        $("#result").text("Some Unknown Error Occured");
                    }
            }
        };
        xmlhttp.open("POST", link, true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send(params);
    });
});
