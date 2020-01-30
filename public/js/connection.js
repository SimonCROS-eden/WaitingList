let socket = io.connect('localhost:4000');

socket.emit("test", {content: "culcul"});

socket.on('reponseTest', function(message) {
    console.log(message.content);
});
