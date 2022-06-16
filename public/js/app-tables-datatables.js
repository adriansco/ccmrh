/*!
 * Beagle v1.8.0
 * https://foxythemes.net
 *
 * Copyright (c) 2020 Foxy Themes
 */

var App = (function () {
    "use strict";

    App.dataTables = function () {
        //We use this to apply style to certain elements
        $.fn.DataTable.ext.pager.numbers_length = 4;
        $.extend(true, $.fn.dataTable.defaults, {
            dom:
                "<'row be-datatable-header'<'col-sm-6'l><'col-sm-6'f>>" +
                "<'row be-datatable-body'<'col-sm-12'tr>>" +
                "<'row be-datatable-footer'<'col-sm-5'i><'col-sm-7'p>>",
        });

        $("#table1").dataTable({
            order: [[3, "desc"]],
        });

        //Remove search & paging dropdown
        $("#table2").dataTable({
            pageLength: 6,
            dom:
                "<'row be-datatable-body'<'col-sm-12'tr>>" +
                "<'row be-datatable-footer'<'col-sm-5'i><'col-sm-7'p>>",
        });

        //Enable toolbar button functions
        $("#table3").dataTable({
            buttons: ["copy", "csv", "excel", "pdf", "print"],
            lengthMenu: [
                [6, 10, 25, 50, -1],
                [6, 10, 25, 50, "All"],
            ],
            dom:
                "<'row be-datatable-header'<'col-sm-6'l><'col-sm-6 text-right'B>>" +
                "<'row be-datatable-body'<'col-sm-12'tr>>" +
                "<'row be-datatable-footer'<'col-sm-5'i><'col-sm-7'p>>",
        });

        $("#table4").dataTable({
            /* responsive: true, */
            responsive: {
                details: {
                    display:
                        $.fn.dataTable.Responsive.display.childRowImmediate,
                    type: "",
                },
            },
            lengthMenu: [
                [6, 10, 25, 50, -1],
                [6, 10, 25, 50, "All"],
            ],
        });

        $("#example").DataTable();
        /* $("#table5").DataTable({
      "serverSide": true,
      "ajax": "{{ url('api/employees') }}",
      "columns":[
        {data: 'id'},
        {data: 'first_name'},
        {data: 'last_name'},
      ],
      responsive: {
        details: {
          display: $.fn.dataTable.Responsive.display.childRowImmediate,
          type: ''
        }
      },
      "lengthMenu": [[6, 10, 25, 50, -1], [6, 10, 25, 50, "All"]],
    }); */
        $("#table5").DataTable({
            serverSide: true,
            ajax: "api/employees?api_key=key_cur_prod_fnPqT5xQEi5Vcb9wKwbCf65c3BjVGyBB",
            columns: [
                { data: "id" },
                { data: "first_name" },
                { data: "last_name" },
                { data: "gender" },
                { data: "status" },
                { data: "payroll" },
                { data: "hire_date" },
                { data: "dep_name" },
                { data: "pos_name" },
                { data: "btn" },
            ],
            responsive: {
                details: {
                    display:
                        $.fn.DataTable.Responsive.display.childRowImmediate,
                    type: "",
                },
            },
            lengthMenu: [
                [6, 10, 25, 50, -1],
                [6, 10, 25, 50, "All"],
            ],
        });

        $("#table6").dataTable({
            responsive: {
                details: {
                    display: $.fn.dataTable.Responsive.display.modal({
                        header: function (row) {
                            var data = row.data();
                            return "Details";
                        },
                    }),
                    renderer: $.fn.dataTable.Responsive.renderer.tableAll({
                        tableClass: "table",
                    }),
                },
            },
        });

        $("#table7").DataTable({
            serverSide: true,
            ajax: "api/departments",
            columns: [{ data: "id" }, { data: "name" }, { data: "btn" }],
            responsive: {
                details: {
                    display:
                        $.fn.DataTable.Responsive.display.childRowImmediate,
                    type: "",
                },
            },
            lengthMenu: [
                [6, 10, 25, 50, -1],
                [6, 10, 25, 50, "All"],
            ],
        });

        $("#table8").DataTable({
            serverSide: true,
            ajax: "api/positions",
            columns: [{ data: "id" }, { data: "name" }, { data: "btn" }],
            responsive: {
                details: {
                    display:
                        $.fn.DataTable.Responsive.display.childRowImmediate,
                    type: "",
                },
            },
            lengthMenu: [
                [6, 10, 25, 50, -1],
                [6, 10, 25, 50, "All"],
            ],
        });

        var table = $("#table9").DataTable({
            dom: "Bfrtip",
            buttons: ["colvis", "colvisRestore"],
            serverSide: true,
            ajax: "api/petitions",
            columns: [
                { data: "id" },
                { data: "compensated" },
                { data: "category" },
                { data: "user" },
                { data: "full_name" },
                { data: "department_source" },
                { data: "department_destiny" },
                { data: "status" },
                { data: "group_code" },
                { data: "start_date" },
                { data: "end_date" },
                { data: "btn" },
            ],
            responsive: {
                details: {
                    display:
                        $.fn.DataTable.Responsive.display.childRowImmediate,
                    type: "",
                },
            },
            lengthMenu: [
                [6, 10, 25, 50, -1],
                [6, 10, 25, 50, "All"],
            ],
            columnDefs: [
                {
                    targets: [7],
                    createdCell: function (cell, cellData, rowData, rowIndex, colIndex) 
                    {
                        /* console.log(rowData); */
                        /* Case-insensitive */
                        const s2 = "APROBADA";
                        if (rowData.status.toLowerCase() === s2.toLowerCase()) {
                            $(cell).css("color", "#34a853");
                            $(cell).css("font-weight", "700");
                        }else
                        { 
                            $(cell).css("color", "#fbbc05");
                            $(cell).css("font-weight", "700");
                        }
                    },
                },
            ],
        });

        $("a.toggle-vis").on("click", function (e) {
            e.preventDefault();
            // Get the column API object
            var column = table.column($(this).attr("data-column"));
            // Toggle the visibility
            column.visible(!column.visible());
        });
    };

    $(document).ready(function () {
        $("body").on("click", "#destroyDepartment", function (e) {
            if (
                !confirm(
                    "¿Seguro que quieres eliminar el registro?, esta acción no se puede deshacer"
                )
            ) {
                return false;
            }

            e.preventDefault();
            var id = $(this).data("id");
            // var id = $(this).attr('data-id');
            var token = $("meta[name='csrf-token']").attr("content");
            /* console.log(token); */
            $.ajax({
                url: "departments/" + id, //or you can use url: "company/"+id,
                type: "POST",
                data: {
                    _method: "delete",
                    _token: token,
                    id: id,
                },
                success: function (response) {
                    var oTable = $("#table7").dataTable();
                    oTable.fnDraw(false);
                    $("#success").html(response.message);
                    Swal.fire({
                        icon: "success",
                        title: "Departamento eliminado con éxito!",
                        showConfirmButton: false,
                        timer: 1500,
                    });
                    /* Swal.fire(
                        "Recordar!",
                        "Departamento eliminado con éxito!",
                        "success"
                    ); */
                },
            });
            return false;
        });
    });

    return App;
})(App || {});
