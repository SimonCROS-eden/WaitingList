import socket from "socket.io";
import session from "express-session";
import Server from "./Server.js"

export default class SocketServer extends Server {

    constructor(port) {
        super(port);

        this.io = socket(this.server);

        let sessionMiddleware = session({
          secret: "keyboard cat"
        });
        this.io.use(function (socket, next) {
          sessionMiddleware(socket.request, socket.request.res, next);
        });
        this.app.use(sessionMiddleware);
    }
}
