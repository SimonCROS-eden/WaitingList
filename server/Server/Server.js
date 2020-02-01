import express from "express";
import cookieParser from "cookie-parser";

export default class Server {

    server = null;

    constructor(port) {
        this.app = express();
        this.app.use(cookieParser());
        this.server = this.app.listen(port, () => {
            console.log('Serveur connecte sur le port 82');
        });
    }

    setStaticRoot(root) {
        this.app.use(express.static(root));
    }
}
