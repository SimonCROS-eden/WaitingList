import mysql from "mysql";

export default class DatabaseConnection {

    database = null;

    constructor(config) {
        this.database = mysql.createConnection({
          host: config.host,
          user: config.user,
          password: config.password,
          database: config.base
        });
    }

    connect(callback) {
        this.database.connect(function (error) {
            if (!!error) {
                throw error;
            }
            callback();
        });
    }

    getDatabase() {
        return this.database;
    }
}
