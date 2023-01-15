@extends('layout')
<script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
<link href="{{ URL::asset('css/dashboard.css') }}" rel="stylesheet">
<link href="{{ URL::asset('css/dashboard.rtl.css') }}" rel="stylesheet">
<div class="container mt-5">
    <h1 class="text-success fw-3 text-center mb-5 fst-italic">HISTORICO UF</h1>
    <div class="d-flex">
        <div class="d-flex justify-content-center border border-2 border-primary shadow-lg rounded-4 mb-5 p-3 mx-auto w-75">
            <canvas class="my-4 " id="myChart" width="900" height="380"></canvas>
        </div>
        <div class="border rounded-5 shadow-lg p-3 h-75">
            Desde: 
            <input id="fechaDesde" type="date" class="form-control mb-3" min="2021-01-01" max="2021-12-31" value="2021-01-01">
            Hasta: 
            <input id="fechaHasta" type="date" class="form-control mb-3" min="2021-01-01" max="2021-12-31" value="2021-01-31">
            <button type="button" class="btn btn-primary mx-auto" onclick="aplicarFiltroFecha(event)">Aplicar Filtro</button>
        </div>

    </div>
    <div class="d-flex justify-content-between">
        <nav aria-label="Page navigation example">
            <ul class="pagination" id="paginacion">
                <div class="d-flex" id="numerosPagina">
                </div>
            </ul>
        </nav>
        <button type="button" class="btn btn-primary h-75" data-bs-toggle="modal" data-bs-target="#modalAgregarRegistro">Agregar Registro</button>
    </div>
    <div class="border rounded-4  shadow-lg">
        <table class="table table-striped-columns w-75">
            <thead>
                <tr class="">
                    <th style="text-transform: uppercase;" class="text-center fw-3 p-4 fs-5">ID</th>
                    <th style="text-transform: uppercase;" class="text-center fw-3 p-4 fs-5">Nombre</th>
                    <th style="text-transform: uppercase;" class="text-center fw-3 p-4 fs-5">Codigo</th>
                    <th style="text-transform: uppercase;" class="text-center fw-3 p-4 fs-5">Unidad Medida</th>
                    <th style="text-transform: uppercase;" class="text-center fw-3 p-4 fs-5">Valor</th>
                    <th style="text-transform: uppercase;" class="text-center fw-3 p-4 fs-5">Fecha</th>
                    <th style="text-transform: uppercase;" class="text-center fw-3 "></th>
                    <th style="text-transform: uppercase;" class="text-center fw-3 "></th>
                </tr>
            </thead>
            <tbody id="tablaCuerpo">
            </tbody>

        </table>
    </div>
</div>
<!--------------------------- MODAL -------------------------------------------->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="quitarMensajeGuardado()"></button>
            </div>
            <div class="d-flex justify-content-center m-1" id="mensajeGuardado"></div>
            <div class="modal-body" id="formModal">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="quitarMensajeGuardado()">Cerrar</button>
                <button type="button" class="btn btn-primary" id="botonGuardarRegistro" onclick="alCambiarDatos(event,dataset.id)">Guardar</button>
            </div>
        </div>
    </div>
</div>
<!---------------------------END MODAL -------------------------------------------->
<!--------------------------- MODAL BORRADO ---------------------------------------->
<div class="modal fade" id="modalBorrado" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="quitarMensajeGuardado()"></button>
            </div>
            <div class="modal-body" id="formModal">
                <div class="d-flex justify-content-censter m-1" id="mensajeBorrado"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="quitarMensajeGuardado()">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<!-- --------------------------------FIN MODAL BORRADO------------------------------------------ -->
<!-- -------------------------------- MODAL AGREGAR REGISTRO ----------------------------------------- -->
<div class="modal fade" id="modalAgregarRegistro" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar Registro Unidad de Fomento</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="quitarMensajeGuardado()"></button>
            </div>
            <div class="d-flex justify-content-center m-1" id="mensajeAgregarRegistro"></div>
            <div class="modal-body" id="formModalRegistro">
                <span class="mt-5">Unidad de Medida: </span><input class="form-control" id="RegistrounidadMedida" >
                <span class="mt-5">Valor: </span><input class="form-control"            id="Registrovalor" >
                <span class="mt-5">Fecha: </span><input type="date" class="form-control"            id="Registrofecha" min="2021-01-01" max="2021-12-31" value="2021-01-01">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="quitarMensajAgregar()">Cerrar</button>
                <button type="button" class="btn btn-primary" id="botonAgregarRegistro" onclick="agregarRegistro()">Guardar</button>
            </div>
        </div>
    </div>
</div>
<!-- ---------------------------------------- FIN MODAL AGREGAR REGISTRO -->
<script type="text/javascript" src="{{URL::asset('js/app.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('js/dashboard.js')}}"></script>
