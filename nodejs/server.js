var app = require('express')();
var fs = require('fs');
const path = require('path');
var dotenv = require('dotenv').config({ path: path.join(__dirname, '../.env') });
var withSSLOrNot = '';
var redis = require('redis');
var port_number = (dotenv.parsed).PORT_NOTIFICATIONS;

if ((dotenv.parsed).HTTPS == 'TRUE') {
    const options = {
        key: fs.readFileSync((dotenv.parsed).SSL_KEY, 'utf8'),
        cert: fs.readFileSync((dotenv.parsed).SSL_CERT, 'utf8'),
        ca: fs.readFileSync((dotenv.parsed).SSL_CA, 'utf8')
    };
    withSSLOrNot = require('https').Server(options, app);
} else
    withSSLOrNot = require('http').Server(app);
var io = require('socket.io')(withSSLOrNot, {
    cors: {
        origin: (dotenv.parsed).APP_URL,
        methods: ["GET", "POST"],
        credentials: true,
        allowedHeaders: ["*"]
    }
});

console.log((dotenv.parsed).HTTPS);

withSSLOrNot.listen(port_number, function () {
    console.log("Listening on " + port_number)
});
io.on('connection', function (socket) {

    console.log("new client connected");
    var redisClient = redis.createClient();
    redisClient.subscribe('message');

    redisClient.on("message", function (channel, data) {
        data = JSON.parse(data);
        if (data.channel == 'notifications')
            socket.emit(channel + '-' + data.channel + '-' + data.user_id, data.data);
        console.log(channel + '-' + data.channel + '-' + data.user_id + "new messages in queue " + data + "channel");
    });

    socket.on('disconnect', function () {
        redisClient.quit();
    });
    socket.on('error', function (err) {
        console.log(err)
    });
});
