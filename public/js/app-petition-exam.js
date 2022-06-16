$(document).ready(function () {
    var id = $("#petition_id").val();
    fetchexam();
    function fetchexam() {
        $.ajax({
            type: "GET",
            url: "/fetch-exam/" + id,
            dataType: "json",
            success: function (response) {
                $("#content").html("");
                $.each(response.exams, function (key, item) {
                    $('#content').append('<tr>\
                        <td>' + item.id + '</td>\
                        <td>' + item.name + '</td>\
                        <td>' + item.pivot.date + '</td>\
                        <td>' + item.pivot.feedback + '</td>\
                        <td id="demo">' + item.note + '</td>\
                        <td>' + item.user + '</td>\
                        <td class="text-center" ><a href="" data-note-id="'+ item.pivot.note_id +'" data-id="'+ item.id +'" class="btn btn-primary ml-1 editbtn" id="updateExam'+ item.id +'" type="submit">Editar</a>'+''+'<a href="" data-petition-id="'+ item.pivot.petition_id +'" data-id="'+ item.id +'" class="btn btn-danger ml-1 deleteExam" id="deleteExam'+ item.id +'" type="submit">Eliminar</a></td>\
                    \</tr>');
                });
            },
        });
    }

    $(document).on('click', '.add-exam', function (e) {
        e.preventDefault();
        $(this).text('Sending..');
        var data = {
            'petition_id': $('#petition_id').val(),
            'exam_id': $('.exam_id').val(),
            'note_id': $('.note_id').val(),
            'comment': $('.comment').val(),
        }
        $.ajaxSetup({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        });

        $.ajax({
            type: "POST",
            url: "/petition-exam",
            data: data,
            dataType: "json",
            success: function (response) {
                if (response.status == 400) {
                    $('#save_msgList').html("");
                    $('#save_msgList').addClass('alert alert-danger text-center');
                    $.each(response.errors, function (key, err_value) {
                        $('#save_msgList').append('<li> *' + err_value + '</li>');
                    });
                    $('.add-exam').text('Save');
                } else if(response.status == 401){
                    $('#save_msgList').html("");
                    $('#save_msgList').addClass('alert alert-danger text-center');
                    $('#save_msgList').append('<li> *' + response.message + '</li>');
                } else {
                    $('#save_msgList').html("");
                    Swal.fire({
                        title: "Bien!",
                        html: response.message + "<br><br>",
                        icon: "success",
                        timer: 2000,
                        timerProgressBar: true,
                        showConfirmButton: false,
                    });
                    $('#AddStudentModal').find('input').val('');
                    $('#AddStudentModal').find('select').val('');
                    $('.add-exam').text('Guardar');
                    $('#AddStudentModal').modal('hide');
                    fetchexam();
                }
            }
        });
    });

    $(document).on('click', '.editbtn', function (e) {
        e.preventDefault();
        var id = $(this).data("id");
        var note = $(this).data('note-id');
        $('#editModal').modal('show');
        $.ajax({
            type: "GET",
            url: "/edit-exam/" + id,
            success: function (response) {
                if (response.status == 404) {
                    $('#success_message').addClass('alert alert-success');
                    $('#success_message').text(response.message);
                    $('#editModal').modal('hide');
                } else {
                    $('#exam_id').val(id);
                    $('#name').val(response.exam.name);
                    $('#note').val(note);
                }
            }
        });
        $('.btn-close').find('input').val('');

    });

    $(document).on("click", ".updateExam", function (e) {
        e.preventDefault();
        $(this).text("Espere...");
        var id = $('#exam_id').val();
        var token = $("meta[name='csrf-token']").attr("content");
        var data = {
            _method: "PUT",
            _token: token,
            id: id,
            petition_id: $("#petition_id").val(),
            note: $('#note').val(),
            comment: $('#comment').val(),
        };
        $.ajax({
            type: "PUT",
            url: "/petitions/" + id + "/update-exam",
            data: data,
            dataType: "json",
            success: function (response) {
                if (response.status == 400) {
                    $('#update_msgList').html("");
                    $('#update_msgList').addClass('alert alert-danger text-center');
                    $.each(response.errors, function (key, err_value) {
                        $('#update_msgList').append('<li>*' + err_value +
                            '</li>');
                    });
                    $('.updateExam').text('Actualizar');
                } else {
                    $('#update_msgList').html("");
                    $('#editModal').modal('hide');
                    Swal.fire({
                        title: "Bien!",
                        html: response.message + "<br><br>",
                        icon: "success",
                        timer: 2000,
                        timerProgressBar: true,
                        showConfirmButton: false,
                    });
                    $('.updateExam').text('Actualizar');
                    $('#comment').val('');
                    fetchexam();
                }
            },
        });
    });

    $(document).on('click', '.deleteExam', function (e) {
        e.preventDefault();
        $(this).text('Deleting..');
        Swal.fire({
            title: '¿Estás seguro?',
            text: "¡No podrás revertir esto!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '¡Sí, bórralo!',
            cancelButtonText: 'Cerrar'
        }).then((result) => {
            if (result.isConfirmed) {
                var id = $(this).data("id");
                var petition_id = $(this).data('petition-id');
                var token = $("meta[name='csrf-token']").attr("content");
                var data = {
                    _method: "DELETE",
                    _token: token,
                    id: id,
                    petition_id: petition_id,
                };
                $.ajax({
                    type: "DELETE",
                    url: "/delete-exam/" + id,
                    data: data,
                    dataType: "json",
                    success: function (response) {
                        if (response.status == 404) {
                            $('#success_message').addClass('alert alert-success');
                            $('#success_message').text(response.message);
                            $('.deleteExam').text('Yes Delete');
                        } else {
                            Swal.fire({
                                title: "Bien!",
                                html: response.message + "<br><br>",
                                icon: "success",
                                timer: 2000,
                                timerProgressBar: true,
                                showConfirmButton: false,
                            });
                            fetchexam();
                        }
                    }
                });
            }
        })
    });
});