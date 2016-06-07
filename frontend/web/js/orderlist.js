$(document).ready(function () {
    Load();
});

function Load() {
    var url = $("#Loadorderlist").val();
    var orderID = $("#orderID").val();
    var data = {orderID: orderID};
    $.post(url, data, function (success) {
        $("#orderlist").html(success);
    });
}

function Save(menu) {
    var url = $("#Saveorderlist").val();
    var orderID = $("#orderID").val();
    var data = {
        order_id: orderID,
        menu: menu
    };
    $.post(url, data, function (success) {
        Load();
    });
}

function Deleteorderlist(id) {
    var r = confirm("คุณแน่ใจหรือไม่ ... ?");
    if (r == true) {
        var url = $("#Deleteorderlist").val();
        var data = {
            id: id
        };
        $.post(url, data, function (success) {
            Load();
        });
    }
}

