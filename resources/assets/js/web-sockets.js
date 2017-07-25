require('./bootstrap');

import Echo from "laravel-echo";

window.Echo = new Echo({
  broadcaster: 'socket.io',
  host: 'localhost:6001'
});

$(document).ready(function () {

  if (window.userId) {
    window.Echo.channel('user.' + window.userId)
      .listen('ChatMessageWasReceived', (e) => {
        let newMessage = `<div class="row">`;
        newMessage += e.message.from_user_id == window.userId ? `<div class="col-xs-1 chat-msg name your-chat-msg">You:</div>` : `<div class="col-xs-1 chat-msg name">${e.message.from_user_id}:</div>`;
        newMessage += `<div class="col-xs-11">${e.message.body}</div>`;
        newMessage += `</div>`;
        $('[data-chat]').append(newMessage);
      });
  }

  $('#message').on('submit', function(e) {
    e.preventDefault();
    $('#errorMsg').remove();
    $.ajax({
      type: "POST",
      url: window.requestUrl,
      data: $(this).serialize(),
      success: () => {
        $(this).find("input[type=text], textarea").val("");;
      },
      error: ( msg ) => {
        let errorMsg = `<div class="row has-error" id="errorMsg">
                                <div class="col-sm-10">
                                    <div class="alert alert-danger">
                                        <strong>Danger! </strong>${msg.responseJSON.body[0]}
                                    </div>
                                </div>
                            </div>`;
        $('[data-chat]').parent().append(errorMsg);
      }
    });
  });

});