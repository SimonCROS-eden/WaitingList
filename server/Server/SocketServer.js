import socket from "socket.io";
import session from "express-session";
import Server from "./Server.js";
import Connection from "./Connection.js";

export default class SocketServer extends Server {

    commands = {};
    connectionCallback = () => {};

    constructor(port) {
        super(port);

        this.io = socket(this.server);

        let sessionMiddleware = session({
            secret: "WaitingList@2020",
            resave: true,
            saveUninitialized: true
        });
        this.app.use(sessionMiddleware);

        this.io.on('connection', (socket) => {
            let connection = new Connection(socket);
            this.connectionCallback(connection);

            for (let [key, value] of Object.entries(this.commands)) {
                connection.registerCommand(key, value);
            }
        });
    }

    registerCommand(command, clazz) {
        this.commands[command] = clazz;
    }

    onConnection(callback) {
        this.connectionCallback = callback;
    }
}
