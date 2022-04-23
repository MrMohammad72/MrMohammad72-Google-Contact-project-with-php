
 var baseUrl = 'http://localhost/';
 $(document).ready(function() {

     //Ajax Request
     $("#state").click(function(e) {
         var thisElement = $(this);
         var reqUrl = baseUrl + "ajax.php?action=eu";
         var resultTag = $('#ajax-result');

         $.ajax({
             type: 'POST',
             url: reqUrl,
             data: {
                 qmStr: thisElement.val()
             },
             success: function(response) {
                 resultTag.html(response);
             },
             error: function(xhr, status, error) {

             }
         });
     });

     $("#edit").click(function(e) {
         var thisElement = $(this);
         var reqUrl = baseUrl + "ajax.php?action=eu";
         /*   var resultTag = $('#ajax-result'); */

         $.ajax({
             type: 'POST',
             url: reqUrl,
             data: {
                 qmStr: $('.edit').attr('id')
             },
             success: function(response) {
                 /*     resultTag.html(response); */
             },
             error: function(xhr, status, error) {

             }
         });
     });


 });

 function myFunction() {
    var x = document.getElementById("sidebar");
    if (x.className === "sidebar") {
        x.className += " responsive";
    } else {
        x.className = "sidebar";
    }
}

var baseUrl = 'http://localhost/';
$(document).ready(function() {

    //Ajax Request
    $("#state").click(function(e) {
        var thisElement = $(this);
        var reqUrl = baseUrl + "ajax.php?action=sc";
        var resultTag = $('#ajax-result');

        $.ajax({
            type: 'POST',
            url: reqUrl,
            data: {
                qmStr: thisElement.val()
            },
            success: function(response) {
                resultTag.html(response);
            },

        });

    });
});