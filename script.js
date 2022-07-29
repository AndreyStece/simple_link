window.onload = function() {
  console.log('The page has fully loaded');
};

function getShortLink() {
  var data = $('#form').serialize();
  $.ajax({
   type: 'POST',
   url: 'action.php',
   data: data,
   success: function(result) {
    if (Object.keys(result).length) {
      var arr = jQuery.parseJSON(result);
      var link = document.getElementById("short_url");
      var output = document.getElementById("result");
      var message = document.getElementById("alert");

      message.classList.remove('success', 'error');
      if ('error' in arr) {
        message.innerHTML = arr['error'];
        message.classList.add('error');
      } else if ('success' in arr) {
        link.value = arr['solution'];
        output.classList.remove('hidden');
        message.innerHTML = arr['success'];
        message.classList.add('success');
      }
      message.classList.remove('hidden');
    }
   },
   error: function(xhr, str) {
    alert('Возникла ошибка: ' + xhr.responseCode);
   }
  });
}

function copyShortLink() {
  var link = document.getElementById("short_url");
  var message = document.getElementById("alert");

  link.select();
  document.execCommand("copy");
  message.classList.remove('error');
  message.innerHTML = 'Ссылка скопирована';
  message.classList.add('success');
  message.classList.remove('hidden');
}
