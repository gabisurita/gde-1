<?php

namespace GDE;

use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\Mapping as ORM;

/**
 * Disciplina
 *
 * @ORM\Table(name="gde_disciplinas", uniqueConstraints={@ORM\UniqueConstraint(name="sigla_nivel", columns={"sigla", "nivel"})}, indexes={@ORM\Index(name="nome", columns={"nome"}), @ORM\Index(name="nivel", columns={"nivel"})})
 * @ORM\Entity
 */
class Disciplina extends Base {
	/**
	 * @var string
	 *
	 * @ORM\Column(type="string", length=5, nullable=false)
	 * @ORM\Id
	 */
	protected $sigla;

	/**
	 * @var Instituto
	 *
	 * @ORM\ManyToOne(targetEntity="Instituto")
	 * @ORM\JoinColumn(name="id_instituto", referencedColumnName="id_instituto")
	 */
	protected $instituto;

	/**
	 * @var PreConjunto
	 *
	 * @ORM\OneToMany(targetEntity="PreConjunto", mappedBy="disciplina")
	 * @ORM\JoinColumn(name="sigla", referencedColumnName="sigla")
	 * @ORM\OrderBy({"catalogo" = "ASC"})
	 */
	protected $pre_conjuntos;

	/**
	 * @var Equivalente
	 *
	 * @ORM\OneToMany(targetEntity="Equivalente", mappedBy="disciplina")
	 * @ORM\JoinColumn(name="sigla", referencedColumnName="sigla")
	 */
	protected $equivalentes;

	/**
	 * @var string
	 *
	 * @ORM\Column(type="string", length=255, nullable=true)
	 */
	protected $nome;

	/**
	 * @var boolean
	 *
	 * @ORM\Column(type="smallint", options={"unsigned"=true}, nullable=true)
	 */
	protected $creditos;

	/**
	 * @var string
	 *
	 * @ORM\Column(type="string", length=1, nullable=true)
	 */
	protected $nivel;

	/**
	 * @var boolean
	 *
	 * @ORM\Column(type="smallint", nullable=true)
	 */
	protected $periodicidade;

	/**
	 * @var integer
	 *
	 * @ORM\Column(type="smallint", options={"default"=0}, nullable=false)
	 */
	protected $parte = 0;

	/**
	 * @var string
	 *
	 * @ORM\Column(type="text", nullable=true)
	 */
	protected $ementa;

	/**
	 * @var string
	 *
	 * @ORM\Column(type="text", nullable=true)
	 */
	protected $bibliografia;

	/**
	 * @var boolean
	 *
	 * @ORM\Column(type="boolean", options={"default"=0}, nullable=false)
	 */
	protected $quinzenal = false;

	/**
	 * @var integer
	 *
	 * @ORM\Column(type="integer", options={"unsigned"=true, "default"=0}, nullable=false)
	 */
	protected $cursacoes = 0;

	/**
	 * @var integer
	 *
	 * @ORM\Column(type="integer", options={"unsigned"=true, "default"=0}, nullable=false)
	 */
	protected $reprovacoes = 0;

	/**
	 * @var integer
	 *
	 * @ORM\Column(type="integer", options={"unsigned"=true, "default"=0}, nullable=false)
	 */
	protected $max_reprovacoes = 0;

	const NIVEL_GRAD = 'G';
	const NIVEL_POS = 'P';
	const NIVEL_S = 'S';
	const NIVEL_TEC = 'T';

	/**
	 * Por_Sigla
	 *
	 * Carrega uma Disciplina pela sigla e, opcionamente, nivel
	 *
	 * @param $sigla
	 * @param string|null $nivel
	 * @param bool $vazio
	 * @return self
	 */
	public static function Por_Sigla($sigla, $nivel = null, $vazio = true) {
		if($nivel != null) {
			// Se temos nivel podemos fazer a busca por unique
			$Disciplina = self::FindOneBy(array('sigla' => $sigla, 'nivel' => $nivel));
			if(($Disciplina === null) && ($vazio === true))
				return new self;
			return $Disciplina;
		} else {
			// Se o nivel nao foi fornecido, pegamos a primeira encontrada
			$Disciplinas = self::FindBy(array('sigla' => $sigla));
			if(count($Disciplinas) > 0)
				return array_pop($Disciplinas);
			elseif($vazio == true)
				return new self;
			else
				return null;
		}
	}

	public static function Consultar($param, $ordem = null, &$total = 0, $limit = '-1', $start = '-1', $tipo = 'AND') {
		$qrs = $jns = array();
		if($ordem == null)
			$ordem = "D.sigla ASC";
		if(isset($param['sigla'])) {
			if(strlen($param['sigla']) == 5)
				$qrs[] = "D.sigla = :sigla";
			else {
				$qrs[] = "D.sigla LIKE :sigla";
				$param['sigla'] = '%'.$param['sigla'].'%';
			}
		}
		if(isset($param['nome']))
			$qrs[] = "D.nome LIKE :nome";
		if(isset($param['nivel']))
			$qrs[] = "D.nivel ".((is_array($param['nivel'])) ? "IN ('".implode("','", $param['nivel'])."')" : "= '".$param['nivel'][0]."'")."";
		if(isset($param['instituto'])) {
			$jns[] = "D.instituto AS I";
			$qrs[] = "INNER JOIN I.id_instituto = :instituto";
		}
		if(isset($param['creditos']))
			$qrs[] = "D.creditos = :creditos";
		if(isset($param['periodicidade']))
			$qrs[] = "D.periodicidade = :periodicidade";
		if(isset($param['ementa'])) {
			$qrs[] = "D.ementa LIKE :ementa";
			$param['ementa'] = '%'.$param['ementa'].'%';
		}
		$where = (count($qrs) > 0) ? " WHERE ".implode(" ".$tipo." ", $qrs) : "";
		$joins = (count($jns) > 0) ? implode(" ", $jns) : null;

		if($total !== null) {
			$dqlt = "SELECT COUNT(DISTINCT D.sigla) FROM GDE\\Disciplina AS D ".$joins.$where;
			$total = self::_EM()->createQuery($dqlt)->setParameters($param)->getSingleScalarResult();
		}
		$dql = "SELECT DISTINCT D FROM GDE\\Disciplina AS D ".$joins.$where." ORDER BY ".$ordem;
		$query = self::_EM()->createQuery($dql)->setParameters($param);
		if($limit > 0)
			$query->setMaxResults($limit);
		if($start > -1)
			$query->setFirstResult($start);
		return $query->getResult();
	}

	public static function Organiza(Disciplina $A, Disciplina $B) {
		return strnatcasecmp($A->getSigla(), $B->getSigla());
	}

	private static function Organiza_Pre_Conjuntos($Conjuntos) {
		$Pre_Requisitos = array();
		foreach($Conjuntos as $Conjunto) {
			if(!isset($Pre_Requisitos[$Conjunto->getCatalogo(false)]))
				$Pre_Requisitos[$Conjunto->getCatalogo(false)] = array();
			$Pre_Requisitos[$Conjunto->getCatalogo(false)][$Conjunto->getID()] = array();
			foreach($Conjunto->getLista() as $Lista) {
				$Pre_Requisitos[$Conjunto->getCatalogo(false)][$Conjunto->getID()][] = array(Disciplina::Por_Sigla($Lista->getSigla(false)), $Lista->getParcial(), $Lista->getSigla(false));
			}
		}
		return $Pre_Requisitos;
	}

	public static function Formata_Conjuntos($Conjuntos) {
		if(count($Conjuntos) == 0)
			return "-";
		$ret = array();
		foreach($Conjuntos as $Conjunto) {
			$siglas = array();
			foreach($Conjunto as $sigla => $Equivalente) {
				if($Equivalente === null)
					$siglas[] = htmlspecialchars($sigla)." (?)";
				else
					$siglas[] = "<a href=\"".CONFIG_URL."disciplina/".$Equivalente->getSigla(true)."\" title=\"".$Equivalente->getNome()."\">".$Equivalente->getSigla()."</a> (".(($Equivalente->getCreditos() > 0)?$Equivalente->getCreditos():'?').")";
			}
			$ret[] = implode(" e ", $siglas);
		}
		return implode(" ou<br />", $ret);
	}

	public function getPre_Requisitos($Usuario, $formatado = false, $catalogo = null) {
		$de_pos = in_array($this->getNivel(false), array('M', 'D', 'S'));

		if($formatado === false) { // Se nao eh formatado, retorna soh os do Catalogo do Usuario
			$catalogo = ($de_pos) ? self::NIVEL_POS : $Usuario->getCatalogo(false);
			// Carrega apenas os Conjuntos do Catalogo em questao
			$criteria = Criteria::create()->where(Criteria::expr()->eq("catalogo", $catalogo));
			$organizados = self::Organiza_Pre_Conjuntos($this->getPre_Conjuntos()->matching($criteria));
			return (isset($organizados[$catalogo])) ? $organizados[$catalogo] : array();
		}

		$organizados = self::Organiza_Pre_Conjuntos($this->getPre_Conjuntos());
		$pres = array();
		if($de_pos) {
			if(!isset($organizados['P']))
				return 'N&atilde;o h&aacute; pr&eacute;-requisitos cadastrados.';
			foreach($organizados['P'] as $n => $lista) {
				$pres[$n] = array();
				foreach($lista as $pre) {
					if($pre[0] === null) {
						$url_sigla = htmlspecialchars($pre[2])." (?)";
					} else {
						$cursada = $Usuario->Eliminou($pre[0], $pre[1]);
						$url_sigla = "<a href=\"" . CONFIG_URL . "disciplina/" . $pre[0]->getSigla(true) . "\" class=\"" . (($cursada !== false) ? "disciplina_eliminada" : null) . "\" title=\"" . $pre[0]->getNome(true) . "\">" . $pre[0]->getSigla(true) . "</a>" . " (" . (($pre[0]->getCreditos() > 0) ? $pre[0]->getCreditos() : '?') . ")";
					}
					if($pre[1] === true)
						$pres[$n][] = "*".$url_sigla;
					else
						$pres[$n][] = $url_sigla;
				}
				$pres[$n] = implode(" e ", $pres[$n]);
			}
			sort($pres);
			return implode(" ou ", $pres);
		} else {
			$subfinal = array();
			$final = array();
			foreach($organizados as $catalogo => $conjuntos) {
				foreach($conjuntos as $n => $lista) {
					$pres[$catalogo][$n] = array();
					foreach($lista as $pre) {
						if($pre[0] === null) {
							$url_sigla = htmlspecialchars($pre[2])." (?)";
						} else {
							$cursada = $Usuario->Eliminou($pre[0], $pre[1]);
							$url_sigla = "<a href=\"" . CONFIG_URL . "disciplina/" . $pre[0]->getSigla(true) . "\" class=\"" . (($cursada !== false) ? "disciplina_eliminada" : null) . "\" title=\"" . $pre[0]->getNome(true) . "\">" . $pre[0]->getSigla(true) . "</a>" . " (" . (($pre[0]->getCreditos(false) > 0) ? $pre[0]->getCreditos(true) : '?') . ")";
						}
						if($pre[1] === true)
							$pres[$catalogo][$n][] = "*".$url_sigla;
						else
							$pres[$catalogo][$n][] = $url_sigla;
					}
					$pres[$catalogo][$n] = implode(" e ", $pres[$catalogo][$n]);
				}
				sort($pres[$catalogo]);
				$subfinal[$catalogo] = implode(" ou<br />", $pres[$catalogo]);
			}
			$last = $last_catalogo = $primeiro = null;
			$agrupando = false;
			foreach($subfinal as $catalogo => $lista) {
				if($agrupando === true) {
					if($last != $lista) {
						$final[] = (($Usuario->getCatalogo() >= $primeiro) && ($Usuario->getCatalogo() <= $last_catalogo)) ? "<tr><td><strong>De ".$primeiro." At&eacute; ".$last_catalogo."</strong></td><td><strong>".$last."</strong></td></tr>" : "<tr><td>De ".$primeiro." At&eacute; ".$last_catalogo."</td><td>".$last."</td></tr>";
						$agrupando = false;
					}
					if((!isset($subfinal[$catalogo+1])) && ($agrupando === true)) {
						$final[] = (($Usuario->getCatalogo() >= $primeiro) && ($Usuario->getCatalogo() <= $catalogo)) ? "<tr><td><strong>De ".$primeiro." At&eacute; ".$catalogo."</strong></td><td><strong>".$lista."</strong>" : "<tr><td>De ".$primeiro." At&eacute; ".$catalogo."</td><td>".$lista."</td></tr>";
					}
				}
				if($agrupando === false) {
					if((isset($subfinal[$catalogo+1])) && ($lista == $subfinal[$catalogo+1])) {
						$agrupando = true;
						$primeiro = $catalogo;
					} else {
						$final[] = ($Usuario->getCatalogo() == $catalogo) ? "<tr><td><strong>De ".$catalogo." At&eacute; ".$catalogo."</strong></td><td><strong>".$lista."</strong></td></tr>" : "<tr><td>De ".$catalogo." At&eacute; ".$catalogo."</td><td>".$lista."</td></tr>";
					}
				}
				$last = $lista;
				$last_catalogo = $catalogo;
			}
			return (count($final) > 0) ? "<table border=\"1\">".implode("", $final)."</table>" : 'N&atilde;o h&aacute; pr&eacute;-requisitos cadastrados.';
		}
	}

	public function getEquivalentes($formatado = false) {
		$Lista = array();
		foreach(parent::getEquivalentes() as $Equivalente) {
			if(!isset($Lista[$Equivalente->getID()]))
				$Lista[$Equivalente->getID()] = array();
			foreach($Equivalente->getConjuntos() as $Conjunto)
				$Lista[$Equivalente->getID()][$Conjunto->getSigla(false)] = Disciplina::Por_Sigla($Conjunto->getSigla(false));
		}
		return ($formatado) ? self::Formata_Conjuntos($Lista) : $Lista;
	}

	/**
	 * Desistencias
	 *
	 * Retorna o numero de Alunos que trancaram esta Disciplina
	 *
	 * @return integer
	 */
	public function Desistencias() {
		$dql = 'SELECT COUNT(A.ra) FROM GDE\\Aluno AS A '.
			'INNER JOIN A.trancadas AS O '.
			'INNER JOIN O.disciplina AS D '.
			'WHERE D.sigla = ?1';

		$query = self::_EM()->createQuery($dql)
			->setParameter(1, $this->getSigla(false));

		return $query->getSingleScalarResult();
	}

}
