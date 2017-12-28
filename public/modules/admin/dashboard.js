/**
 * Created by Son Minh on 12/14/2017.
 */
$(document).ready(function () {
    $("#List_grid").kendoGrid({
        dataSource: {
            type: "json",
            transport: {
                read: {
                    url: "/admin/ListJson",
                    type: "POST",
                    dataType: "json",
                    data: additionalData,
                    success: function (result) {
                        options.success(result);
                    }
                }
            },
            schema: {
                data: function(data){
                    $.each(data.Data,function(i,o){
                        // data.Data[i].LNgayTao = data.Data[i].LNgayTao *1000;
                        // data.Data[i].LNgayCapNhat = data.Data[i].LNgayCapNhat *1000;
                        data.Data[i].STT = (i+1);
                        if(data.Data[i].iSeen == '1'){
                            if(data.Data[i].iAllow == '1'){
                                data.Data[i].sTrangThai = "<span class='label label-success'>Đã Duyệt<span>";
                            }
                            else {
                                data.Data[i].sTrangThai = "<span class='label label-success'>Đã hủy<span>";
                            }
                            data.Data[i].sTacvu='';
                        }else{
                            data.Data[i].sTrangThai = "<span class='label label-danger'>Chưa Duyệt<span>";
                            data.Data[i].sTacvu='<span class="label label-success heading-text" style="cursor:pointer" title="Duyệt thông tin" onclick="onAllow('+data.Data[i].id+')"><i class="fa fa-check"></i></span>'+
                                '<span class="label label-danger heading-text" style="cursor:pointer;margin-left: 8px" title="Xóa" onclick="onDeny('+data.Data[i].id+')"><i class="fa fa-times"></i></span>';
                        }
                        data.Data[i].File1 = "<audio controls='controls' src='"+data.Data[i].vFile1+"'></audio>";
                        data.Data[i].File2 = "<audio controls='controls' src='"+data.Data[i].vFile2+"'></audio>";
                        if(data.Data[i].iCall == '1'){
                            data.Data[i].CuocGoi = "<span class='label label-success'>Đã Gọi<span>";
                        }
                        else
                        {
                            data.Data[i].CuocGoi = "<span class='label label-warning'>Chưa gọi<span>";
                        }
                        // if(data.Data[i].disabled == '0'){
                        //     data.Data[i].sdisabled = '<i class="icon-user-check text-primary"></i>';
                        //     data.Data[i].tacvu = '<span class="label label-danger heading-text" style="cursor:pointer" title="Khóa" onclick="disable(\''+data.Data[i].username+'\')"><i class="icon-lock2"></i></span>';
                        // }else{
                        //     data.Data[i].sdisabled = '<i class="icon-user-block text-danger"></i>';
                        //     data.Data[i].tacvu = '<span class="label label-primary heading-text" style="cursor:pointer" title="Mở khóa" onclick="enable(\''+data.Data[i].username+'\')"><i class="icon-unlocked2"></i></span> ';
                        //
                        // }
                    });
                    return data.Data;
                },
                total: "Total",
                errors: "Errors"
            },
            error: function (e) {

                this.cancelChanges();
            },
            parameterMap: function (options, type) {
                return JSON.stringify(options);
            },
            pageSize: 10,
            serverPaging: true
        },
        pageable: {
            refresh: true,
            pageSizes: [10, 40, 60],
            messages: {
                display: "Hiển thị {0} - {1} trong {2} dòng",
                empty: "Không có dữ liệu",
                itemsPerPage: "dòng trên trang. "
            }
        },
        sortable: true,
        filterable: false,
        editable: {
            confirmation: false,
            mode: "inline"
        },
        scrollable: true,
        columns: [{
            field: "STT",
            title: 'STT',
            headerAttributes: { style: "text-align:center;", "class": "myClass" },
            template: '<span style="text-align:center;display: block;">#=data.STT#<span>',
            width: 50,
        },{
            field: "iAllow",
            title: 'Trạng Thái',
            headerAttributes: { style: "text-align:center;" },
            attributes: { style: "text-align:center; width:50px;" },
            width: 110,
            template:'#=data.sTrangThai#'

        }, {
            title: 'Tác vụ',
            headerAttributes: { style: "text-align:center;" },
            attributes: { style: "text-align:center; width:90px;", "class": "text-center nowrap" },
            template: '#=data.sTacvu#',
            width: 90,
        }, {
            field: "timecall",
            title: 'Thời gian gọi',
            headerAttributes: { style: "text-align:center;" },
            attributes: { style: "text-align:center; width:90px;", "class": "text-center nowrap" },
            width: 150,
        }, {
            title: 'File ghi âm',
            field: "File1",
            headerAttributes: { style: "text-align:center;" },
            attributes: { style: "text-align:center; width:90px;", "class": "text-center nowrap" },
            width: 180,
            encoded: false,
        },{
            title: 'File Âm Thanh',
            field: "File2",
            headerAttributes: { style: "text-align:center;" },
            attributes: { style: "text-align:center; width:90px;", "class": "text-center nowrap" },
            width: 180,
            encoded: false,
        },{
            field: "namesender",
            title: 'Người gửi',
            headerAttributes: { style: "text-align:left;" },
            width: 90,
            encoded: false
        }, {
            title: 'SDT',
            field: "phonesender",
            headerAttributes: { style: "text-align:center;" },
            attributes: { style: "text-align:center; width:90px;", "class": "text-center nowrap" },
            width: 90,
            encoded: false,
        },{

            field: "namereceiver",
            title: 'Người nhận',
            headerAttributes: { style: "text-align:left;" },
            width: 90,
            encoded: false
        }, {
            title: 'SDT',
            field: "phonereceiver",
            headerAttributes: { style: "text-align:center;" },
            attributes: { style: "text-align:center; width:90px;", "class": "text-center nowrap" },
            width: 90,
            encoded: false,
        },{
            title: 'Ngày Tạo',
            field: "created_at",
            headerAttributes: { style: "text-align:center;" },
            attributes: { style: "text-align:center; width:90px;", "class": "text-center nowrap" },
            // template: '#=kendo.toString(new Date(data.LNgayTao), "dd/MM/yyyy hh:mm" )#',
            width: 90,
            encoded: false,
        },{
            title: 'Cuộc gọi',
            field: "CuocGoi",
            headerAttributes: { style: "text-align:center;" },
            attributes: { style: "text-align:center; width:90px;", "class": "text-center nowrap" },
            // template: '#=kendo.toString(new Date(data.LNgayCapNhat), "dd/MM/yyyy hh:mm" )#',
            width: 90,
            encoded: false,
        },{
            title: 'Người duyệt',
            field: "userAllow",
            headerAttributes: { style: "text-align:center;" },
            attributes: { style: "text-align:center; width:90px;", "class": "text-center nowrap" },
            // template: '#=kendo.toString(new Date(data.LNgayCapNhat), "dd/MM/yyyy hh:mm" )#',
            width: 90,
            encoded: false,
        }]
    });
    $("#txtSearchKey").keypress(function (event) {
        if (event.keyCode == 13) {
            event.preventDefault();
            $("#search").click();
        }
    });
    $('.selectclass').select2();
});
function additionalData() {
    return {
        KeyCode: $("#txtSearchKey").val(),
        Option : option,
    };
}

$("#search").click(function () {
    $("#List_grid").data("kendoGrid").dataSource.page(1);
});
var option=0;
$('#option').select2({width:"100%"}).on('change', function() {
    var sel = $(this).select2('data')[0].id;
    option=sel;
    $("#List_grid").data("kendoGrid").dataSource.page(1);
});
function onAllow(vid) {
    $.ajax({
        method: "POST",
        url: "/admin/allow",
        data: {
            id:vid
        },
        dataType: 'json',
        cache: false,
        success: function (result) {
            if (result.Status == '200') {
                swal({
                    title: "Thông Báo!",
                    text: result.Message,
                    confirmButtonColor: "#66BB6A",
                    type: "success"
                }).then(function () {
                    location.reload();
                });
            } else {
                swal({
                    title: "Thông Báo!",
                    text: result.Message,
                    confirmButtonColor: "#EF5350",
                    type: "error"
                });
            }
        },
        error: function (xhr, status, error) {
            alert(xhr.responseText);
        }
    });
    return false;
}
function onDeny(vid) {
    $.ajax({
        method: "POST",
        url: "/admin/deny",
        data: {
            id:vid
        },
        dataType: 'json',
        cache: false,
        success: function (result) {
            if (result.Status == '200') {
                swal({
                    title: "Thông Báo!",
                    text: result.Message,
                    confirmButtonColor: "#66BB6A",
                    type: "success"
                }).then(function () {
                    location.reload();
                });
            } else {
                swal({
                    title: "Thông Báo!",
                    text: result.Message,
                    confirmButtonColor: "#EF5350",
                    type: "error"
                });
            }
        },
        error: function (xhr, status, error) {
            alert(xhr.responseText);
        }
    });
    return false;
}
