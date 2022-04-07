$.ajaxSetup({
    type: 'POST', 
    dataType: 'html', 
    beforeSend: function(){ 
      console.debug('Запрос отправлен. Ждите ответа.');
    },
    error: function(req, text, error){ 
      console.error('Упс! Ошибочка: ' + text + ' | ' + error);
    },
    complete: function(){ 
      console.debug('Запрос полностью завершен!');
    }
});


$("#form").on("submit", function(e){
  e.preventDefault()
  var $that = $(this)
  formData = new FormData($that.get(0));
  console.log(formData)
	$.ajax({
    url: 'core/handler.php',
    processData: false,
    contentType: false,
    cache:false,
    data : formData,
    beforeSend: function() {
      $('#loader').css('display', 'flex')
      $("#bnt-submit").prop("disabled",true);
      $("#bnt-submit").css('cursor', 'progress');
    },
    success: function(data){
      $('#loader').css('display', 'none')
      $('#message').css('display', 'flex')
      $('#message').html(data)
      $("#bnt-submit").prop("disabled",false)
      $("#bnt-submit").css('cursor', 'pointer')
      // setInterval(() => $('#message').css('display', 'none'), 6000)
    }
	});
});

$("#form-preset").on("submit", function(e){
  e.preventDefault()

  $.ajax({
		url: 'core/presetHandler.php',
		method: 'post',
		dataType: 'html',
		data: $(this).serialize(),
		success: function(data){
      $('#messageGet').css('display', 'flex')
			$('#messageGet').html(data)
		}
	});
});

$('#messageGet').on('click', function(){
  setInterval(() => $('#messageGet').css('display', 'none'), 1000)
})
