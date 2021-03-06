<?php

namespace Emaj\Http\Controllers\Api\V1\Cadastro;

use Emaj\Http\Controllers\CrudController;
use Emaj\Repositories\Cadastro\ParametroTriagemRepository;

/**
 * Classe responsável por gerenciar a requisições das páginas
 *
 * PHP version 7.2
 *
 * @category   Controller
 * @package    Cadastro
 * @author     Gabriel Schenato <gabriel@uniplaclages.edu.br>
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link       https://www.uniplaclages.edu.br/
 * @since      1.0.0
 */
class ParametrosTriagemController extends CrudController
{

    /**
     *
     * @var ParametroTriagemRepository 
     */
    protected $repository;

    public function __construct(ParametroTriagemRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Método responsável por buscar o registro e retornar para o front-end.
     * 
     * @param int $id
     * @return mixed
     */
    public function show($id = null)
    {
        if ($this->registro = $this->repository->first()) {
            return $this->registro;
        }
        return response()->json([]);
    }

}
