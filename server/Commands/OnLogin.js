import Command from "./Command.js";
import UserManager from "../Models/UserManager.js";
import UserModel from "../Models/UserModel.js";

export default class OnLogin extends Command {

    async on(command, sender, data) {
        let email = data.email,
        password = data.password;

        let manager = new UserManager();
        let user = await manager.getUser(email);
        console.log(user);
        if (user && await UserManager.compare(password, user.getPassword())) {
            console.log("Logged in !");
        }
        // if (password == password_repeat) {
        //     let pass = ;
        //     let user = new UserModel(first_name, last_name, email, Status.DENY, pass);
        //     let manager = new UserManager();
        //     manager.registerUser(user, () => {
        //
        //     });
        // }
    }
}
