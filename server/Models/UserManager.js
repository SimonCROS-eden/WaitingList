export default class UserManager {

    getUserByUsername(email) {
        this.query("SELECT * FROM user WHERE user.email = :email GROUP BY role.id", ["email" => email]);
    }

    registerUser(user) {
        this.insert("user", ["email" => user.getEmail(),
            "email" => user.getUsername(),
            "role_id" => user.getRole(),
            "password" => user.getPassword()]);
        return this.getUserByEmail(user.getEmail());
    }

    update(user) {
        this.updateWhere("user", ["role_id" => user.getRole()], ["id" => user.getId()]);
    }

    getUsers() {
        return this.query("SELECT * FROM user");
    }
}
