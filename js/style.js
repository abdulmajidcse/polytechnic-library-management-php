$(document).ready(function(){

  //add user input field validation
  $("input:not(#liveSearch), select").blur(function(){
    var  input = $(this).val();
    if (input == "") {
      $(this).css("border-color", "red");
    } else {
      $(this).css({"border-color": "#218838"});
    }
  });
  $("input:not(#liveSearch), select,").keyup(function(){
    var input = $(this).val();
    if (input == "") {
      $(this).css("border-color", "red");
    } else {
      $(this).css({"border-color": "#218838"});
    }
  });

  //live search 
	$("#liveSearch").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#liveTable .tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });

  //borrow book person
  $("#person").change(function(){
    var person = $(this).val();
    $.post("loadphp/allforBorrow.php",
      {person:person},
      function(data){
        $("#allUser").html(data);
      });
  });

  //borrow book category and book
  $("#catname").change(function(){
    var catname = $(this).val();
    $.post("loadphp/allforBorrow.php",
      {catname:catname},
      function(data){
        $("#allBook").html(data);
      });
  });

  //overdue fine submit form
  $("#finesubmit").submit(function(){
    var uname = $("#uname").val();
    var email = $("#email").val();
    var totalfine = $("#totalfine").val();

    if (uname == '') {
      $("#unameCheck").css("opacity", "1");
      $("#unameCheck").html("<small>Username must not be empty!</small>");
      
    } if (email == '') {
      $("#emailCheck").css("opacity", "1");
      $("#emailCheck").html("<small>E-mail must not be empty!</small>");
      
    } if (totalfine == '') {
      $("#totalfineCheck").html("<small>Overdue fine(TK) must not be empty!</small>");
      
    } if (uname != '' && email != '' && totalfine != '') {
      $.post("loadphp/finesubmits.php",
        {uname:uname, email:email, totalfine:totalfine},
        function(data){
          $("#finesubmitmsg").html(data);
      });
    }
    return false;
  });

  //fine submit confirm code validation
  $("#finesubmitConfirm").submit(function(){
    var finesubmitCode = $("#finesubmitCode").val();

    if (finesubmitCode == '') {
      $("#finesubmitCodeMsg").html("<small class='text-danger'>Empty code!</small>");
      
    } else {
      $.post("loadphp/finesubmits.php",
        {finesubmitCode:finesubmitCode},
        function(data){
          $("#finesubmitCodeMsg").html(data);
      });
    }
    return false;
  });

  //overdue fine submit form input check
  $("select.unameFine").click(function(){
    var  input = $(this).val();
    if (input != "") {
      $(".unameCheckFine").css("opacity", "0");
    } else {
      $(".unameCheckFine").css("opacity", "1");
      $(".unameCheckFine").html("<small>Username must not be empty!</small>");
    }
  });
  $("input.emailFine").keyup(function(){
    var  input = $(this).val();
    if (input != "") {
      $(".emailCheckFine").css("opacity", "0");
    } else {
      $(".emailCheckFine").css("opacity", "1");
      $(".emailCheckFine").html("<small>E-mail must not be empty!</small>");
    }
  });

  //image modal
  $("img#imgmodal").click(function(){
    var imgsrc = $(this).attr("src");
    $("#modalimg").attr("src", imgsrc);
  });


});



//print out
function pageprint(){
  window.print();
}
//end of print out

//time js
var d = new Date();
document.getElementById("time").innerHTML = d.toLocaleTimeString();

var myTime = setInterval(myTimer, 1000);

function myTimer() {
    var d = new Date();
    document.getElementById("time").innerHTML = d.toLocaleTimeString();
}//end of time js


//back to top scroll
//Get the button
var mybutton = document.getElementById("backtotop");

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}
