var app = require('http').createServer(handler),
	io = require('socket.io')(app),
	redis = require("redis"),
	subscriber = redis.createClient(6379, 'localhost'),
	socket;

function handler (req, res) {
	res.writeHead(200);
	res.end('OK');
}

app.listen(5000, function () {
    console.log(`Server is running on port 5000`);
});

io.on('connection', function (sck) {
	socket = sck;
});

subscriber.subscribe("simple:login");

subscriber.on("message", function(channel, message) {
	socket.broadcast.emit(channel, JSON.parse(message));
});

subscriber.on("subscribe", function (channel) {
	console.log("Subscribe channel: "+channel);
});
