$(document).ready(function () {
    
    $("#table1").dataTable({
        order: [[3, "desc"]],
    });

    $(".datetimepicker").datetimepicker("setDate", new Date(), {
        autoclose: true,
        componentIcon: ".mdi.mdi-calendar",
        navIcons: {
            rightIcon: "mdi mdi-chevron-right",
            leftIcon: "mdi mdi-chevron-left",
        },
    });

    $(document).on("click", ".add-status", function (e) {
        e.preventDefault();
        $(this).text("Enviando...");
        var data = {
            petition_id: $("#petition_id").val(),
            condition_id: $(".condition_id").val(),
            date_change: $(".date_change").val(),
            comment: $(".comment").val(),
        };
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        $.ajax({
            type: "POST",
            url: "/petition-status",
            data: data,
            dataType: "json",
            success: function (response) {
                if (response.status == 400) {
                    $("#save_msgList").html("");
                    $("#save_msgList").addClass(
                        "alert alert-danger text-center"
                    );
                    $.each(response.errors, function (key, err_value) {
                        $("#save_msgList").append(
                            "<li> *" + err_value + "</li>"
                        );
                    });
                    $(".add-status").text("Guardar");
                } else if (response.status == 401) {
                    $("#save_msgList").html("");
                    $("#save_msgList").addClass(
                        "alert alert-danger text-center"
                    );
                    $("#save_msgList").append(
                        "<li> *" + response.message + "</li>"
                    );
                } else {
                    $("#save_msgList").html("");
                    Swal.fire({
                        title: "Bien!",
                        html: response.message + "<br><br>",
                        icon: "success",
                        timer: 1500,
                        timerProgressBar: true,
                        showConfirmButton: false,
                    });
                    $("#addConditionModal").find("input").val("");
                    $("#addConditionModal").find("select").val("");
                    $(".add-status").text("Guardar");
                    $("#addConditionModal").modal("hide");
                    /* Revisar la parte de ajax con DT */
                    window.setTimeout(function () {
                        location.reload();
                    }, 1500);
                }
            },
        });
    });
});
