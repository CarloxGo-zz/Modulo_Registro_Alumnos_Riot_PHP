<?php
namespace App\Model;

use App\Lib\DataBase;
use App\Lib\AnexGrid;

class AlumnoModel
{
	private $db;

	public function __CONSTRUCT()
	{
        $this->db = DataBase::StartUp();
	}

	public function Listar()
	{
		try
		{
            /* Anex Grid */
            $anexgrid = new AnexGrid();

            /* Los registros */
            $result = 
                $this->db
                     ->from('alumno')
                     ->select('alumno.*, carrera.Nombre as Carrera')
                     ->orderBy("$anexgrid->columna $anexgrid->columna_orden")
                     ->limit($anexgrid->limite)
                     ->offset($anexgrid->pagina)
                     ->fetchAll();
            
            /* El total de registros */
            $total = $this->db
                          ->from("alumno")
                          ->select('COUNT(*) Total')
                          ->fetch()
                          ->Total;

			return $anexgrid->responde($result, $total);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Obtener($id)
	{
		try 
		{
            return $this->db
                        ->from('alumno', $id)
                        ->fetch();
		}
        catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Eliminar($id)
	{
		try 
		{
            $this->db->deleteFrom('alumno', $id)
                     ->execute();
		}
        catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Actualizar($data)
	{
		try 
		{
            $id = $data['id'];
            unset($data['id']);
            
            $this->db->update('alumno', $data, $id)
                     ->execute();
		}
        catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Registrar($data)
	{
		try 
		{
            if(is_array($data)){
                foreach($data as $d){
                    $this->db->insertInto('alumno', $d)
                             ->execute();                                    
                }
            } else{
                $this->db->insertInto('alumno', $data)
                         ->execute();                
            }
		}
        catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}