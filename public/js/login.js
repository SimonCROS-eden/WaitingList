$("#login").click(() => {
    socket.emit("login", {
        email: $("#l_email").val(),
        password: $("#l_password").val()
    });
});

$("#register").click(() => {
    socket.emit("register", {
        first: $("#r_first").val(),
        last: $("#r_last").val(),
        email: $("#r_email").val(),
        password: $("#r_password").val(),
        password_repeat: $("#r_password_repeat").val()
    });
});

socket.on("logged_in", (data) => {
    console.log(data);
});

socket.on("error", (data) =>{
    console.log(data);
});
