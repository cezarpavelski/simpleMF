var socket = io('http://sgc.local:5000');
socket.emit('login', {username: 'Cezar'});
socket.on('login', function (data) {
  $('#navigation-username').text(data.username);
});
