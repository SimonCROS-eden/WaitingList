import Connection from "./Connection.js";
import SocketServer from "./server/SocketServer.js";

export default class WaitingList {

    static #instance;

    constructor() {
        WaitingList.instance = this;
        this.server = new SocketServer(82);
        this.server.setStaticRoot('./public');

        // Quand un client se connecte, on le note dans la console
        this.server.io.on('connection', function(socket) {
            let newConnection = new Connection(socket);
            newConnection.registerCommand("test", (message, connection) => {
                connection.send("reponseTest", {content: "cucu"});
            });
            socket.on("login", function(data){
                const user = data.user,
                pass = data.pass;
                db.query("SELECT * FROM user WHERE username=?", [user], function(err, rows, fields){
                    if (rows.length == 0) {
                        console.log("nothing here");
                    } else {
                        console.log("here");
                    }
                });
            });
            socket.on("register", function(data){
                const first_name = data.first,
                last_name = data.last,
                email = data.email,
                pass = data.pass,
                pass_repeat = data.pass_repeat;
                db.query("SELECT * FROM user WHERE username=?", [user], function(err, rows, fields){
                    if (rows.length == 0) {
                        console.log("nothing here");
                    } else {
                        console.log("here");
                    }
                });
            });
        });
    }

    static getInstance() {
        return WaitingList.#instance;
    }
}
