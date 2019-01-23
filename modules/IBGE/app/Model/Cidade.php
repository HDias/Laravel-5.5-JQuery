<?php

namespace IBGE\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $nome
 * @property int $codigo_ibge
 * @property int $estado_id
 * @property int $populacao_2010
 * @property numeric #densidade_demo
 * @property string $gentilico
 * @property numeric $area
 */
class Cidade extends Model
{
    protected $table        = 'ibge.cidades';
    protected $primaryKey   = 'id';
    public $timestamps      = false;

    public function findByName($cityName)
    {
        return $this->select('codigo_ibge as id', \DB::raw("CONCAT_WS(' - ', ibge.cidades.nome,  ibge.cidades.uf) as full_name"))
            ->where('ibge.cidades.nome', 'ILIKE', "%{$cityName}%");
    }

    public function findByIbgeCode($code)
    {
        return $this->select('codigo_ibge as id', \DB::raw("CONCAT_WS(' - ', ibge.cidades.nome,  ibge.cidades.uf) as full_name"))
            ->where('ibge.cidades.codigo_ibge', '=', "$code");
    }
}
