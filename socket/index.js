var express = require('express');
var app = express();
var http = require('http').Server(app);
var io = require('socket.io')(http, {
    cors: {
        origin: "http://localhost:8000"
    }
});

var moment = require('moment');
var mysql = require('mysql');
var sockets = {};
var con = mysql.createConnection({
    host: 'localhost',
    user: 'root',
    password: '',
    database: 'simplechat'
});


con.connect(function (err) {
    if (err)
        throw err;
    console.log("Database Connected");
});

io.on('connection', function (socket) {
    if (!sockets[socket.handshake.query.user_id]) {
        //sockets[socket.handshake.query.user_id].push(socket);
        sockets[socket.handshake.query.user_id] = [];
    }
    sockets[socket.handshake.query.user_id].push(socket);

    socket.broadcast.emit('user_connected', socket.handshake.query.user_id);

    // Get the connection to database and make an update to the users table
    con.query(`UPDATE users SET is_online = 1 WHERE id=${socket.handshake.query.user_id}`, function (err, res) {
        if (err)
            throw err;
        console.log("User Connected", socket.handshake.query.user_id);
    });

    socket.on('send_message', function (data) {
        console.log(data.user_id);
        var group_id = (data.user_id > data.other_user_id) ? data.user_id + data.other_user_id : data.other_user_id + data.user_id;
        var time = moment().format("h:mm A");
        data.time = time;

        con.query(`INSERT INTO chats (user_id,other_user_id,message,group_id)
                    values(${data.user_id},${data.other_user_id},'${data.message}',${group_id})`, function (err, res) {
            if (err)
                throw err;
            console.log("Message Sent");


            data.id = res.insertId;

            for (var index in sockets[data.user_id]) {
                sockets[data.user_id][index].emit('receive_message', data);
            }
            con.query(`SELECT COUNT(id) as unread_messages from chats where user_id=${data.user_id}
                        and other_user_id=${data.other_user_id} and is_read=0`, function (err, res) {
                if (err)
                    throw err;

                //console.log("query", res[0]);
                data.unread_messages = res[0].unread_messages;

                for (var index in sockets[data.other_user_id]) {
                    sockets[data.other_user_id][index].emit('receive_message', data);
                }
            })

        })
    });

    socket.on('read_message', function (id) {
        con.query(`UPDATE chats set is_read=1 WHERE ID=${id}`, function (err) {
            if (err)
                throw err;
            console.log("Message read");
        })
    });

    socket.on('disconnect', function (err) {
        socket.broadcast.emit('user_disconnected', socket.handshake.query.user_id);
        for (var index in sockets[socket.handshake.query.user_id]) {
            if (socket.id == sockets[socket.handshake.query.user_id][index].id) {
                sockets[socket.handshake.query.user_id].splice(index, 1);
            }
        }
        con.query(`UPDATE users set is_online = 0 Where id= ${socket.handshake.query.user_id}`, function (err, res) {
            if (err)
                throw err;
            console.log("User Disconnected", socket.handshake.query.user_id);
        });
    })

});

http.listen(3000); //listen to socket server
