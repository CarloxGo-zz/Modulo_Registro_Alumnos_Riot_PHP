<h1 class="page-header">Alumnos</h1>

<div class="well well-sm text-right">
    <button id="btn-insertar-masivo" class="btn btn-default" type="button">Registrar varios alumnos</button>
    <a class="btn btn-primary" href="?c=Alumno&a=Crud">Nuevo alumno</a>
</div>

<div id="list"></div>

<user-modal></user-modal>
<user-modal-insert></user-modal-insert>

<!-- RiotjS -->
<script src="app/view/components/user-modal.tag" type="riot/tag"></script>
<script src="app/view/components/user-modal-insert.tag" type="riot/tag"></script>

<!-- AnexGRID Code http://anexsoft.com/anexgrid -->
<script>
    $(document).ready(function(){
        $("#list").on('click', '.btn-ver', function(){
            var obj = $(this);
            riot.mount('user-modal', {
                id: obj.val()
            });            
        })
        
        $("#btn-insertar-masivo").click(function(){
            riot.mount('user-modal-insert');
        })
        
        var agrid = $("#list").anexGrid({
            class: 'table-striped table-bordered',
            columnas: [
                { style: 'width:48px;' },
                { leyenda: 'Nombre', columna: 'Nombre', ordenable: true },
                { leyenda: 'Carrera', columna: 'Carrera', style: 'width:240px;', ordenable: false, filtrable: false },
                { leyenda: 'Correo', columna: 'Correo', style: 'width:240px;', ordenable: true },
                { leyenda: 'Sexo', columna: 'Sexo', style: 'width:70px;', ordenable: true },
                { leyenda: 'Nacimiento', columna: 'FechaNacimiento', style: 'width:120px;', ordenable: true },
                { style: 'width:60px;' },
                { style: 'width:80px;' },
            ],
            modelo: [
                { propiedad: 'Foto', formato: function(tr, obj, celda){
                    if(celda == '') return '';
                    
                    return anexGrid_imagen({
                        src: 'uploads/' + celda,
                        style: 'width:48px;'
                    });
                }},
                { propiedad: 'Nombre', formato: function(tr, obj, celda){
                    return anexGrid_boton({
                        class: 'btn-link btn-ver',
                        contenido: obj.Nombre + ' ' + obj.Apellido,
                        value: obj.id
                    });
                    return ;
                }},
                { propiedad: 'Carrera' },
                { propiedad: 'Correo' },
                { propiedad: 'Sexo', formato: function(tr, obj, celda){
                    return celda == 1 ? 'Hombre' : 'Mujer';
                }},
                { propiedad: 'FechaNacimiento', class: 'text-right' },
                { formato: function(tr, obj, celda){
                    return anexGrid_link({
                        class: 'btn-primary btn-xs btn-block',
                        contenido: 'Editar',
                        href: '?c=Alumno&a=Crud&id=' + obj.id
                    });    
                }},
                { formato: function(tr, obj, celda){
                    return anexGrid_boton({
                        class: 'btn-danger btn-xs btn-block btn-eliminar',
                        contenido: 'Eliminar',
                        value: tr.data('fila')
                    });    
                }},
            ],
            url: '?c=Alumno&a=Listar',
            paginable: true,
            limite: 20,
            columna: 'id',
            columna_orden: 'DESC'
        })
        
        agrid.tabla().on('click', '.btn-eliminar', function(){
            if(!confirm('¿Esta seguro de eliminar este registro?')) return;
            
            /* Obtiene el objeto actual de la fila seleccionada */
            var fila = agrid.obtener($(this).val());
            
            /* Petición ajax al servidor */
            $.post('?c=Alumno&a=Eliminar', {
                id: fila.id
            }, function(r){
                if(r) agrid.refrescar();
            }, 'json')
            
            return false;
        })
    })
</script>
