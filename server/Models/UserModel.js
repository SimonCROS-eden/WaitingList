export default class UserModel {

    constructor(first_name, last_name, email, status, password) {
        this.first_name = first_name;
        this.last_name = last_name;
        this.email = email;
        this.status = status;
        this.password = password;
    }

    getFirstName() {
        return this.first_name;
    }

    getLastName() {
        return this.last_name;
    }

    getEmail() {
        return this.email;
    }

    getStatus() {
        return this.status;
    }

    getPassword() {
        return this.password;
    }
}
