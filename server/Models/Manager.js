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

    select(where, callback) {
        connection.query('SELECT * FROM ' + this.table + ' WHERE ' + Object.keys(where).map(e => e + " = ?").join(" "), Object.values(where), (error, results) => {
            if (error) throw error;
            callback(results);
        });
    }

    insert(values) {
        connection.query('INSERT INTO ' + this.table + ' (' + Object.keys(where).join(" ") + ") VALUES (" + Object.keys(where).map(e => "?").join(" ") + ")", Object.values(values), (error, results) => {
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
