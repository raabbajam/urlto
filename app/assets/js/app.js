$(function(){
  var theForm = document.getElementById( 'url-form' );
  theForm.setAttribute( "autocomplete", "off" );
  $('.final-message').click(function(e){
    e.preventDefault();
    $('.final-message').hide().addClass('hide').removeClass('show');
    $('.simform-inner').show('slow', function(){
      $(this).addClass('show').removeClass('hide');
      $('#to').val('');
    });
  });
  var fForm = new stepsForm( theForm, {
    onSubmit : function( form ) {
      classie.addClass( theForm.querySelector( '.simform-inner' ), 'hide' );
        var $form = $(form),
          data = $form.serialize();
        $.post('/', data, function(data){
          var message = "",
            message2 = "",
            notice;
          if(data.error){
            for (var key in data.message) {
              if (data.message.hasOwnProperty(key)) {
                message += data.message[key];
              }
            }
            notice = "error";
          } else {
            var to = data.data.to.indexOf('://') > 0 ? data.data.to : 'http://' + data.data.to;
            message = "Here it comes. Your shortened url";
            message2 = "Here\'s your shortened url: <a href='"+ to +
              "'>http://url.to/" + data.data.from +
              "</a><p><a href='javascript:void(0)'>add another url?</a></p>";
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
          var messageEl = document.querySelector( '.final-message' );
          messageEl.innerHTML = message2;
          classie.addClass( messageEl, 'show' );
          var $last = $('.last-urls'),
            $url = $('p', $last),
            total = parseInt($('.url-total').html(), 10) || 10,
            count = $url.length;
          if (count >= total) {
            $('p:last-child').hide('slow', $('p:last-child').remove());
          } else {
            $('.url-total').html(total + 1);
          }
          $('<p><a href="'+data.data.to+'">http://url.to/'+data.data.from+'</a> <small>('+data.data.moment+')</small></p>').prependTo($last);
        });
      return false;
    }
  });
});
