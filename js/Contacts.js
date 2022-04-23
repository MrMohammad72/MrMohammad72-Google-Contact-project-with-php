
  var baseUrl = 'http://localhost/';
  $(document).ready(function() {

      var form = $("#searchForm");

      var reqUrl = baseUrl + "ajax.php?action=su";
      var resultTag = $("#ajax-result");
      form.submit(function(event) {
          event.preventDefault()
          $.ajax({
              type: 'POST',
              url: reqUrl,
              data: {
                  suStr: $("#searchName").val()
              },
              success: function(response) {
                  resultTag.html(response);
              },

          });
      })

  });