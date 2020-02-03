import mysql from "mysql";
import bcrypt from "bcryptjs";
import WaitingList from "../WaitingList.js";

export default class Manager {

    database = WaitingList.getInstance().getDatabase();
    table = "";

    constructor(table) {
        this.table = table;
    }

    getDatabase() {
        return this.database;
    }

    select(where) {
        return new Promise((resolve, reject) => {
            this.database.getDatabase().query('SELECT * FROM ' + this.table + ' WHERE ' + Object.keys(where).map(e => e + " = ?").join(" "), Object.values(where), (error, rows) => {
                if (error) {
                    reject(error);
                    return;
                }
                resolve(rows);
            });
        });
    }

    insert(values, callback) {
        this.database.getDatabase().query('INSERT INTO ' + this.table + ' (' + Object.keys(values).join(", ") + ") VALUES (" + Object.keys(values).map(e => "?").join(", ") + ")", Object.values(values), (error, rows) => {
            if (error) throw error;
            callback();
        });
    }

    static async hash(string) {
        let response = await bcrypt.hash(string, 10);
        return response;
    }

    static async compare(string, hash) {
        let response = await bcrypt.compare(string, hash);
        return response;
    }
}
