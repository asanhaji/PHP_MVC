
function redirect(url) {
    setTimeout(function () {
        window.location.replace(url);
    }, 2100);
}
function delete_click() {
    if (window.confirm('Are you sure you want to delete your account ?')) {
        $("#edit_delete_user_form").submit();
    } else {
        return false;
    }
}
