import Command from "./Command.js";

export default class OnLogin extends Command {

    on(command, sender, data) {
        const user = data.user,
        pass = data.pass;
        db.query("SELECT * FROM user WHERE username=?", [user], function(err, rows, fields){
            if (rows.length == 0) {
                console.log("nothing here");
            } else {
                console.log("here");
            }
        });
    }
}
