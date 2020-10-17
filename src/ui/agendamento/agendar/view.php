<?php
$token = ' eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJmZWVnb3ciLCJhdWQiOiJwdWJsaWNhcGkiLCJpYXQiOiIxNy0wOC0yMDE4IiwibGljZW5zZUlEIjoiMTA1In0.UnUQPWYchqzASfDpVUVyQY0BBW50tSQQfVilVuvFG38'
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendamento de Consultas</title>
    <link rel="icon" type="image/ico" href="./../../../assets/favicon.png" />
    <link rel="stylesheet" type="text/css" href="./../../../plugins/bootstrap/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="./../../../plugins/bootstrap/bootstrap-datepicker3.min.css" />
    <link rel="stylesheet" type="text/css" href="view.css" />
</head>

<body>
    <input type="hidden" id="token" value="<?php echo $token ?>">
    <div class="container">
        <div id="loader" class="modal fade bd-example-modal-lg" data-backdrop="static" data-keyboard="false" tabindex="-1">
            <div class="modal-dialog modal-sm">
                <div class="modal-content" style="width: 48px">
                    <div class="d-flex justify-content-center">
                        <div class="spinner-border" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="card mb-4 mt-4 box-shadow">
            <div class="card-header">
                <h4 class="my-0 font-weight-normal">Agendar Consulta
                </h4>
            </div>
            <div class="card-body">
                <div class="input-group">
                    <div class="m-2">
                        <h5><b>Consulta de</b></h5>
                    </div>
                    <select class="custom-select rounded m-1 " id="listaEspecilidades">
                        <option selected value="">Selecione a especialidade</option>
                    </select>
                    <div class="m-1">
                        <button class="btn btn-success  rounded-pill" id="buscarEspecilistas" type="button">Buscar</button>
                    </div>
                </div>
            </div>
            <div class="ml-3">
                <p class="h5" id="totalEspecialistas"></p>
            </div>
            <div id="listaEspecialistas" class="d-flex flex-wrap justify-content-center"></div>
        </div>

        <div class="m-3">
            <button class="btn btn-success rounded-pill" onclick="location.href='../'" type="button">Voltar</button>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="modalAgendamento" tabindex="-1" role="dialog" aria-labelledby="modalAgendamentoTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Preencha seu dados</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="formCadastro" method="post">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input required="required" type="text" class="form-control" id="nome" name="nome" placeholder="Nome Completo" maxlength="100">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <select required="required" class="custom-select rounded" id="listaComoConheceu">
                                            <option selected value="">Como conheceu?</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input required="required" type="text" class="form-control" id="dtNascimento" name="dtNascimento" placeholder="Nascimento" maxlength="10" data-mask="00/00/0000" data-mask-reverse="true">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input required="required" type="text" class="form-control" id="cpf" name="cpf" placeholder="CPF" maxlength="14" data-mask="000.000.000-00" data-mask-reverse="true" onfocusout="validarCPF(this.value)">
                                    </div>
                                </div>

                            </div>
                        </form>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary rounded-pill" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary rounded-pill" id="salvarCadastro">Solicitar Horários</button>
                    </div>
                </div>
            </div>
        </div>


    </div>



    <script type='text/javascript' src="./../../../plugins/jquery/jquery-3.5.1.min.js"></script>
    <script type='text/javascript' src="./../../../plugins/jquery/jquery.mask.min.js"></script>

    <script type='text/javascript' src="./../../../plugins/bootstrap/bootstrap.min.js"></script>
    <script type='text/javascript' src="./../../../plugins/bootbox/bootbox.min.js"></script>
    <script type="text/javascript" src="./../../../plugins/bootstrap/bootstrap-datepicker.min.js"></script>
    <script type="text/javascript" src="./../../../plugins/bootstrap/bootstrap-datepicker.pt-BR.min.js"></script>

    <script type='text/javascript' src="./../../../resources/integracao/api.gateway.service.js"></script>
    <script type='text/javascript' src="./../../../resources/integracao/api.feegow/api.feegow.js"></script>
    <script type='text/javascript' src="./../../../resources/integracao/api.feegow/api.feegow.professional.js"></script>
    <script type='text/javascript' src="./../../../resources/integracao/api.feegow/api.feegow.specialties.js"></script>
    <script type='text/javascript' src="./../../../resources/integracao/api.feegow/api.feegow.patient.js"></script>


    <script type='text/javascript' src="view.js"></script>


</body>

</html>