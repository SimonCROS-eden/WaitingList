import SocketServer from "./Server/SocketServer.js";
import DatabaseConnection from "./DatabaseConnection.js";
import OnTest from "./Commands/OnTest.js";
import OnLogin from "./Commands/OnLogin.js";
import OnRegister from "./Commands/OnRegister.js";

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

        this.server.registerCommand("test", new OnTest());
        this.server.registerCommand("login", new OnLogin());
        this.server.registerCommand("register", new OnRegister());
    }

    static getInstance() {
        return WaitingList.#instance;
    }

    getDatabase() {
        return this.database;
    }
}
