$(document).ready(function () {
    var orderID = $("#orderID").val();
    Calculator(orderID);
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
        Distcount(0);
    });
}

function LoadCal() {

}

//ชำระเงิน
function Check_bill() {
    var url = $("#Urlcheckbill").val();
    var orderID = $("#orderID").val();
    var total = $("#_total").val();
    var distcount = $("#distcount").val();
    var data = {
        orderID: orderID,
        total: total,
        distcount: distcount
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


function Distcount(value) {
    var total = parseInt($("#total").val());
    var distcount = parseInt(value);

    if (value == '') {
        $("#_total").val(total);
    } else {
        var _total = parseInt((total - distcount));
        $("#_total").val(_total);
    }
}

function chkNumber(ele)
{
    var vchar = String.fromCharCode(event.keyCode);
    if ((vchar < '0' || vchar > '9') && (vchar != '.'))
        return false;
    ele.onKeyPress = vchar;
}

//พิมพ์ใบเสร็จ
function Bill() {
    var url = $("#Urlbill").val();
    var orderID = $("#orderID").val();
    var data = {orderID: orderID};
    $.post(url, data, function (datas) {
        //$("#popupbill").modal();
        //PrintElem("#bodybill");
        //$("#bodybill").html(datas);
        Popup(datas);
    });
}

function PrintElem(elem,data)
{
    Popup($(elem).html());
}

function Popup(data)
{
    var mywindow = window.open('', 'my div', 'height=400,width=300');
    mywindow.document.write('<html><head><title>Bill</title>');
    /*optional stylesheet*/ //mywindow.document.write('<link rel="stylesheet" href="main.css" type="text/css" />');
    mywindow.document.write('</head><body >');
    mywindow.document.write(data);
    mywindow.document.write('</body></html>');

    mywindow.document.close(); // necessary for IE >= 10
    mywindow.focus(); // necessary for IE >= 10

    mywindow.print();
    mywindow.close();

    return true;
}


