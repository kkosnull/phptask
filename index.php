
<head>
 <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<div class="container" id="insertBlock">  
 
  <form id="contact">
    <label class="switch">
  <input type="checkbox" id="switch" checked>
  <span class="slider"></span>
</label>
    <h3 id="formActionShow" style="float:right;">Insert data</h3>
   <fieldset>
      <input placeholder="Email address" type="text" tabindex="1" name="email" id="email"  autofocus>
    </fieldset>
     <fieldset>
      <input placeholder="Name" type="text" tabindex="1" name="name"  id="name" autofocus>
    </fieldset>
     <fieldset>
      <input placeholder="Subject" type="text" tabindex="1" name="subject" id="subject" autofocus>
    </fieldset>
     <fieldset>
      <input placeholder="Body" type="text" tabindex="1" name="body" id="body" autofocus>
    </fieldset>
    
    <fieldset>
      <button name="submit" type="submit" id="contact-submit" data-submit="...Sending">Submit</button>
    </fieldset>
  
 <h2 id="response"></h2>
  </form>


</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
  // Variable to hold request
var request;
$('#switch').click(function() {
if ($('#switch').is(":checked"))
{
  $("#formActionShow").html("Insert data");
  $("body").css("background-color", "#61a8e0");
}
else
{
$("#formActionShow").html("Search data");
$("body").css("background-color", "#4CAF50");
}
});

// Bind to the submit event of our form
$("#contact").submit(function(event){

    // Prevent default posting of form - put here to work in case of errors
    event.preventDefault();
   if (request) {
        request.abort();
    }
    // setup some local variables
    var $form = $(this);
    var $inputs = $form.find("input, select, button, textarea");
    var serializedData = $form.serialize();
    $inputs.prop("disabled", true);

     if ($('#switch').is(":checked"))
        {
          
            request = $.ajax({
            url: "phpFunctions/insert.php",
            type: "post",
            data: serializedData
          });
        }
   else
   
    {
       
            request = $.ajax({
            url: "phpFunctions/search.php",
            type: "post",
            data: serializedData
          });
   }

    // Callback handler that will be called on success
    request.done(function (response, textStatus, jqXHR){
        // Log a message to the console, and send it to page
        console.log(response);
        $("#response").html(response);
        if (response.includes("email error"))
        {
            $("#email").css("background-color", "red");
            setTimeout(function(){ $("#email").css("background-color", "white"); }, 2000);
        }
        else 
        {
          $("#email").css("background-color", "white");
        }
    });

    // Callback handler that will be called on failure
    request.fail(function (jqXHR, textStatus, errorThrown){
        // Log the error to the console
        console.error(
            "The following error occurred: "+
            textStatus, errorThrown
        );
    });

    // Callback handler that will be called regardless
    // if the request failed or succeeded
    request.always(function () {
       console.log(serializedData);
        $inputs.prop("disabled", false);
    });

});
</script>
