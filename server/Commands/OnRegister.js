import Command from "./Command.js";

export default class OnRegister extends Command {

    on(command, sender, data) {
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
    }
}
