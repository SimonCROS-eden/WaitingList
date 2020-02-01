import Connection from "./server/Connection.js";
import SocketServer from "./server/SocketServer.js";
import DatabaseConnection from "./DatabaseConnection.js";

export default class WaitingList {

    static #instance;
    config = {
      "host": "localhost",
      "user": "root",
      "password": "",
      "base": "waitinglist"
    };

    constructor() {
        WaitingList.#instance = this;
        this.server = new SocketServer(82);
        this.server.setStaticRoot('./public');
        this.database = new DatabaseConnection(this.config);
        this.database.connect(() => {
            console.log('mysql connected to ' + this.config.host + ", user " + this.config.user + ", database " + this.config.base);
        });

        // Quand un client se connecte, on le note dans la console
        this.server.io.on('connection', function(socket) {
            let connection = new Connection(socket);
            connection.registerCommand("test", (data, connection) => {
                connection.send("reponseTest", {content: "cucu"});
            });
            connection.registerCommand("login", (data, connection) => {
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
            connection.registerCommand("register", (data, connection) => {
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

    getDatabase() {
        return this.database;
    }
}
