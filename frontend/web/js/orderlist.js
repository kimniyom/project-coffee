$(document).ready(function () {
    Load();
});

function Load() {
    var url = $("#Loadorderlist").val();
    var orderID = $("#orderID").val();
    var data = {orderID: orderID};
    $.post(url, data, function (success) {
        $("#orderlist").html(success);
        Calculator(orderID);
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

function Calculator(orderID) {
    var url = $("#calculator").val();
    var data = {orderID: orderID};
    $.post(url, data, function (response) {
        var datas = jQuery.parseJSON(response);
        $("#total").val(datas.total);
    });
}

function LoadCal() {

}

//ชำระเงิน
function Check_bill() {
    var url = $("#Urlcheckbill").val();
    var orderID = $("#orderID").val();
    var total = $("#total").val();
    var data = {
        orderID: orderID,
        total: total
    };
    $.post(url, data, function (response) {
        window.location.reload();
        //var datas = jQuery.parseJSON(response);
        //$("#total").val(datas.total);
    });
}

//เพิ่มเบอร์โทรศัพท์
function AddTel() {
    var url = $("#Urltel").val();
    var orderID = $("#orderID").val();
    var tel = $("#tel").val();
    if (tel == '') {
        $("#tel").focus();
        return false;
    }
    var data = {
        orderID: orderID,
        tel: tel
    };
    $.post(url, data, function (response) {
        alert("เพิ่มเบอร์โทรศัพท์แล้ว ...");
        $("#tel").val("");
        //var datas = jQuery.parseJSON(response);
    });
}


