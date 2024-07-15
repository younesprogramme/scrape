const express = require('express');
const app = express();
const http = require('http');
const server = http.createServer(app);
const fs = require('fs');
const readFileSync = require('fs');
// var redis = new Redis();

const io = require("socket.io")(server, {
    cors: {
        origin: "*"
    }
});

app.get('/', (req, res) => {
    // console.log('res');
    // console.log( 'received webhook', req );
    // res.send('Hello World!');
     res.sendFile(__dirname + '/public/somefile.txt');
    // res.sendFile(__dirname + '/api/notification');
    // fs.watch(__dirname + '/public/somefile.txt', function (event, filename) {
    //     fs.readFile(filename, 'utf8', function (err, data) {
    //         if (err) throw err;
    //         console.log('OK: ' + filename);
    //         console.log(data)
    //     });

    //     console.log('event is: ' + event);
    //     if (filename) {
    //         console.log('filename provided: ' + filename);
    //     } else {
    //         console.log('filename not provided');
    //     }
    // });
});
io.on('connection', (socket) => {
    
    socket.emit('user id');
    // console.log('a user connected');
    socket.on('newpost', (data) => {
        console.log(data);
        socket.broadcast.emit('send status', {message : 'finished', userid :data.userid});
        // socket.broadcast.emit('send status', data);
    });
    // socket.on('sendmessageclient', (msg) => {
    //     console.log(msg)
    //     socket.emit('sendmessageclient', msg);
    // });
    fs.watch(__dirname + '/storage/app/somefile.txt', function (event, filename) {
        fs.readFile(__dirname + '/storage/app/somefile.txt', 'utf8', function (err, data) {
            if (err) throw err;
             console.log('OK: ' + filename);
            // console.log(data);
            // console.log('event is: ' + event);
            if (filename) {
                // console.log('filename provided: ' + filename);
                socket.emit('sendmessageclient', data);
            } else {
                console.log('filename not provided');
            }
        });

    });
});

server.listen(3000, () => {
    console.log('Server is running');
});
