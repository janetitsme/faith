function myFunction(e){

    var timeID =  e.getAttribute("data-id");
    var subject =  e.getAttribute("data-subject");

    
    var id = prompt("Enter your ID");
    var password = prompt("Enter your Password");
   
    //console.log('cell id:' + timeID);
    //window.location="./makebooking.php?id="+timeID+"&username="+id+"&pw="+password;



    // i used jquery ajax to make ajax calls for the appointment booking mechanism.  The user clicks on one of the slot on the
    // html table, this then fires a ajax call to the booking php script (makeBooking.php).

    // the data for the booking is sent to the script through POST which is specified through the ajax method. The response of the booking
    // script is a JSON object, With either "sucess" or "error" as the message.
    // then the approperiate message is displayed to the user as an javascript alert.
    $.ajax({
        method: "POST",
        url: "./makebooking.php",
        data: { id: timeID, pw: password, username: id , subject: subject},
        success: function(data){

            console.log(); //Shows the correct piece of information
            //console.log(response); //Shows the correct piece of information

            if(data.response == "success"){
                console.log("the booking was made..");
                alert(data.response);

                // $('#bleft'+timeID).text('you are stupid!!!');
                var num = Number($('#bleft'+timeID).text());

                console.log(e.parent);


                if(num < 0){


                }else{

                }

                $('#bleft'+timeID).text(""+num - 1);



            }
            else{
                console.log("there was an error!");
                alert(data.response);
            }


        },
        dataType: "json",
        error: function (data) {

        }
    })



}

