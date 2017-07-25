/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import Echo from "laravel-echo";

window.Echo = new Echo({
  broadcaster: 'socket.io',
  host: 'localhost:6001'
});

$(document).ready(function () {
  if (window.userId) {
    window.Echo.channel('user.'+window.userId)
      .listen('ChatMessageWasReceived', (e) => {
        console.log($('[data-chat]'));
        console.log(e.message.body);
      });
  }

    //Event for display active/disabled posts
  $('.panel-heading').find('input').click(function () {
    window.location.replace(`/posts?active=${$('.panel-heading').find('input').val() == 1 ? 0 : 1}`);
  });

  //Event to display the downloading file
  $(document).on('change', ':file', function () {
    var label = $(this).val().replace(/\\/g, '/').replace(/.*\//, ''),
      input = $(this).parents('.input-group').find(':text'),
      log = label;

    if (input.length) {
      input.val(log);
    } else {
      if (log) alert(log);
    }

  });

});