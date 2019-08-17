<?php

namespace Emaj\Entities\Cadastro;

use Emaj\Entities\Cadastro\Cliente;
use Emaj\Entities\Cadastro\TipoDemanda;
use Illuminate\Database\Eloquent\Model;

/**
 * Classe da entidade Protocolo
 *
 * PHP version 7.2
 *
 * @category   Entity
 * @package    Cadastro
 * @author     Gabriel Schenato <gabriel@uniplaclages.edu.br>
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link       https://www.uniplaclages.edu.br/
 * @since      1.1.1
 */
class Protocolo extends Model
{

    //protected $appends = ['dados_ficha_triagem'];
    protected $fillable = [
        'cliente_id',
        'protocolo',
        'numero_processo',
        'tipo_demanda_id',
        'parte_contraria_id',
        'status',
        'observacoes',
        'ativo'
    ];

    /**
     * Pega o Cliente associado a esse protocolo.
     */
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }

    /**
     * Pega a tipo de demanda associado a esse protocolo.
     */
    public function tipo_demanda()
    {
        return $this->belongsTo(TipoDemanda::class);
    }

    /**
     * Pega a parte contrária associado a esse protocolo.
     */
    public function parte_contraria()
    {
        return $this->belongsTo(Cliente::class, 'parte_contraria_id');
    }

    protected function getDadosFichaTriagemAttribute()
    {
        $string = '';

        $cliente = $this->cliente;
        $parteContraria = $this->parte_contraria;
        $tipoDemanda = $this->tipo_demanda;


        if ($cliente) {
            $string .= 'Cliente: ' . $cliente->nome_completo;
            $string .= ' (' . $cliente->id . ')';
        }
        if ($parteContraria) {
            $string .= ' - Parte Contrária: ' . $parteContraria->nome_completo;
        }
        if (isset($this->attributes['protocolo'])) {
            $string .= ' - Protocolo: ' . $this->attributes['protocolo'];
        }
        if (isset($this->attributes['numero_processo'])) {
            $string .= ' - N.º Processo: ' . $this->attributes['numero_processo'];
        }
        if ($tipoDemanda) {
            $string .= ' - Demanda: ' . $tipoDemanda->nome;
        }
        if (isset($this->attributes['created_at'])) {
            $string .= ' - Data: ' . \Carbon\Carbon::parse($this->attributes['created_at'])->format('d/m/Y');
        }
        return $string;
    }

}