var socket = io('http://sgc.local:5000');
socket.on('simple:login', function (data) {
    $('#navigation-username').text(data.username);
});
