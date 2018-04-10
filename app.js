var app = require('http').createServer(handler),
	io = require('socket.io')(app);

app.listen(5000);

function handler (req, res) {
	res.writeHead(200);
	res.end('OK');
}

io.on('connection', function (socket) {
	socket.on('login', function (data) {
		console.log(data);
		socket.emit('login', data);
	});
});
