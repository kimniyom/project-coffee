$(document).ready(function () {
    var orderID = $("#orderID").val();
    Calculator(orderID);
    Load();
    ActiveMenu();
});

function ActiveMenu() {
    var confirmorder = $("#confirmorder").val();
    if (confirmorder == 1) {
        $("#menuproduct").hide();
        $("#btnhome").show();
    } else {
        $("#menuproduct").show();
        $("#btnhome").hide();
    }
}

function Load() {
    var url = $("#Loadorderlist").val();
    var orderID = $("#orderID").val();
    var data = {orderID: orderID};
    $.post(url, data, function (success) {
        $("#orderlist").html(success);
        Calculator(orderID);
    });
}

function Save(menu, menuname) {
    var url = $("#Saveorderlist").val();
    var orderID = $("#orderID").val();
    var data = {
        order_id: orderID,
        menu: menu
    };
    $.post(url, data, function (success) {
        //alert(success);
        Notify(menuname);
        Load();
        $("#popupoptions").modal("hide");
    });
}

function Notify(menuname) {
    $.notify({
        // options
        icon: 'fa fa-check text-green',
        message: '<span style=\"color:green;\">' + menuname + '</span>'
    }, {
        // settings
        element: 'body',
        position: null,
        type: 'success',
        allow_dismiss: true,
        newest_on_top: false,
        showProgressbar: false,
        placement: {
            from: 'top',
            align: 'right'
        },
        offset: 20,
        spacing: 10,
        z_index: 1031,
        delay: 3000,
        timer: 500,
        url_target: '_blank',
        mouse_over: null,
        animate: {
            enter: 'animated fadeInDown',
            exit: 'animated fadeOutUp'
        }
    });
}

function popupoptions(menu, orderlist_id) {
    $("#menu_id").val(menu);
    $("#orderlist_id").val(orderlist_id);
    $("#popupoptions").modal();
    var orderID = $("#orderID").val();
    var url = "index.php?r=menuoptions/loadoptions";
    var data = {};
    $.post(url, data, function (result) {
        $("#bodyoptions").html(result);
        Loadoptions(orderID, menu, orderlist_id);
    });
}

function AddOptions(optionsID) {
    var url = "index.php?r=orders/addoptions";
    var orderID = $("#orderID").val();
    var menu = $("#menu_id").val();
    var orderlist_id = $("#orderlist_id").val();
    var data = {
        orderID: orderID,
        menu: menu,
        options_id: optionsID,
        orderlist_id: orderlist_id
    };

    $.post(url, data, function (success) {
        Loadoptions(orderID, menu, orderlist_id);
        Load();
    });
}

function Loadoptions(orderID, menu, orderlist_id) {
    var url = "index.php?r=options/loaddata";
    var data = {orderID: orderID, menu: menu, orderlist_id: orderlist_id};

    $.post(url, data, function (result) {
        $("#showdataoptions").html(result);
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
        var imcome = datas.income;
        var confirm = datas.confirm;
        var tel = datas.tel;
        var customer = datas.customer;
    
        if (confirm === 1) {
            $("#income").attr("disabled", true);
            $("#discount").attr("disabled", true);
            $(".ac").hide();
        }

        if (tel != null) {
            $("#btn-tel").hide();
            $("#tel").attr("disabled", true);
        }
        
        if (customer != null) {
            $("#btn-customer").hide();
            $("#customer").attr("disabled", true);
        }
        Distcount(0);
    });
}

function LoadCal() {

}

//ชำระเงิน
function Check_bill() {
    var url = $("#Urlcheckbill").val();
    var orderID = $("#orderID").val();
    var total = parseInt($("#_total").val());
    var distcount = $("#distcount").val();
    var income = parseInt($("#income").val());
    var change = $("#change").val();
    if (total <= 0) {
        //alert("ยังไม่มีรายการสินค้า ...");
        swal("แจ้งเตือน!", "ยังไม่มีรายการสินค้า ...!", "warning");
        return false;
    }
    if (income < total) {
        //alert("ยังไม่ได้รับเงินจากลูกค้า ใส่จำนวนเงินที่ช่องรับเงิน");
        swal("แจ้งเตือน!", "ยังไม่ได้รับเงินจากลูกค้า ใส่จำนวนเงินที่ช่องรับเงิน ...!", "warning");
        $("#income").focus();
        return false;
    }
    var data = {
        orderID: orderID,
        total: total,
        distcount: distcount,
        income: income,
        change: change
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
        //alert("เพิ่มเบอร์โทรศัพท์แล้ว ...");
        //window.location.reload();
        swal("", "SuccessFull", "success");
        $("#tel").val(response.tel);
        $("#btn-tel").hide();
        $("#tel").attr("disabled", true);
        //var datas = jQuery.parseJSON(response);
    }, "json");
}

//เพิ่มชื่อลูกค้า
function AddCustomer() {
    var url = $("#Urlcustomer").val();
    var orderID = $("#orderID").val();
    var customer = $("#customer").val();
    //alert(customer);
    if (customer == '') {
        $("#customer").focus();
        return false;
    }
    var data = {
        orderID: orderID,
        customer: customer
    };
    $.post(url, data, function (response) {
        //alert("เพิ่มเบอร์โทรศัพท์แล้ว ...");
        //window.location.reload();
        swal("", "SuccessFull", "success");
        $("#customer").val(response.customer);
        $("#btn-customer").hide();
        $("#customer").attr("customer", true);
        //var datas = jQuery.parseJSON(response);
    }, "json");
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
    var incomes = parseInt($("#income").val());
    Income(incomes);
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

function PrintElem(elem, data)
{
    Popup($(elem).html());
}

function Popup(data)
{
    var mywindow = window.open('', 'my div', 'height=600,width=400');
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

//จบการขายรายการนี้
function EndOrder() {
    var url = $("#Urlendorder").val();
    var tables = $("#tables").val();
    var data = {
        tables: tables
    };
    $.post(url, data, function (response) {
        window.location = "index.php?r=site/index";
        //var datas = jQuery.parseJSON(response);
    });
}

//ยกเลิกการขายรายการนั้น
function cancelorder(orderID, tables) {
    var r = confirm("คุณแน่ใจหรือไม่ที่จะยกเลิกรายการทั้งหมด ...?");
    if (r == true) {
        var url = "index.php?r=orders/deleteorder";
        var data = {
            orderID: orderID,
            tables: tables
        };
        $.post(url, data, function (success) {
            window.location = "index.php?r=site/index";
        });
    }
}

function Income(value) {
    var total = parseInt($("#_total").val());
    var income = parseInt(value);

    if (income < total || isNaN(income)) {
        $("#change").val(0);
    } else {
        var changes = parseInt((income - total));
        $("#change").val(changes);
    }
}


