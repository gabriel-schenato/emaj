<?php

namespace Emaj\Repositories\Cadastro;

use Emaj\Entities\Cadastro\TipoDemanda;
use Emaj\Repositories\AbstractRepository;
use Emaj\Repositories\Cadastro\TipoDemandaRepository;
use Illuminate\Validation\Rule;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Repository responsável por gerenciar a entidade Tipo Demanda
 *
 * PHP version 7.2
 *
 * @category   Repository
 * @package    Cadastro
 * @author     Gabriel Schenato <gabriel@uniplaclages.edu.br>
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link       https://www.uniplaclages.edu.br/
 * @since      1.0.0
 */
class TipoDemandaRepositoryEloquent extends AbstractRepository implements TipoDemandaRepository
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return TipoDemanda::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * Método responsável por retornar as regras a serem aplicadas ao criar ou editar
     * um registro
     * 
     * @param array $data
     * @param int $id
     * 
     * @return array Regras para serem aplicadas
     */
    public function getRules(array $data, int $id = null)
    {
        return [
            'nome' => ['required', 'min:5', 'max:255', Rule::unique('tipo_demandas')->ignore($id)]
        ];
    }

    /**
     * Método responsável por realizar a busca pelo valor e campo passado
     * @param array $values
     * @return mixed
     */
    public function getBySearch(array $values)
    {
        $criteria = $this->model->newQuery();
        if (isset($values['id'])) {
            $criteria->where('id', '=', (int) $values['id']);
        }
        if (isset($values['nome'])) {
            $criteria->where('nome', 'like', "%{$values['nome']}%");
        }
        if (isset($values['descricao'])) {
            $criteria->where('descricao', 'like', "%{$values['descricao']}%");
        }
        if (isset($values['ativo'])) {
            $criteria->where('ativo', '=', (boolean) $values['ativo']);
        }
        if (isset($values['created_at'])) {
            $criteria->where('created_at', 'like', "{$values['created_at']}%");
        }
        if (isset($values['updated_at'])) {
            $criteria->where('updated_at', 'like', "{$values['updated_at']}%");
        }

        return $criteria;
    }

    /**
     * Método responsável por buscar os dados e retornar para o autocomplete
     * 
     * @param string $value
     */
    public function getDataAutocomplete($value)
    {
        $this->applyCriteria();
        $this->applyScope();

        $model = $this->model->where(function ($query) use ($value) {
                    $query->where('nome', 'LIKE', "%{$value}%")
                    ->orWhere('id', '=', (int) $value);
                })
                ->orderBy('nome', 'asc')
                ->limit(10)
                ->get(['id', 'nome']);

        $this->resetModel();

        return $model;
    }

}
