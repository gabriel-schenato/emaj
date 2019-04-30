<?php

namespace Emaj\Http\Controllers\Api\V1\Cadastro;

use Emaj\Http\Controllers\CrudController;
use Emaj\Repositories\Cadastro\NacionalidadeRepository;

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
class NacionalidadesController extends CrudController
{

    protected $repository;

    public function __construct(NacionalidadeRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(\Illuminate\Http\Request $request)
    {
        $this->registro = $this->repository->all();
        return $this->registro;
    }

}
