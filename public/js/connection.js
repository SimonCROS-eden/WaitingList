let socket = io.connect('localhost:82');

socket.emit("test", {content: "culcul"});

socket.on('reponseTest', function(message) {
    console.log(message.content);
});
