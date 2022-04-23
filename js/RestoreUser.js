
  var baseUrl = 'http://localhost/Google_contact/';
  $(document).ready(function() {

      var form = $("#restoreUser");

      var reqUrl = baseUrl + "ajax.php?action=resu";
      var resultTag = $("#ajax-result");
      form.submit(function(event) {
          event.preventDefault()
          $.ajax({
              type: 'POST',
              url: reqUrl,
              data: {
                  suStr: $("#resUserId").val()
              },
              success: function(response) {
                  resultTag.html(response);
              },

          });
      })

  });