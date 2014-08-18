$(function(){
  var form = $('#url-form');
  form.submit(function(e){
    e.preventDefault();
    var to = $('#to').val(),
      data = {to: to};
      console.log(data);
      console.log(to);
    $.post('/', data, function(data){
      var message = "",
        notice = "";
      if(data.error){
        for (key in data.message) {
          if (data.message.hasOwnProperty(key)) {
            message += data.message[key];
          }
          
        };
        notice = "error";
      } else {
        var to = data.data.to.indexOf('://') > 0 ? data.data.to : 'http://' + data.data.to;
        message = "This is your shortened url: <a href='"+ to +
          "'>http://url.to/" + data.data.from + "</a>";
        notice = "notice";
      }
      var notification = new NotificationFx({
				message : '<span class="icon icon-megaphone"></span><p>'+message+'</p>',
				layout : 'bar',
				effect : 'slidetop',
				type : notice,
				onClose : function() {
					// bttn.disabled = false;
				}
			});
			notification.show();
    });
    return false;
  });
});
