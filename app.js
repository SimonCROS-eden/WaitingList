console.log('Demarrage...');

import mysql from "mysql";
import bcrypt from "bcryptjs";

const config = {
  "host": "localhost",
  "user": "root",
  "password": "",
  "base": "waitinglist"
};

var db = mysql.createConnection({
  host: config.host,
  user: config.user,
  password: config.password,
  database: config.base
});

db.connect(function (error) {
  if (!!error)
  throw error;

  console.log('mysql connected to ' + config.host + ", user " + config.user + ", database " + config.base);
});

// -----------------------------------------------------------
import WaitingList from "./server/WaitingList.js";
new WaitingList();

// bcrypt.hash(myPlaintextPassword, saltRounds, function(err, hash) {
//
// })
//     // Store hash in your password DB.
// });
