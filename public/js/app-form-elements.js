/*!
 * Beagle v1.8.0
 * https://foxythemes.net
 *
 * Copyright (c) 2020 Foxy Themes
 */

var App = (function () {
    "use strict";
    var counterVal = 0;

    App.formElements = function () {
        //Js Code
        $(".datetimepicker").datetimepicker({
            autoclose: true,
            componentIcon: ".mdi.mdi-calendar",
            navIcons: {
                rightIcon: "mdi mdi-chevron-right",
                leftIcon: "mdi mdi-chevron-left",
            },
        });

        //Select2
        $(".select2").select2({
            width: "100%",
            placeholder: "Selecciona una opción",
        });

        //Select2 tags
        $(".tags").select2({ tags: true, width: "100%" });

        $("#employee").select2({
            width: "100%",
            minimumInputLength: 3,
            placeholder: "Selecciona una opción",
            ajax: {
                url: "/api/employees/search",
                dataType: "json",
            },
        });

        $("#employee").on("change", function () {
            var employee_id = $(this).val();
            if ($.trim(employee_id) != "") {
                $.get(
                    "/api/departments/search",
                    { employee_id: employee_id },
                    function (department) {
                        if (department.id !== undefined) {
                            $("#department_source_name").empty();
                            $("#department_source").empty();
                            document.getElementById(
                                "department_source_name"
                            ).value = department.name;
                            document.getElementById("department_source").value =
                                department.id;
                        } else {
                            //No definido
                            document.getElementById(
                                "department_source_name"
                            ).value = "Este empleado no tiene departamento.";
                            document.getElementById("department_source").value =
                                "";
                        }
                    }
                );
            }
        });

        $("#employee").on("change", function () {
            var employee_id = $(this).val();
            var ctrl = $(this).data("ctrl");
            console.log(ctrl);
            if ($.trim(employee_id) != "") {
                $.get(
                    "/api/positions/search",
                    { employee_id: employee_id },
                    function (position) {
                        if (position.id !== undefined) {
                            $("#position_source_name").empty();
                            $("#position_source").empty();
                            document.getElementById(
                                "position_source_name"
                            ).value = position.name;
                            document.getElementById(
                                "position_source_id"
                            ).value = position.id;
                        } else {
                            //No definido
                            document.getElementById(
                                "position_source_name"
                            ).value = "Este empleado no tiene puesto.";
                            document.getElementById(
                                "position_source_id"
                            ).value = "";
                        }
                    }
                );
            }
        });

        $(".addRow").on("click", function () {
            addRow();
        });

        function addRow() {
            /* alert("test"); */
            /* var counterVal = ++counterVal; */
            ++counterVal;
            var tr =
                "<tr>" +
                '<td><select name="id[]" id="employee' +
                counterVal +
                '" data-id="' +
                counterVal +
                '" class="form-control select2 empTest"></select>' +
                "</td>" +
                '<td class="text-center align-middle">' +
                '<button type="button" class="btn btn-danger removeRow"><i class="las la-minus"></i></button>' +
                "</td>" +
                "</tr>";
            $("tbody").append(tr);
            createSelect();
        }

        $(document).on("click", ".removeRow", function (e) {
            $(this).parent().parent().remove();
        });

        function createSelect() {
            $("#employee" + counterVal).select2({
                width: "100%",
                minimumInputLength: 3,
                placeholder: "Selecciona una opción",
                ajax: {
                    url: "/api/employees/search",
                    dataType: "json",
                },
            });
        }

        //Bootstrap Slider
        /* $('.bslider').bootstrapSlider(); */

        // File input
        /* $( '.inputfile' ).each( function(){
      var $input   = $( this ),
        $label   = $input.next( 'label' ),
        labelVal = $label.html();

      $input.on( 'change', function( e )
      {
        var fileName = '';

        if( this.files && this.files.length > 1 )
          fileName = ( this.getAttribute( 'data-multiple-caption' ) || '' ).replace( '{count}', this.files.length );
        else if( e.target.value )
          fileName = e.target.value.split( '\\' ).pop();

        if( fileName )
          $label.find( 'span' ).html( fileName );
        else
          $label.html( labelVal );
      });
    }); */

        // Custom input file
        /* bsCustomFileInput.init(); */
    };

    return App;
})(App || {});
