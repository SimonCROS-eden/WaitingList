import socket from "socket.io";
import session from "express-session";
import Server from "./Server.js"

export default class SocketServer extends Server {

    constructor(port) {
        super(port);

        this.io = socket(this.server);

        let sessionMiddleware = session({
            secret: "WaitingList@2020",
            resave: true,
            saveUninitialized: true
        });
        this.app.use(sessionMiddleware);
    }
}
