const http = require('http');
const url = require('url');
const fs = require('fs');
const io = require('socket.io');
const counter = require('./counter');

const server = http.createServer(function(req, res) {
    let path = url.parse(req.url).pathname;

    switch (path) {
        case '/':
            res.writeHead(200, {'Content-Type': 'text/html'});
            res.write('TM Socket.IO');
            res.end();
            break;
        case '/socket.html':
            fs.readFile(__dirname + path, function(err, data) {
                if (err) {
                    res.writeHead(404);
                    res.write('Not found');
                    res.end();
                } else {
                    res.writeHead(200, {'Content-Type': 'text/html'});
                    res.write(data, 'utf8');
                    res.end();
                }
            })
        default:
            res.writeHead(404);
            res.write('Not found');
            response.end();
            break;
    }
});

server.listen(62001);

const listener = io.listen(server);

listener.sockets.on('connection', function(socket) {
    // test
    socket.on('test', function(data) {
        listener.emit('test', data);
    });

    // notification
    socket.on('notification', function(data) {
        listener.emit('notification', data);
    });

    // counter get users
    socket.on('get-users', function(data) {
        counter.getUsers(function(res) {
            listener.emit('users', res);
        });
    });

    // counter get user requests
    socket.on('get-user-requests', function(data) {
        counter.getUserRequests(function(res) {
            listener.emit('user-requests', res);
        });
    });

    // counter get workers
    socket.on('get-workers', function(data) {
        counter.getWorkers(function(res) {
            listener.emit('workers', res);
        });
    });

    // counter count total data
    socket.on('count-total', function(data) {
        counter.getTotal(function(res) {
            listener.emit('total', res);
        });
    });
});
