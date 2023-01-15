let historico = []
let paginas = []
let numeroDePaginas = []
const spiner = `<div class="spinner-border" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>`
const inicio = 'http://homestead.test/api/uf'
fetchIndicadores(inicio)
function pintarTabla(datos, tabla) {
    datos.map((item, index) => {
        const template = `<tr id=${index}>
                                <td class="px-5">${item.id}</td>    
                                <td class="px-5">${item.nombreIndicador}</td>
                                <td class="px-5">${item.codigoIndicador}</td>
                                <td class="px-5">${item.unidadMedidaIndicador}</td>
                                <td class="px-5">${item.valorIndicador}</td>
                                <td class="px-5">${item.fechaIndicador}</td>
                                <td class="px-2"><i id=${index} role="button" onclick=editarRegistro(event) data-bs-toggle="modal" data-bs-target="#exampleModal" class="bi bi-pencil-fill text-primary"></i></td>
                                <td class="px-2"><i id=${item.id} role="button" onclick=borrarRegistro(event) data-bs-toggle="modal" data-bs-target="#modalBorrado" class="bi bi-trash-fill text-danger"></i></td>
                            </tr>`
        tabla.innerHTML += template
    })
}

function fetchIndicadores(url) {
    fetch(url, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        }
    })
        .then(response => response.json())
        .then(data => {
            console.log(data);
            let datos = data.data
            historico = [...datos]
            paginas = [...data.links]
            console.log("el historico: ", historico)
            console.log("data tabla: ", datos)
            const tabla = document.getElementById("tablaCuerpo")
            tabla.innerHTML = ""
            pintarTabla(datos, tabla)
            numerosPaginaNext()
        })
        .catch(error => console.error("HA OCURRIDO UN ERROR", error))
}

function borrarRegistro(event) {
    console.log(event.target.id)
    const id = parseInt(event.target.id)
    const element = document.getElementById(event.target.id)
    const padre = (element.parentElement).parentElement
    const tabla = document.getElementById("tablaCuerpo")
    console.log("padre: ", padre)
    const mensajeBorrado = document.getElementById("mensajeBorrado")
    mensajeBorrado.innerHTML = spiner
    fetch('http://homestead.test/api/borrarRegistro', {
        method: 'POST',
        headers: { 'Content-Type': 'appliction/json' },
        body: JSON.stringify({
            "id": id
        })
    })
        .then(response => {
            console.log("entrando a response")
            console.log(response.status)
            if (response.status == 200) {
                return response.json()
            }
            else {
                console.log("Ha ocurrido un error")
                mensajeBorrado.innerHTML = `
            <div class="alert alert-danger" role="alert">
                !Ha ocurrido un error al borrar el Registro!
            </div>
            `
            }
        })
        .then(data => {
            console.log(data)
            if (data.msg == "borrado") {
                mensajeBorrado.innerHTML = `
            <div class="alert alert-success" role="alert">
                !Registro borrado con exito!
                </div>
                `
                tabla.removeChild(padre)
            }
        })
        .catch(error => { console.log(error) })
}

function editarRegistro(event) {
    console.log(event.target.id)
    console.log(historico)
    const idPadre = event.target.id
    console.log(historico[idPadre].id)
    const modal = document.getElementById("formModal")
    template = `
        <div><h3><span>ID: </span>${historico[idPadre].id}</h3></div>
        <span class="mt-5">Nombre Indicador: </span><input class="form-control"  id="nombreIndicador" value="${historico[idPadre].nombreIndicador}">
        <span class="mt-5">Codigo: </span><input class="form-control" id="codigo" value="${historico[idPadre].codigoIndicador}">  
        <span class="mt-5">Unidad de Medida: </span><input class="form-control"  id="unidadMedida" value="${historico[idPadre].unidadMedidaIndicador}">
        <span class="mt-5">Valor: </span><input class="form-control" id="valor"  value="${historico[idPadre].valorIndicador}">
        <span class="mt-5">Fecha: </span><input class="form-control" id="fecha"  value="${historico[idPadre].fechaIndicador}">
        `
    modal.innerHTML = template
    const botonGuardar = document.getElementById("botonGuardarRegistro")
    botonGuardar.dataset.id = idPadre

}

function alCambiarDatos(event, id) {
    const dataId = document.getElementById("botonGuardarRegistro")
    const valorNombre = document.getElementById("nombreIndicador").value
    const valorCodigo = document.getElementById("codigo").value
    const valorUnidadMedida = document.getElementById("unidadMedida").value
    const valorValor = document.getElementById("valor").value
    const valorFecha = document.getElementById("fecha").value
    let hijos = document.getElementById("tablaCuerpo")


    const mensajeError = `<div class="alert alert-danger" role="alert">
                                ¡Ha ocurrido un error! No se han podido guardar los datos
                            </div>`
    const mensajeExito = `<div class="alert alert-success" role="alert">
                                ¡El registro se ha guardado de manera Exitosa!
                            </div>`
    const mensajeGudardado = document.getElementById("mensajeGuardado")
    mensajeGudardado.innerHTML = spiner
    console.log(parseInt(hijos.children[id].children[0].innerHTML))
    fetch('http://homestead.test/api/editarRegistro', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(
            {
                "id": parseInt(hijos.children[id].children[0].innerHTML),
                "nombreIndicador": valorNombre,
                "codigoIndicador": valorCodigo,
                "unidadMedidaIndicador": valorUnidadMedida,
                "valorIndicador": valorValor,
                "fechaIndicador": valorFecha
            }
        )
    })
        .then(response => {
            console.log("entrando a response")
            console.log(response.status)
            if (response.status == 200) {
                return response.json()
            }
            else {
                console.log("Ha ocurrido un error")
                mensajeGudardado.innerHTML = mensajeError
            }
        })
        .then(data => {
            console.log(data)
            if (data.msg == "ok") {
                hijos.children[id].children[1].innerHTML = valorNombre
                hijos.children[id].children[2].innerHTML = valorCodigo
                hijos.children[id].children[3].innerHTML = valorUnidadMedida
                hijos.children[id].children[4].innerHTML = valorValor
                hijos.children[id].children[5].innerHTML = valorFecha
                mensajeGudardado.innerHTML = mensajeExito
            }
        })
        .catch(error => { console.log(error) })
    console.log(event.target.disabled)
}

function quitarMensajeGuardado() {
    const mensajeGudardado = document.getElementById("mensajeGuardado")
    mensajeGudardado.innerHTML = ""
}

function irPagina(evetn, url) {
    fetchIndicadores(url)
    console.log(paginas.length)
}

let pag1 = 1
function numerosPaginaNext() {

    const botonesPagina = document.getElementById("numerosPagina")
    botonesPagina.innerHTML = ""
    paginas.map((item, index) => {
        var active = ""
        if (item.active == true) {
            active = "active"
        }
        else {
            active = ""
        }
        botonesPagina.innerHTML += `
                        <li class="page-item"><a class="page-link ${active}" id="p${index}" data-url=${item.url} onclick="irPagina(event,dataset.url)">${item.label}</a></li>
                        `

    })
}

function agregarRegistro() {
    let body = {
        nombreIndicador: "UNIDAD DE FOMENTO (UF)",
        codigoIndicador: "UF",
        unidadMedidaIndicador: document.getElementById("RegistrounidadMedida").value,
        valorIndicador: parseFloat(document.getElementById("Registrovalor").value),
        fechaIndicador: document.getElementById("Registrofecha").value,
    }
    const mensajeAgregarRegistro = document.getElementById("mensajeAgregarRegistro")
    mensajeAgregarRegistro.innerHTML = spiner
    fetch('http://homestead.test/api/crearRegistro', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(body)
    })
        .then(response => {
            if (response.status == 200) {
                return response.json()
            }
            else {
                console.log("Ha ocurrido un error")
                mensajeAgregarRegistro.innerHTML = `<div class="alert alert-danger" role="alert">
                                                    ¡Ha ocurrido un error al crear el registro!
                                                </div>`
            }
        })
        .then(data => {
            if (data.msg == "ok") {
                mensajeAgregarRegistro.innerHTML = `<div class="alert alert-success" role="alert">
                                                    ¡Registro creado con exito!
                                                </div>`
                const boton = document.getElementById("botonAgregarRegistro")
                boton.disabled = true
                console.log(boton)
                document.getElementById("RegistrounidadMedida").value = ""
                document.getElementById("Registrovalor").value = ""
                document.getElementById("Registrofecha").value = ""
                fetchIndicadores(inicio)
            }
        })
        .catch(error => console.log(error))
    console.log(body)

}

function quitarMensajAgregar() {
    const mensajeGudardado = document.getElementById("mensajeAgregarRegistro")
    mensajeGudardado.innerHTML = ""
    const boton = document.getElementById("botonAgregarRegistro")
    boton.disabled = false
}
