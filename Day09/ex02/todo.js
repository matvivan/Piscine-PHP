var ft_list = document.getElementById("ft_list");
var i = -1;

function del() {
    if (confirm("You want to remove that TO DO ?"))
        this.parentElement.removeChild(this);
}

function set(val) {
    ++i;
    var tmp = document.createElement("div");
    tmp.innerHTML = val;
    tmp.onclick = function () {
        if (confirm("You want to remove that TO DO ?"))
            this.parentElement.removeChild(this);
    };
    ft_list.insertBefore(tmp, ft_list.childNodes[0]);
}

function recover(str) {
    set(str.substr(str.lastIndexOf('=') + 1));
}

document.cookie.split(";").forEach(recover);

function add() {
    var todo = prompt("TODO");
    if (todo !== "") {
        set(todo);
        console.log("length = " + ++i);
        document.cookie = i + "=" + todo;
    }

}