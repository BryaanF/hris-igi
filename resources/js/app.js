// import jquery
import $ from "jquery";
window.$ = $;
// import bootstrap javascript from file bootstrap.js
import "./bootstrap";
// import datatables component
import "datatables.net-bs5";
import "datatables.net-buttons-bs5";
// make sure folder assets inside resource can be accessed through vite
import.meta.glob(["../assets/**"]);
