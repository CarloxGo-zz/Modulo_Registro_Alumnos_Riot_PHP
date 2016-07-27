<h1 class="page-header">
    <?php echo isset($alm->id) ? $alm->Nombre : 'Nuevo Registro'; ?>
</h1>

<ol class="breadcrumb">
  <li><a href="?c=Alumno">Alumnos</a></li>
  <li class="active"><?php echo isset($alm->id) ? $alm->Nombre : 'Nuevo Registro'; ?></li>
</ol>

<form id="frm-alumno" action="?c=Alumno&a=Guardar" method="post" enctype="multipart/form-data">
    <?php if(isset($alm->id)): ?>
    <input type="hidden" name="id" value="<?php echo $alm->id; ?>" />
    <?php endif; ?>
    
    <div class="form-group">
        <label>Carrera</label>
        <select name="Carrera_id" class="form-control">
            <?php foreach($carreras as $c): ?>
            <option <?php echo @$alm->Carrera_id == $c->id ? 'selected' : ''; ?> value="<?php echo @$c->id; ?>"><?php echo @$c->Nombre; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    
    <div class="form-group">
        <label>Nombre</label>
        <input type="text" name="Nombre" value="<?php echo @$alm->Nombre; ?>" class="form-control" placeholder="Ingrese su nombre" data-validacion-tipo="requerido|min:3" />
    </div>
    
    <div class="form-group">
        <label>Apellido</label>
        <input type="text" name="Apellido" value="<?php echo @$alm->Apellido; ?>" class="form-control" placeholder="Ingrese su apellido" data-validacion-tipo="requerido|min:10" />
    </div>
    
    <div class="form-group">
        <label>Correo</label>
        <input type="text" name="Correo" value="<?php echo @$alm->Correo; ?>" class="form-control" placeholder="Ingrese su correo electrónico" data-validacion-tipo="requerido|email" />
    </div>
    
    <div class="form-group">
        <label>Sexo</label>
        <select name="Sexo" class="form-control">
            <option <?php echo @$alm->Sexo == 1 ? 'selected' : ''; ?> value="1">Masculino</option>
            <option <?php echo @$alm->Sexo == 2 ? 'selected' : ''; ?> value="2">Femenino</option>
        </select>
    </div>
    
    <div class="form-group">
        <label>Fecha de nacimiento</label>
        <input readonly type="text" name="FechaNacimiento" value="<?php echo @$alm->FechaNacimiento; ?>" class="form-control datepicker" placeholder="Ingrese su fecha de nacimiento" data-validacion-tipo="requerido" />
    </div>
    
    <div class="row">
        <div class="col-xs-6">
            <div class="form-group">
                <label>Foto</label>
                <input type="hidden" name="Foto" value="<?php echo @$alm->Foto; ?>" />
                <input type="file" name="Foto" placeholder="Ingrese una imagen" />
            </div>     
        </div>
        <div class="col-xs-6">
            <?php if(@!empty($alm->Foto)): ?>
                <div class="img-thumbnail text-center">
                    <img src="uploads/<?php echo @$alm->Foto; ?>" style="width:50%;" />
                </div>
            <?php endif; ?>            
        </div>
    </div>
    
    <hr />
    
    <div class="text-right">
        <button class="btn btn-success">Guardar</button>
    </div>
</form>

<script>
    $(document).ready(function(){
        $("#frm-alumno").submit(function(){
            return $(this).validate();
        });
    })
</script>