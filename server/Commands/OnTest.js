import Command from "./Command.js";

export default class OnTest extends Command {

    on(command, sender, data) {
        sender.send("reponseTest", {content: "cucu"});
    }
}
