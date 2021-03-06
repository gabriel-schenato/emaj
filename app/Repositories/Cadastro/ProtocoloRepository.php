<?php

namespace Emaj\Repositories\Cadastro;

use Emaj\Repositories\RepositoryInterface;

/**
 * Repository interface responsável por gerenciar a entidade Protocolo
 *
 * PHP version 7.2
 *
 * @category   Interface
 * @package    Cadastro
 * @author     Gabriel Schenato <gabriel@uniplaclages.edu.br>
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link       https://www.uniplaclages.edu.br/
 * @since      2.0.0
 */
interface ProtocoloRepository extends RepositoryInterface
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
}
