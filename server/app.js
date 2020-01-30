var http = require('http');
var fs = require('fs');
var express = require('express');

console.log('Demarrage...');

var app = express();
app.use(express.static('../public'));

// Chargement du fichier index.html affiché au client
var server = http.createServer(app);

// Chargement de socket.io
var io = require('socket.io').listen(server);
io.set('origins', '*:*');

const Connection = require('./Connection.class.js');

// Quand un client se connecte, on le note dans la console
io.sockets.on('connection', function(socket) {
    let newConnection = new Connection(socket);
});

server.listen(4000, function() {
    console.log('Serveur connecte sur le port 4000');
});
