$("#login").click(() => {
    socket.emit("login", {
        email: $("#lemail").val(),
        password: $("#lpassword").val()
    });
});

$("#register").click(() => {
    socket.emit("register", {
        email: $("#remail").val(),
        password: $("#rpassword").val()
    });
});

socket.on("logged_in", (data) => {
    $("#login-register").hide();
    $("#log_in").html("Salut" + data.name + " !");
    $("#log_in").show();
});

socket.on("error", (data) =>{
    alert(data.error);
});
