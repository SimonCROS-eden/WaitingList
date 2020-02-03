import Command from "./Command.js";
import UserManager from "../Models/UserManager.js";
import UserModel from "../Models/UserModel.js";
import Status from "../Status.js";

export default class OnRegister extends Command {

    async on(command, sender, data) {
        let first_name = data.first,
        last_name = data.last,
        email = data.email,
        password = data.password,
        password_repeat = data.password_repeat;

        if (password == password_repeat) {
            let pass = await UserManager.hash(password);
            let user = new UserModel(first_name, last_name, email, Status.DENY, pass);
            let manager = new UserManager();
            manager.registerUser(user, () => {
                
            });
        }
    }
}
