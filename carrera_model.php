<?php
namespace App\Model;

use App\Lib\DataBase;
use App\Lib\AnexGrid;

class CarreraModel
{
	private $db;

	public function __CONSTRUCT()
	{
        $this->db = DataBase::StartUp();
	}

	public function Todo()
	{
		try
		{
            return $this->db
                        ->from('carrera')
                        ->orderBy('Nombre')
                        ->fetchAll();
                        
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}
}