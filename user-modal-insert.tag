<user-modal-insert>

    <div id="user-modal-tag" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Registrar varios alumnos a la vez</h4>
                </div>
                <div class="modal-body">
                    <table class="table table-stripped">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Carrera</th>
                                <th>Correo</th>
                                <th>Sexo</th>
                                <th>Nacimiento</th>
                                <th style="width:60px;"></th>
                            </tr>
                            <!-- Formulario para agregar nuevos alumnos -->
                            <tr>
                                <td>
                                    <input id="nombre" type="text" placeholder="Nombre" class="form-control" />
                                </td>
                                <td>
                                    <input id="apellido" type="text" placeholder="Apellido" class="form-control" />
                                </td>
                                <td>
                                    <select id="carrera" class="form-control">
                                        <option each={carreras} value="{id}">{Nombre}</option>
                                    </select>
                                </td>
                                <td>
                                    <input id="correo" type="text" placeholder="Correo" class="form-control" />
                                </td>
                                <td>
                                    <select id="sexo" class="form-control">
                                        <option value="1">Hombre</option>
                                        <option value="0">Mujer</option>
                                    </select>
                                </td>
                                <td>
                                    <input id="nacimiento" type="text" placeholder="Cumpleaños" class="form-control" />
                                </td>
                                <td>
                                    <button class="btn btn-block btn-default" type="button" onclick={agregar}>Agregar</button>
                                </td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr each={data}>
                                <td>
                                    {Nombre}
                                </td>
                                <td>
                                    {Apellido}
                                </td>
                                <td>
                                    {CarreraView}
                                </td>
                                <td>
                                    {Correo}
                                </td>
                                <td>
                                    {SexoView}
                                </td>
                                <td>
                                    {FechaNacimiento}
                                </td>
                                <td>
                                    <button class="btn btn-block btn-danger" type="button" onclick={retirar}>Retirar</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button if={data.length > 0} type="button" class="btn btn-success" onclick={guardar}>Guardar</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        var self = this;
        self.ready = false;

        self.carreras = [];
        self.data = [];
//
        getCarreras();
//        
        retirar(e){
            var item = e.item;
            var index = self.data.indexOf(item);
            self.data.splice(index, 1);
        }
//
        agregar() {
            var nombre = document.getElementById('nombre'),
                apellido = document.getElementById('apellido'),
                carrera = document.getElementById('carrera'),
                correo = document.getElementById('correo'),
                sexo = document.getElementById('sexo'),
                nacimiento = document.getElementById('nacimiento');
                
            
            var alumno = {
                Nombre: nombre.value,
                Apellido: apellido.value,
                Carrera_id: carrera.value,
                CarreraView: carrera.options[carrera.selectedIndex].text,
                Correo: correo.value,
                Sexo: sexo.value,
                SexoView: sexo.options[sexo.selectedIndex].text,
                FechaNacimiento: nacimiento.value
            };
            
            nombre.value = '';
            apellido.value = '';
            correo.value = '';
            nacimiento.value = '';
            carrera.value = 1;
            sexo.value = 1;
            
            self.data.push(alumno);
        }
        
        guardar(){
            $.post('?c=Alumno&a=InsertarMasivo', {
                data: self.data
            } , function(r) {
                if(r){
                    window.location.reload(true);
                }
            }, 'json')
        }

        function getCarreras() {
            $.post('?c=Alumno&a=Carreras', function(r) {
                self.carreras = r;
                self.update();
            }, 'json')
        }

        this.on('mount', function() {
            $("#user-modal-tag").modal();
        })
    </script>

</user-modal-insert>