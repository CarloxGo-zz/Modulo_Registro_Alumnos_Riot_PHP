<?php
use App\Model\AlumnoModel;
use App\Model\CarreraModel;

class AlumnoController
{
    public function __CONSTRUCT(){
        $this->model = new AlumnoModel();
        $this->carrera = new CarreraModel();
    }
    
    public function Index(){
        require 'app/view/header.php';
        require 'app/view/alumno/alumno.php';
        require 'app/view/footer.php';
    }
    
    public function Crud(){
        $alm = new stdClass();
        $carreras = $this->carrera->Todo();
        
        if(isset($_GET['id'])){
            $alm = $this->model->Obtener($_GET['id']);
        }
        
        require 'app/view/header.php';
        require 'app/view/alumno/alumno-editar.php';
        require 'app/view/footer.php';
    }
    
    public function Obtener(){
        sleep(1);
        print_r (
            json_encode(
                $this->model->Obtener($_GET['id'])
            )
        );
    }
    
    public function Listar()
    {
        print_r(
            $this->model->Listar()
        );
    }
    
    public function Carreras()
    {
        print_r(
            json_encode( $this->carrera->Todo() )
        );
    }
    
    public function Guardar(){
        $alm = $_POST;
        
        if( !empty( $_FILES['Foto']['name'] ) ){
            $foto = date('ymdhis') . '-' . strtolower($_FILES['Foto']['name']);
            move_uploaded_file ($_FILES['Foto']['tmp_name'], 'uploads/' . $foto);
            
            $alm['Foto'] = $foto;
        }

        if(isset($alm['id'])) $this->model->Actualizar($alm);
        else $this->model->Registrar($alm);
        
        header('Location: index.php');
    }
    
    public function InsertarMasivo(){
        $alm = $_POST['data'];
        
        foreach($alm as $k => $a){
            unset($alm[$k]['CarreraView']);
            unset($alm[$k]['SexoView']);
        }

        $this->model->Registrar($alm);
        
        print_r( json_encode( true ) );
    }
    
    public function Eliminar(){
        $this->model->Eliminar($_POST['id']);
        echo json_encode(true);
    }
}