@extends('components.layout')
@php($title = request()->routeIs('clients.*')?'Clientes':'Endereços')
@section('title',$title)
@section('body')
    <div class="card bg-dark text-sm-left ">
        <h5 class="card-header" id="tbTitle"></h5>
        <table class="table table-dark " id="tbShow">
            <thead></thead>

            <tbody></tbody>
        </table>
        <div class="card-footer" id="footerCard"></div>
    </div>
    <div class="modal fade " id="addressModal" tabindex="-1" role="dialog" aria-labelledby="addressModalTitle"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content  bg-secondary">
                <div class="modal-header ">
                    <h5 class="modal-title" id="addressModalTitle">Endereço</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body " id="addressModalBody"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="formModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content bg-dark">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModalLabel">Cadastro de Clientes</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formClient">
                        <div class="form-row">

                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Nome</label>
                                <input type="text" class="form-control" id="inputName" placeholder="Nome">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPhone">Telefone</label>
                                <input type="text" class="form-control" id="inputPhone" placeholder="Telefone">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="inputCep" data-toggle="tooltip" data-placement="top"
                                       title="Digite o Cep para preencher automáticamente">CEP</label>
                                <input type="number" class="form-control" maxlength="8" id="inputCep"
                                       data-toggle="tooltip"
                                       data-placement="top" title="Digite o Cep para preencher automáticamente">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputStreet">Rua</label>
                                <input type="text" class="form-control" id="inputStreet">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputNumber">Nº</label>
                                <input type="number" class="form-control" id="inputNumber">
                            </div>

                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="inputDistrict">Bairro</label>
                                <input type="text" class="form-control" id="inputDistrict">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputCity">Cidade</label>
                                <input type="text" class="form-control" id="inputCity">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="inputUf">UF</label>
                                <input type="text" class="form-control" maxlength="2" id="inputUf">
                                </select>
                            </div>

                        </div>

                </div>
                <div class="modal-footer">
                    <button type="cancel" class="btn btn-sm btn-outline-danger" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-sm btn-outline-light">Salvar</button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('javascript')
    <script type="text/javascript">

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{csrf_token()}}'
            }
        });
        getRoute = () => {
            return '{{request()->routeIs('clients.*')?'clients':'addresses'}}';
        };

        makeTh = () => {
            $('#tbShow>thead').empty();
            $('#tbTitle').empty();
            route = getRoute();
            line = '<tr class="align-bottom">'
            if (route == 'clients') {
                $('#tbTitle').append('Tabela de Clientes');
                $('#footerCard').append('<button type="button" class="btn btn-sm btn-outline-light" data-toggle="modal" data-target="#formModal" onclick="openForm()">Novo</button>');
                line +=
                    '<th scope="col">Código</th>' +
                    '<th scope="col">Nome</th>' +
                    '<th scope="col">Telefone</th>' +
                    '<th scope="col">Endereço</th>' +
                    '</tr>';
                return line;
            }
            if (route == 'addresses') {
                $('#tbTitle').append('Tabela de Endereços');
                line +=
                    '<th scope="col">Cliente</th>' +
                    '<th scope="col">Rua</th>' +
                    '<th scope="col">Número</th>' +
                    '<th scope="col">Bairro</th>' +
                    '<th scope="col">Cidade</th>' +
                    '<th scope="col">UF</th>' +
                    '<th scope="col">CEP</th>' +
                    '</tr>';
                return line;
            }
        };

        makeTr = (obj) => {

            route = getRoute();

            if (route == 'clients') {
                line = '<tr>' +
                    '<th scope="row">' + obj.id + '</th>' +
                    '<td>' + obj.name + '</td>' +
                    '<td>' + obj.phone + '</td>' +
                    '<td>' +
                    '<button type="button" class="btn btn-sm btn-outline-light" data-toggle="modal" data-target="#addressModal" onclick="getAddress(' + obj.id + ')">Visualizar</button>'
                    + '</td>' +
                    '</tr>';
                return $('#tbShow>tbody').append(line);
            }
            if (route == 'addresses') {
                line = '<tr>' +
                    '<th scope="row">' + obj.client.name + '</th>' +
                    '<td>' + obj.street + '</td>' +
                    '<td>' + obj.number + '</td>' +
                    '<td>' + obj.district + '</td>' +
                    '<td>' + obj.city + '</td>' +
                    '<td>' + obj.uf + '</td>' +
                    '<td>' + obj.cep + '</td>' +
                    '</tr>';
                return $('#tbShow>tbody').append(line);
            }
        };

        getAddress = (id) => {
            route = getRoute();

            $('#addressModalBody').empty();

            $.getJSON('api/clientsAdd/' + id, (data) => {

                line = '<div class="card card-body bg-dark">' +
                    '<p>' + data.street + ', ' + data.number + ', ' + data.district + ';</p>' +
                    '<p>' + data.city + ' - ' + data.uf + ', cep: ' + data.cep + ';</p>' +
                    '</div>';
                $('#addressModalBody').append(line);
            });
        };

        showTable = () => {
            route = getRoute();
            $('#tbShow>thead').append(makeTh());
            $('#tbShow>tbody').empty();
            $.getJSON('api/' + route, (data) => {
                data.forEach((element) => {
                    makeTr(element);
                });
            });
        };

        openForm = () => {
            $('#inputName').val('');
            $('#inputPhone').val('');
            $('#inputStreet').val('');
            $('#inputNumber').val('');
            $('#inputDistrict').val('');
            $('#inputCity').val('');
            $('#inputUf').val('');
            $('#inputCep').val('');
        };

        newClient = () => {
            prod = {
                name: $('#inputName').val(),
                phone: $('#inputPhone').val(),
                street: $('#inputStreet').val(),
                number: $('#inputNumber').val(),
                district: $('#inputDistrict').val(),
                city: $('#inputCity').val(),
                uf: $('#inputUf').val(),
                cep: $('#inputCep').val()
            };

            $.post('api/clients', prod, (data) => {
                console.log(makeTr(JSON.parse(data)));
            });
        };

        $('#formClient').submit(event => {
            event.preventDefault();
            newClient();
            $('#formModal').modal('hide');
        });

        $(() => {
            showTable()
        });


    </script>
@endsection
