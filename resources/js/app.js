// import bootstrap javascript from file bootstrap.js
import "./bootstrap";

//import popper
import * as Popper from "@popperjs/core";
window.Popper = Popper;

// import datatables component
import "datatables.net-bs5";
import "datatables.net-buttons-bs5";

// make sure folder assets inside resource can be accessed through vite
import.meta.glob(["../assets/**"]);

// logout confirmation with sweetalert by realrashid
$("#form-logout").on("click", "#logout-button", function (e) {
    e.preventDefault();
    Swal.fire({
        title: "Are you sure want to logout\n" + name + "?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonClass: "bg-primary",
        confirmButtonText: "Yes, I want to logout!",
    }).then((result) => {
        if (result.isConfirmed) {
            $("#form-logout").submit();
        }
    });
});
