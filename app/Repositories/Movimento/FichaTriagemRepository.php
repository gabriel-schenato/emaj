<?php

namespace Emaj\Repositories\Movimento;

use Emaj\Repositories\RepositoryInterface;

/**
 * Repository interface responsável por gerenciar a entidade Ficha de Triagem
 *
 * PHP version 7.2
 *
 * @category   Interface
 * @package    Movimento
 * @author     Gabriel Schenato <gabriel@uniplaclages.edu.br>
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link       https://www.uniplaclages.edu.br/
 * @since      1.0.0
 */
interface FichaTriagemRepository extends RepositoryInterface
{

    /**
     * Método responsável por pegar as 5 demandas mais utilizadas
     * 
     * @return array
     */
    public function getTop5DemandasMaisAtendidas();

    /**
     * Método responsável por retornar o número de clientes
     * 
     * @return array
     */
    public function getNumeroClientes();

    /**
     * Método responsável por retornar o número de parte contrárias
     * 
     * @return array
     */
    public function getNumeroParteContrarias();

    /**
     * Método responsável por o número de atendimentos no mês
     * 
     * @return int
     */
    public function getAtendimentosMes();

    /**
     * Método responsável por buscar os dados e retornar para o autocomplete
     * 
     * @param string $value
     * @param int $idAluno
     */
    public function getDataAutocomplete($value, int $idAluno = null);
}
