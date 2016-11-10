<?php

namespace GDE;

use Doctrine\ORM\Mapping as ORM;

/**
 * ColaboracaoOferecimento
 *
 * @ORM\Table(name="gde_colaboracao_oferecimentos")
 * @ORM\Entity
 */
class ColaboracaoOferecimento extends Base {
	/**
	 * @var integer
	 *
	 * @ORM\Column(name="id_colaboracao", type="integer", options={"unsigned"=true}), nullable=false)
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="IDENTITY")
	 */
	protected $id_colaboracao;

	/**
	 * @var integer
	 *
	 * @ORM\Column(name="id_oferecimento", type="integer", options={"unsigned"=true}), nullable=false)
	 */
	protected $id_oferecimento;

	/**
	 * @var integer
	 *
	 * @ORM\Column(name="id_usuario", type="integer", options={"unsigned"=true}), nullable=false)
	 */
	protected $id_usuario;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="campo", type="string", length=255, nullable=false)
	 */
	protected $campo;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="valor", type="string", length=255, nullable=false)
	 */
	protected $valor;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="status", type="string", length=1, nullable=false)
	 */
	protected $status;

	/**
	 * @var \DateTime
	 *
	 * @ORM\Column(name="data", type="datetime", nullable=false)
	 */
	protected $data;


}
