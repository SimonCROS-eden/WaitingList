import Manager from "./Manager.js";
import UserModel from "./UserModel.js";

export default class UserManager extends Manager {

    constructor() {
        super("user");
    }

    async getUser(email) {
        let search = await this.select({"email": email});
        if (search && search[0]) {
            let find = search[0];
            return new UserModel(find.first_name, find.last_name, find.email, find.status, find.password);
        }
        return null;
    }

    registerUser(user, callback) {
        this.insert({
            "first_name": user.getFirstName(),
            "last_name": user.getLastName(),
            "email": user.getEmail(),
            "password": user.getPassword()
        }, callback);
    }

    update(user) {
        // this.updateWhere("user", ["role_id" => user.getRole()], ["id" => user.getId()]);
    }

    getUsers() {
        return this.query("SELECT * FROM user");
    }
}
