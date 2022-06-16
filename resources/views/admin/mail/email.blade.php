<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Resgitro de nuevo usuario</title>
</head>

<body style="margin: 0; padding: 0; background-color: #eeeeee" bgcolor="#eeeeee">
    <!-- START EMAIL -->
    <table width="100%" cellpadding="0" cellspacing="0" border="0" bgcolor="#eeeeee">
        <!-- START LOGO -->
        <tr>
            <td width="100%" valign="top" align="center" class="padding-container" style="
            padding: 18px 0px 18px 0px !important;
            mso-padding-alt: 18px 0px 18px 0px;
          ">
                <table width="600" cellpadding="0" cellspacing="0" border="0" align="center" class="wrapper">
                    <tr>
                        <td align="center">
                            <table cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td width="100%" valign="top" align="center">
                                        <table width="600" cellpadding="0" cellspacing="0" border="0" align="center"
                                            class="wrapper" bgcolor="#eeeeee">
                                            <tr>
                                                <td align="center">
                                                    <table width="600" cellpadding="0" cellspacing="0" border="0"
                                                        class="container" align="center">
                                                        <!-- START HEADER IMAGE -->
                                                        <tr>
                                                            <td align="center" class="hund" width="600">
                                                                <img src="https://sccm.vizcarra.com/img/material-email-logo.png"
                                                                    width="200" alt="Logo" border="0"
                                                                    style="max-width: 200px; display: block" />
                                                            </td>
                                                        </tr>
                                                        <!-- END HEADER IMAGE -->
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <!-- END LOGO -->

        <!-- START CARD 1 -->
        <tr>
            <td width="100%" valign="top" align="center" class="padding-container" style="
            padding-top: 0px !important;
            padding-bottom: 18px !important;
            mso-padding-alt: 0px 0px 18px 0px;
          ">
                <table width="600" cellpadding="0" cellspacing="0" border="0" align="center" class="wrapper">
                    <tr>
                        <td>
                            <table cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td style="
                        border-radius: 3px;
                        border-bottom: 2px solid #d4d4d4;
                      " class="card-1" width="100%" valign="top" align="center">
                                        <table style="border-radius: 3px" width="600" cellpadding="0" cellspacing="0"
                                            border="0" align="center" class="wrapper" bgcolor="#ffffff">
                                            <tr>
                                                <td align="center">
                                                    <table width="600" cellpadding="0" cellspacing="0" border="0"
                                                        class="container">
                                                        <!-- START HEADER IMAGE -->
                                                        <tr>
                                                            <td align="center" class="hund ripplelink" width="600">
                                                                <img align="center" width="600" style="
                                      border-radius: 3px 3px 0px 0px;
                                      width: 100%;
                                      max-width: 600px !important;
                                    " class="hund" src="https://sccm.vizcarra.com/img/material.gif" />
                                                            </td>
                                                        </tr>
                                                        <!-- END HEADER IMAGE -->
                                                        <!-- START BODY COPY -->
                                                        <tr>
                                                            <td class="td-padding" align="left" style="
                                    font-family: 'Roboto Mono', monospace;
                                    color: #212121 !important;
                                    font-size: 24px;
                                    line-height: 30px;
                                    padding-top: 18px;
                                    padding-left: 18px !important;
                                    padding-right: 18px !important;
                                    padding-bottom: 0px !important;
                                    mso-line-height-rule: exactly;
                                    mso-padding-alt: 18px 18px 0px 13px;
                                  ">
                                                                Registro de nuevo usuario
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="td-padding" align="left" style="
                                    font-family: 'Roboto Mono', monospace;
                                    color: #212121 !important;
                                    font-size: 16px;
                                    line-height: 24px;
                                    padding-top: 18px;
                                    padding-left: 18px !important;
                                    padding-right: 18px !important;
                                    padding-bottom: 0px !important;
                                    mso-line-height-rule: exactly;
                                    mso-padding-alt: 18px 18px 0px 18px;
                                  ">
                                                                <p>El usuario {{ auth()->user()->name }} realizo el
                                                                    siguiente registro:</p>
                                                                <p>Nombre: {{ $user->name }} </p>
                                                                <p>Email: {{ $user->email }} </p>
                                                                <p>Fecha de creación: {{ $user->created_at }} </p>
                                                                <p>Roles asignados:</p>
                                                                @foreach ($user->roles as $item)
                                                                    <p>{{ $item->name }}</p>
                                                                @endforeach
                                                                <br /><br />
                                                                SCCM! :)
                                                            </td>
                                                        </tr>
                                                        <!-- END BODY COPY -->
                                                        <!-- BUTTON -->
                                                        <tr>
                                                            <td align="left" style="
                                    padding: 18px 18px 18px 18px;
                                    mso-alt-padding: 18px 18px 18px 18px !important;
                                  ">
                                                                <table width="100%" border="0" cellspacing="0"
                                                                    cellpadding="0">
                                                                    <tr>
                                                                        <td>
                                                                            <table border="0" cellspacing="0"
                                                                                cellpadding="0">
                                                                                <tr>
                                                                                    <td align="left"
                                                                                        style="border-radius: 3px"
                                                                                        bgcolor="#17bef7">
                                                                                    </td>
                                                                                </tr>
                                                                            </table>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        <!-- END BUTTON -->
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <!-- END CARD 1 -->

        <!-- FOOTER -->
        <tr>
            <td width="100%" valign="top" align="center" class="padding-container">
                <table width="600" cellpadding="0" cellspacing="0" border="0" align="center" class="wrapper">
                    <tr>
                        <td width="100%" valign="top" align="center">
                            <table width="600" cellpadding="0" cellspacing="0" border="0" align="center"
                                class="wrapper" bgcolor="#eeeeee">
                                <tr>
                                    <td align="center">
                                        <table width="600" cellpadding="0" cellspacing="0" border="0"
                                            class="container">
                                            <tr>
                                                <td class="td-padding" align="center" style="
                              font-family: 'Roboto Mono', monospace;
                              color: #212121 !important;
                              font-size: 16px;
                              line-height: 24px;
                              padding-top: 0px;
                              padding-left: 0px !important;
                              padding-right: 0px !important;
                              padding-bottom: 0px !important;
                              mso-line-height-rule: exactly;
                              mso-padding-alt: 0px 0px 0px 0px;
                            ">
                                                    &copy; Designed by EASuarez
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="center" bgcolor="#eeeeee">
                                                    <a href="https://vizcarra.com/" target="_blank" style="
                                font-size: 12px;
                                line-height: 14px;
                                font-weight: 500;
                                font-family: 'Roboto Mono', monospace;
                                color: #212121;
                                text-decoration: underline;
                                padding: 0px;
                                border: 1px solid #eeeeee;
                                display: inline-block;
                              ">EMV</a>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <!-- FOOTER -->
        <tr>
            <td height="36px"></td>
        </tr>
    </table>
    <!-- END EMAIL -->
    <div style="
        display: none;
        white-space: nowrap;
        font: 15px courier;
        line-height: 0;
      ">
        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
    </div>
</body>

</html>
