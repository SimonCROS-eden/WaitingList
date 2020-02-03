export default class Connection {

    constructor(socket) {
        this.socket = socket;

        var address = socket.request.connection.remoteAddress;
        this.address = address;
    }

    getAddress() {
        return this.address;
    }

    getSocket() {
        return this.socket;
    }

    registerCommand(command, clazz) {
        this.getSocket().on(command, (data) => {
            clazz.on(command, this, data);
        });
    }

    onDisconnect(callback) {
        this.getSocket().on('disconnect', () => {
            callback(this);
        });
    }

    send(command, data) {
        this.socket.emit(command, data);
    }

    broadcast(command, data) {
        this.socket.broadcast.emit(command, data);
    }
}
