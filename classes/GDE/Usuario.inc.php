<?php

namespace GDE;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\Mapping as ORM;

/**
 * Usuario
 *
 * @ORM\Table(
 *   name="gde_usuarios",
 *   indexes={
 *     @ORM\Index(name="ativo", columns={"ativo"}),
 *     @ORM\Index(name="compartilha_arvore", columns={"compartilha_arvore"}),
 *     @ORM\Index(name="ultimo_acesso", columns={"ultimo_acesso"})
 *   }
 * )
 * @ORM\Entity
 */
class Usuario extends Base {
	/**
	 * @var integer
	 *
	 * @ORM\Column(type="integer", options={"unsigned"=true}, nullable=false)
	 * @ORM\Id
	 * @ORM\GeneratedValue
	 */
	protected $id_usuario;

	/**
	 * @var \Doctrine\Common\Collections\Collection
	 *
	 * @ORM\OneToMany(targetEntity="UsuarioAmigo", mappedBy="usuario")
	 */
	protected $amigos;

	/**
	 * @var \Doctrine\Common\Collections\Collection
	 *
	 * @ORM\ManyToMany(targetEntity="Aluno")
	 * @ORM\JoinTable(name="gde_r_usuarios_favoritos",
	 *      joinColumns={@ORM\JoinColumn(name="id_usuario", referencedColumnName="id_usuario")},
	 *      inverseJoinColumns={@ORM\JoinColumn(name="ra", referencedColumnName="ra")}
	 * )
	 */
	protected $favoritos;

	/**
	 * @var UsuarioConfig
	 *
	 * @ORM\OneToOne(targetEntity="UsuarioConfig", mappedBy="usuario", cascade={"persist","remove"})
	 */
	protected $config;

	/**
	 * @var Aluno
	 *
	 * @ORM\OneToOne(targetEntity="Aluno", inversedBy="usuario")
	 * @ORM\JoinColumn(name="ra", referencedColumnName="ra")
	 */
	protected $aluno;

	/**
	 * @var Professor
	 *
	 * @ORM\OneToOne(targetEntity="Professor", inversedBy="usuario")
	 * @ORM\JoinColumn(name="id_professor", referencedColumnName="id_professor")
	 */
	protected $professor;

	/**
	 * @var Curso
	 *
	 * @ORM\ManyToOne(targetEntity="Curso")
	 * @ORM\JoinColumn(name="id_curso", referencedColumnName="id_curso")
	 */
	protected $curso;

	/**
	 * @var Modalidade
	 *
	 * @ORM\ManyToOne(targetEntity="Modalidade")
	 * @ORM\JoinColumn(name="id_modalidade", referencedColumnName="id_modalidade")
	 */
	protected $modalidade;

	/**
	 * @var UsuarioEliminada
	 *
	 * @ORM\OneToMany(targetEntity="UsuarioEliminada", mappedBy="usuario")
	 */
	protected $eliminadas;

	/**
	 * @var \Doctrine\Common\Collections\Collection
	 *
	 * @ORM\OneToMany(targetEntity="UsuarioEmprego", mappedBy="usuario")
	 */
	protected $empregos;

	/**
	 * @var ArrayCollection
	 *
	 * @ORM\ManyToMany(targetEntity="EnqueteOpcao")
	 * @ORM\JoinTable(name="gde_r_usuarios_enquetes_opcoes",
	 *      joinColumns={@ORM\JoinColumn(name="id_usuario", referencedColumnName="id_usuario")},
	 *      inverseJoinColumns={@ORM\JoinColumn(name="id_opcao", referencedColumnName="id_opcao")}
	 * )
	 */
	protected $enquetes_opcoes;

	/**
	 * @var string
	 *
	 * @ORM\Column(type="string", length=16, unique=true, nullable=false)
	 */
	protected $login;

	/**
	 * @var string
	 *
	 * @ORM\Column(type="string", length=255, nullable=true)
	 */
	protected $senha;

	/**
	 * @var string
	 *
	 * @ORM\Column(type="string", length=255, nullable=true)
	 */
	protected $nome;

	/**
	 * @var string
	 *
	 * @ORM\Column(type="string", length=255, nullable=true)
	 */
	protected $sobrenome;

	/**
	 * @var string
	 *
	 * @ORM\Column(type="string", length=255, nullable=true)
	 */
	protected $nome_completo;

	/**
	 * @var string
	 *
	 * @ORM\Column(type="string", length=255, unique=true, nullable=true)
	 */
	protected $email;

	/**
	 * @var string
	 *
	 * @ORM\Column(type="string", length=1, nullable=true)
	 */
	protected $nivel;

	/**
	 * @var integer
	 *
	 * @ORM\Column(type="smallint", nullable=true)
	 */
	protected $catalogo;

	/**
	 * @var integer
	 *
	 * @ORM\Column(type="smallint", nullable=true)
	 */
	protected $ingresso;

	/**
	 * @var string
	 *
	 * @ORM\Column(type="string", length=1, nullable=true)
	 */
	protected $sexo;

	/**
	 * @var string
	 *
	 * @ORM\Column(type="string", length=16, nullable=true)
	 */
	protected $foto;

	/**
	 * @var \DateTime
	 *
	 * @ORM\Column(type="date", nullable=true)
	 */
	protected $data_nascimento;

	/**
	 * @var string
	 *
	 * @ORM\Column(type="string", length=255, nullable=true)
	 */
	protected $apelido;

	/**
	 * @var string
	 *
	 * @ORM\Column(type="string", length=255, nullable=true)
	 */
	protected $status;

	/**
	 * @var string
	 *
	 * @ORM\Column(type="string", length=255, nullable=true)
	 */
	protected $orkut;

	/**
	 * @var string
	 *
	 * @ORM\Column(type="string", length=255, nullable=true)
	 */
	protected $gtalk;

	/**
	 * @var string
	 *
	 * @ORM\Column(type="string", length=255, nullable=true)
	 */
	protected $msn;

	/**
	 * @var string
	 *
	 * @ORM\Column(type="string", length=255, nullable=true)
	 */
	protected $blog;

	/**
	 * @var string
	 *
	 * @ORM\Column(type="string", length=255, nullable=true)
	 */
	protected $facebook;

	/**
	 * @var string
	 *
	 * @ORM\Column(type="string", length=255, nullable=true)
	 */
	protected $twitter;

	/**
	 * @var string
	 *
	 * @ORM\Column(type="string", length=255, nullable=true)
	 */
	protected $cidade;

	/**
	 * @var string
	 *
	 * @ORM\Column(type="string", length=2, nullable=true)
	 */
	protected $estado;

	/**
	 * @var string
	 *
	 * @ORM\Column(type="string", length=1, nullable=true)
	 */
	protected $estado_civil;

	/**
	 * @var string
	 *
	 * @ORM\Column(type="text", nullable=true)
	 */
	protected $mais;

	/**
	 * @var boolean
	 *
	 * @ORM\Column(type="boolean", options={"default"=1}, nullable=false)
	 */
	protected $compartilha_arvore = true;

	/**
	 * @var boolean
	 *
	 * @ORM\Column(type="boolean", options={"default"=0}, nullable=false)
	 */
	protected $procurando_emprego = false;

	/**
	 * @var string
	 *
	 * @ORM\Column(type="text", nullable=true)
	 */
	protected $exp_profissionais;

	/**
	 * @var string
	 *
	 * @ORM\Column(type="text", nullable=true)
	 */
	protected $hab_pessoais;

	/**
	 * @var string
	 *
	 * @ORM\Column(type="text", nullable=true)
	 */
	protected $esp_tecnicas;

	/**
	 * @var string
	 *
	 * @ORM\Column(type="text", nullable=true)
	 */
	protected $info_profissional;

	/**
	 * @var boolean
	 *
	 * @ORM\Column(type="boolean", options={"default"=1}, nullable=false)
	 */
	protected $compartilha_horario = true;

	/**
	 * @var \DateTime
	 *
	 * @ORM\Column(type="date", nullable=true)
	 */
	protected $mudanca_horario;

	/**
	 * @var \DateTime
	 *
	 * @ORM\Column(type="datetime", nullable=true)
	 */
	protected $ultimo_acesso;

	/**
	 * @var \DateTime
	 *
	 * @ORM\Column(type="datetime", nullable=true)
	 */
	protected $data_cadastro;

	/**
	 * @var boolean
	 *
	 * @ORM\Column(type="boolean", options={"default"=0}, nullable=false)
	 */
	protected $email_validado = false;

	// ToDo: Contants
	/**
	 * @var string
	 *
	 * @ORM\Column(type="string", length=1, options={"default"="d"}, nullable=false)
	 */
	protected $chat_status = 'd';

	/**
	 * @var boolean
	 *
	 * @ORM\Column(type="boolean", options={"default"=0}, nullable=false)
	 */
	protected $ativo = false;

	/**
	 * @var boolean
	 *
	 * @ORM\Column(type="boolean", options={"default"=0}, nullable=false)
	 */
	protected $admin = false;

	/**
	 * @var boolean
	 *
	 * @ORM\Column(type="boolean", options={"default"=0}, nullable=false)
	 */
	protected $beta = false;

	// Determina se esta eh uma copia da entidade original, que pode ser modificada
	private $_copia;

	// Erros de login
	const ERRO_LOGIN_NAO_ENCONTRADO = 1; // Usuario nao encontrado
	const ERRO_LOGIN_SENHA_INCORRETA = 2; // Usuario ou senha incorretos
	const ERRO_LOGIN_USUARIO_INATIVO = 3; // Usuario inativo
	const ERRO_LOGIN_TOKEN_INVALIDO = 4; // Token invalido

	// Fotos
	const PASTA_FOTOS = '../web/fts/';
	const URL_FOTOS = 'web/fts/';

	// Estados Civis
	private static $_estados_civis = array('0' => '', '1' => 'Prefiro N&atilde;o Opinar', '2' => 'Solteiro(a)', '3' => 'Enrolado(a)', '4' => 'Namorando', '5' => 'Noivo(a)', '6' => 'Casado(a)', '7' => 'Casamento Aberto', '8' => 'Relacionamento Liberal');

	/**
	 * Por_Unique
	 *
	 * Encontra um Usuario pelo valor unico provido (login, ra ou email)
	 *
	 * @param string $valor O valor a ser buscado
	 * @param string $campo (Opcional) Determina qual o campo a ser usado na busca
	 * @param bool|null $ativo (Opcional) Se nao for null, filtra pelo valor do campo $ativo
	 * @return Usuario|null O Usuario encontrado, ou null se nada for encontrado
	 */
	public static function Por_Unique($valor, $campo = null, $ativo = null) {
		if($valor == null) // Nao faz sentido procurar por um valor unico vazio
			return null;
		if($campo === null) { // Campo a ser determinado
			if(strpos($valor, '@') !== false) // Email
				$campo = 'email';
			elseif(preg_match('/^\d+$/i', $valor) > 0) // RA
				$campo = 'aluno'; // Busca por RA deve buscar um aluno
			else // Login
				$campo = 'login';
		} elseif($campo == 'ra')
			// Busca por RA deve buscar um aluno
			$campo = 'aluno';
		elseif($campo == 'matricula')
			// Busca por matricula (professor) precisa ser feita via DQL
			return self::Por_Matricula($valor, $ativo);
		$params = array($campo => $valor);
		if($ativo !== null)
			$params['ativo'] = $ativo;
		$Usuario = self::FindOneBy($params);
		if($Usuario === null)
			return null;
		return $Usuario;
	}

	/**
	 * Por_Login
	 *
	 * @param $login
	 * @param bool $ativo
	 * @param bool $vazio Se nenhum resultado for encontrado, retorna um objeto vazio
	 * @return null|Usuario
	 */
	public static function Por_Login($login, $ativo = true, $vazio = false) {
		$Usuario = self::Por_Unique($login, 'login', $ativo);
		if($Usuario === null && $vazio === true)
			return new self;
		return $Usuario;
	}

	/**
	 * Por_RA
	 *
	 * @param $ra
	 * @param bool $ativo
	 * @param bool $vazio Se nenhum resultado for encontrado, retorna um objeto vazio
	 * @return null|Usuario
	 */
	public static function Por_RA($ra, $ativo = true, $vazio = false) {
		$Usuario = self::Por_Unique($ra, 'ra', $ativo);
		if($Usuario === null && $vazio === true)
			return new self;
		return $Usuario;
	}

	/**
	 * Por_Matricula
	 *
	 * @param $matricula
	 * @param bool $ativo
	 * @param bool $vazio Se nenhum resultado for encontrado, retorna um objeto vazio
	 * @return null|Usuario
	 */
	public static function Por_Matricula($matricula, $ativo = true, $vazio = false) {
		$dql = 'SELECT U FROM GDE\\Usuario U INNER JOIN GDE\\Professor P WHERE P.matricula = ?1';
		if($ativo !== null)
			$dql .= ' AND U.ativo = ?2';
		$query = self::_EM()->createQuery($dql)
			->setParameter(1, $matricula)
			->setMaxResults(1);
		if($ativo !== null)
			$query->setParameter(2, $ativo);
		$Usuario = $query->getOneOrNullResult();
		if($Usuario === null && $vazio === true)
			return new self;
		return $Usuario;
	}

	/**
	 * Copia
	 *
	 * Se esta ja eh uma copia, retorna-a, caso contraria, cria uma copia e retorna-a
	 *
	 * @return $this|Usuario
	 */
	public function Copia() {
		if($this->_copia === true)
			return $this;
		$Copia = clone $this;
		$Copia->_copia = true;
		return $Copia;
	}

	/**
	 * @return bool
	 */
	public function Online() {
		if($this->getUltimo_Acesso(false) === null)
			return false;
		return ((time() - $this->getUltimo_Acesso('U')) < CONFIG_ONLINE_TIMEOUT);
	}

	/**
	 * @param $esta_online
	 * @param $status
	 * @param $admin
	 * @param bool $puro
	 * @return string
	 */
	public static function Trata_Chat_Status($esta_online, $status, $admin, $puro = false) {
		$retorno = "off";
		if($esta_online) {
			if($puro === false && ($status == 'i' || $status == 'z'))
				$retorno = "off";
			elseif($status == 'd' && $admin)
				$retorno = "x";
			else
				$retorno = $status;
		}
		return $retorno;
	}

	/**
	 * @param bool $html
	 * @param bool $artigo
	 * @return string
	 */
	public function getSexo($html = false, $artigo = false) {
		if($html === false)
			return $this->sexo;
		elseif($this->sexo == 'f')
			return ($artigo) ? 'a' : 'Feminino';
		elseif($this->sexo == 'm')
			return ($artigo) ? 'o' : 'Masculino';
		elseif($this->sexo == 'o')
			return ($artigo) ? '*' : 'Outro';
		else
			return ($artigo) ? '*' : 'Desconhecido';
	}

	/**
	 * @param bool $html
	 * @return string
	 */
	public function getEstado_Civil($html = true) {
		return ($html && isset(self::$_estados_civis[$this->estado_civil]))
			? self::$_estados_civis[$this->estado_civil]
			: $this->estado_civil;
	}

	/**
	 * @param bool|false $icone
	 * @param bool|false $puro
	 * @return string
	 */
	public function getChat_Status($icone = false, $puro = false) {
		// Disponivel(D), Ocupado(O), Ausente(A), Invisivel(I), Inativo, Admin(X), Desconectado(Z)

		$esta_online = $this->Online();
		$status = self::Trata_Chat_Status($esta_online, $this->chat_status, $this->getAdmin(), $puro);

		if(!$icone)
			return $status;
		else
			return '<img src="../web/images/status_'.$status.'.png" class="status_icone status_icone_'.$this->getID().'" alt="'.$status.'" />';
	}

	/**
	 * @param bool $html
	 * @param bool $th
	 * @param bool $url
	 * @return string
	 */
	public function getFoto($html = false, $th = false, $url = false) {
		if($this->foto == null)
			return self::getFoto_Padrao($th, $url);
		if($url) {
			return CONFIG_URL . self::URL_FOTOS . (($th) ? $this->foto.'_th.jpg' : $this->foto.'.jpg');
		} else {
			if($th)
				return self::PASTA_FOTOS . (($html) ? $this->foto.'_th.jpg' : $this->foto);
			else
				return self::PASTA_FOTOS . (($html) ? $this->foto.'.jpg' : $this->foto);
		}
	}

	/**
	 * @param bool $th
	 * @param bool $url
	 * @return string
	 */
	public static function getFoto_Padrao($th = false, $url = false) {
		if($url) {
			return CONFIG_URL . self::URL_FOTOS . (($th) ? 'nobody_th.gif' : 'nobody.gif');
		} else {
			if($th)
				return CONFIG_URL.'web/images/nobody_th.gif';
			else
				return CONFIG_URL.'web/images/nobody.gif';
		}
	}

	/**
	 * setSenha
	 *
	 * Define a senha do Usuario, possivelmente codificando-a
	 *
	 * @param $senha A nova senha
	 * @param $codificar (Opcional) Se for true, a senha sera codificada
	 * @return string A nova senha
	 */
	public function setSenha($senha, $codificar = true) {
		// ToDo: Move to controller
		/*if(($codificar) && (strlen($senha) < 3))
			$this->_Erro(new Erro(get_class(), "senha", "A senha precisa ter no mínimo 3 caracteres."));*/
		if($codificar)
			$senha = self::Codificar_Senha($senha);
		return parent::setSenha($senha);
	}

	/**
	 * Codificar_Senha
	 *
	 * @param string $senha A senha a ser codificada
	 * @return string A senha codificada
	 */
	public static function Codificar_Senha($senha) {
		if($senha == null)
			return null;
		return password_hash($senha, PASSWORD_DEFAULT);
	}

	/**
	 * Verificar_Senha_Antiga
	 *
	 * Verifica um hash de senha antiga
	 *
	 * @param string $senha A senha para ser comparada com o hash
	 * @param string $hash O hash para ser comparado
	 * @return boolean Se a senha esta correta
	 */
	public static function Verificar_Senha_Antiga($senha, $hash) {
		return (sha1($senha.CONFIG_SALT_SENHA_ANTIGA) == $hash);
	}

	/**
	 * Verificar_Senha
	 *
	 * Verifica se a senha esta correta para o login fornecido
	 *
	 * @param string $senha A senha a ser verificada
	 * @param boolean $codificada (Opcional) Se a senha ja esta codificada
	 * @return boolean True caso a senha esteja correta, false caso contrario
	 *
	 */
	public function Verificar_Senha($senha, $codificada = true) {
		$hash = $this->getSenha(false);
		if(($codificada === true) && ($hash !== $senha))
			return false; // Senha ja codificada, mas incorreta
		elseif($codificada === false) {
			// Verifica se a senha ja esta no novo formato
			$info = password_get_info($hash);
			if($info['algo'] == 0) { // Senha antiga
				if(self::Verificar_Senha_Antiga($senha, $hash) === false)
					return false; // Senha antiga incorreta
			} elseif(password_verify($senha, $hash) === false) // Senha nova
				return false; // Senha nova incorreta
		}
		return true; // Tudo certo
	}

	/**
	 * Ping
	 *
	 * Chamada em todas as requisicoes, no common, para verificar se esta tudo OK e atualizar ultimo acesso
	 *
	 * @param boolean $verificar (Opcional) Se for false, nao ira verificar o Usuario
	 * @param $atualizar_acesso (Opcional) Se for true, ira atualizar o ultimo acesso
	 * @return Usuario O Usuario atualmente logado
	 */
	public static function Ping($verificar = true, $atualizar_acesso = true) {
		$Usuario = new self();

		if($verificar === false)
			return $Usuario;

		// Verificar COOKIE
		if(isset($_COOKIE[CONFIG_COOKIE_NOME])) {
			$dados = self::Parsear_Cookie($_COOKIE[CONFIG_COOKIE_NOME]);
			$Usuario = self::Load($dados['id']);
			if(($Usuario === null) || ($Usuario->getID() == null)) // Usuario inexistente
				$Usuario = self::Logout();
			if($Usuario->Verificar_Senha($dados['senha'], true) === false) // Senha incorreta
				$Usuario = self::Logout();
			elseif($Usuario->getAtivo() === false) // Usuario inativo
				$Usuario = self::Logout();
		}

		// Se o Usuario continua logado, atualiza o ultimo acesso dele
		if(($Usuario->getID() != null) && ($atualizar_acesso))
			$Usuario->Acesso();

		return $Usuario;
	}

	/**
	 * Verificar_Login
	 *
	 * Tenta efetuar o login, chamado pelo formulario de login
	 * Aproveita e verifica se a hash da senha precisa ser atualizada
	 *
	 * @param string $login Login, RA ou email
	 * @param string $senha A senha fornecida pelo usuario
	 * @param boolean $lembrar (Opcional) Se for true, ira definir a duracao do cookie
	 * @param false|string $erro (Opcional) Se for passado, sera preenchido com o codigo de erro
	 * @return Usuario
	 */
	public static function Verificar_Login($login, $senha, $lembrar = false, &$erro = false) {
		$Usuario = self::Por_Unique($login, null);
		if($Usuario === null) {
			$Usuario = self::Logout(null);
			if($erro !== false)
				$erro = self::ERRO_LOGIN_NAO_ENCONTRADO;
		} elseif($Usuario->Verificar_Senha($senha, false) === false) { // Senha incorreta
			$Usuario = self::Logout(null);
			if($erro !== false)
				$erro = self::ERRO_LOGIN_SENHA_INCORRETA;
		} elseif($Usuario->getAtivo() === false) { // Usuario inativo
			$Usuario = self::Logout();
			if($erro !== false)
				$erro = self::ERRO_LOGIN_USUARIO_INATIVO;
		} else { // Login e senha corretos
			// Verifica se eh necessario atualizar a hash da senha do usuario
			if(password_needs_rehash($Usuario->getSenha(false), PASSWORD_DEFAULT) === true) {
				$nova_senha = Usuario::Codificar_Senha($senha);
				$Usuario->senha = $nova_senha; // Evita iniciar uma transacao desnecessaria
				self::_EM()->createQuery('UPDATE GDE\\Usuario U SET U.senha = ?0 WHERE U.id_usuario = ?1')
					->setParameters(array($nova_senha, $Usuario->getID()))
					->getSingleScalarResult();
			}
		}

		// Salva o cookie do login
		$Usuario->Salvar_Cookie($lembrar);

		// Retorna o Usuario
		return $Usuario;
	}

	/**
	 * Efetuar_Login_DAC
	 *
	 * Efetua login proveniente do portal da DAC
	 *
	 * @param string $token O token fornecido pelo portal da DAC
	 * @param boolean $verificar_horario (Opcional) Se for false, nao ira verificar o horario do token (nao recomendado)
	 * @param bool $erro
	 * @return false|Usuario O Usuario logado (podendo ser vazio ou nao) ou false se o token for invalido
	 */
	public static function Efetuar_Login_DAC($token, $verificar_horario = true, &$erro = false) {
		if($token == null)
			return false;
		list($resultado, $matricula, $tipo) = DAC::Validar_Token($token, $verificar_horario);
		if($resultado === false) {
			$Usuario = self::Logout(null);
			if($erro !== false)
				$erro = self::ERRO_LOGIN_TOKEN_INVALIDO;
		} else {
			switch($tipo) {
				case 'A': // Aluno
					$Usuario = self::Por_Unique($matricula, 'ra');
					break;
				case 'D': // Docente
					$Usuario = self::Por_Unique($matricula, 'matricula');
					break;
				default: // Outros (Funcionarios, etc)
					return false;
			}
			if($Usuario === null)
				return false;

			// Salva o cookie do login
			$Usuario->Salvar_Cookie(false);
		}
		return $Usuario;
	}

	/**
	 * Gerar_Cookie
	 *
	 * Gera os dados do cookie
	 *
	 * @return string Os dados do cookie
	 */
	public function Gerar_Cookie() {
		$iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC);
		$iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
		$this->sid = base64_encode($iv);
		return trim(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, hash("SHA256", CONFIG_SALT, true), $this->getID()."*/*".$this->getSenha(), MCRYPT_MODE_CBC, $iv)."*&/*".$iv));
	}

	/**
	 * Parsear_Cookie
	 *
	 * Parseia os dados do cookie e os retorna
	 *
	 * @param string $cookie Os dados do cookie a serem parseados
	 * @return array|false Uma array contendo o login e a senha ou false
	 */
	public static function Parsear_Cookie($cookie) {
		$dados = explode("*&/*", base64_decode($cookie));
		if(count($dados) < 2) // Algo deu errado
			return false;
		$iv = $dados[1];
		$dados = explode("*/*", trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, hash("SHA256", CONFIG_SALT, true), $dados[0], MCRYPT_MODE_CBC, $iv)));
		if(count($dados) < 2) // Algo deu errado
			return false;
		return array('id' => $dados[0], 'senha' => $dados[1]);
	}

	/**
	 * Cookie_Path
	 *
	 * Retorna o path a ser usado no cookie
	 *
	 * @return string O path a ser usado no cookie
	 */
	public static function Cookie_Path() {
		return parse_url(CONFIG_URL, PHP_URL_PATH);
	}

	/**
	 * Salvar_Cookie
	 *
	 * Salva o cookie
	 *
	 * @param boolean $lembrar (Opcional) Se for true, o cookie nao expirara no final da sessao
	 * @return boolean Se o cookie foi enviado com sucesso
	 */
	public function Salvar_Cookie($lembrar = false) {
		$duracao = ($lembrar) ? time() + (86400 * CONFIG_COOKIE_DIAS) : 0;
		return setcookie(CONFIG_COOKIE_NOME, $this->Gerar_Cookie(), $duracao, self::Cookie_Path(), '', false, true);
	}

	/**
	 * Logout
	 *
	 * Desloga o Usuario e limpa o cookie
	 *
	 * @return Usuario Um objeto Usuario vazio
	 */
	public static function Logout() {
		setcookie(CONFIG_COOKIE_NOME, '', time() - 3600, self::Cookie_Path(), '', false, true);
		return new self();
	}

	/**
	 * Acesso
	 *
	 * Atualiza o ultimo acesso do Usuario, diretamente no banco para evitar uma transacao desncessaria
	 *
	 * @return boolean Se deu certo
	 */
	private function Acesso() {
		if(time() - $this->getUltimo_Acesso('U') < CONFIG_ACESSSO_ATUALIZAR)
			return true;

		$this->ultimo_acesso = new \DateTime();
		$query = self::_EM()->createQuery('UPDATE GDE\\Usuario U SET U.ultimo_acesso = ?0 WHERE U.id_usuario = ?1');
		$query->setParameters(array($this->ultimo_acesso, $this->getID()));
		return ($query->getSingleScalarResult() > 0);
	}

	/**
	 * @param Usuario $Usuario
	 * @return bool|Usuario
	 */
	public function Relacionamento(Usuario $Usuario) { // Este eh meio que um "Amigos em comum"... nao?
		if($this->Amigo($Usuario) !== false)
			return $Usuario;
		else {
			if(count($this->Amigos_Em_Comum($Usuario)) == 0)
				return false;
			return $this->Amigos_Em_Comum($Usuario)->first();
		}
	}

	/**
	 * @param bool|false $live
	 * @return int
	 */
	public static function Conta_Online($live = false) {
		if(($live === false) && (file_exists('../cache/online.txt') === true))
			return intval(file_get_contents('../cache/online.txt'));
		$Data = new \DateTime();
		$Data->modify('-'.CONFIG_TIME_ONLINE.' seconds');
		$online = self::_EM()->createQuery('SELECT COUNT(U.id_usuario) FROM GDE\\Usuario U WHERE U.ultimo_acesso >= ?1')
			->setParameter(1, $Data)
			->getSingleScalarResult();
		// Recorde
		$Dados = Dado::Load(1);
		if($Dados->getMax_Online(false) < $online) {
			$Dados->setMax_Online($online);
			$Dados->setMax_Online_TS();
			$Dados->Save(true);
		}
		return $online;
	}

	/**
	 * Amigos_Em_Comum
	 *
	 * @param Usuario $Usuario
	 * @param int $total
	 * @return ArrayCollection
	 */
	public function Amigos_Em_Comum(Usuario $Usuario, &$total = 0) {
		$Lista = array();
		$ids_amigos = array();
		foreach($Usuario->getAmigos() as $Amigo)
			$ids_amigos[$Amigo->getAmigo()->getID()] = true;
		foreach($this->getAmigos() as $Amigo) // Pego do meu, pq tem os MEUS apelidos!
			if(isset($ids_amigos[$Amigo->getAmigo()->getID()]))
				$Lista[] = $Amigo;
		$total = count($Lista);
		return new ArrayCollection($Lista);
	}

	/**
	 * @param string $minimo
	 * @param string $limite
	 * @param string $start
	 * @return array
	 */
	public function Amigos_Recomendacoes($minimo = '2', $limite = '-1', $start = '-1') {
		$Lista = array();
		// ToDo
		/*$res = self::$db->SelectLimit("SELECT U1.amigo FROM ".self::$tabela_r_amigos." AS U1 JOIN ".self::$tabela_r_amigos." AS U2 ON (U2.amigo = U1.".self::$chave.") WHERE U2.".self::$chave." = '".$this->getID()."' AND U1.amigo != '".$this->getID()."' AND U1.ativo = 't' AND U2.ativo = 't' AND U1.amigo NOT IN (SELECT amigo FROM ".self::$tabela_r_amigos." WHERE ".self::$chave." = '".$this->getID()."') AND U1.amigo NOT IN (SELECT id_usuario FROM ".self::$tabela_r_amigos." WHERE amigo = '".$this->getID()."') GROUP BY U1.amigo HAVING COUNT(U1.amigo) >= ".$minimo." ORDER BY COUNT(U1.amigo) DESC, RAND()", $limite, $start);
		foreach($res as $linha)
			$Lista[] = new Usuario($linha['amigo'], self::$db);*/
		return $Lista;
	}

	/**
	 * getQuase_Amigos
	 *
	 * Retorna a lista de amigos que ainda nao aceitaram o pedido de amizade
	 *
	 * @return ArrayCollection
	 */
	public function getQuase_Amigos() {
		$criteria = Criteria::create()->where(Criteria::expr()->eq("ativo", false));
		$criteria->andWhere(Criteria::expr()->eq("usuario", $this));
		return $this->getAmigos()->matching($criteria);
	}

	/**
	 * @param Usuario $Usuario
	 * @return bool
	 */
	public function Quase_Amigo(Usuario $Usuario) { // Se eu to esperando autorizacao dele...
		foreach($this->getQuase_Amigos() as $Amigo)
			if($Amigo->getAmigo()->getID() == $Usuario->getID())
				return $Amigo;
		return false;
	}

	/**
	 * @param Usuario $Usuario
	 * @return bool|UsuarioAmigo
	 */
	public function Amigo_Pendente(Usuario $Usuario) { // Se ele ta esperando minha autorizacao...
		$criteria = Criteria::create()->where(Criteria::expr()->eq("ativo", false));
		$criteria->andWhere(Criteria::expr()->eq("usuario", $Usuario));
		$criteria->setMaxResults(1);
		$Amigo = $this->getAmigos()->matching($criteria);
		return ($Amigo->count() > 0) ? $Amigo->first() : false;
	}

	/**
	 * @param Usuario $Usuario
	 * @return bool|UsuarioAmigo
	 */
	public function Amigo(Usuario $Usuario) { // Se eh um amigo atualmente
		$criteria = Criteria::create()->where(Criteria::expr()->eq("ativo", true));
		$criteria->andWhere(Criteria::expr()->eq("amigo", $Usuario));
		$criteria->setMaxResults(1);
		$Amigo = $this->getAmigos()->matching($criteria);
		return ($Amigo->count() > 0) ? $Amigo->first() : false;
	}

	/**
	 * @return ArrayCollection Amizades ja autorizadas
	 */
	public function Amigos() { // Lista de amizades ja autorizadas
		$criteria = Criteria::create()->where(Criteria::expr()->eq("ativo", true));
		return $this->getAmigos()->matching($criteria);
	}

	/**
	 * Amigos_Pendentes
	 *
	 * @return ArrayColection Autorizacoes de amizades pendentes
	 */
	public function getAmigos_Pendentes() {
		return UsuarioAmigo::FindBy(array('amigo' => $this->getID(), 'ativo' => false));
	}

	/**
	 * Apelido_Ou_Nome
	 *
	 * @param Usuario $Usuario
	 * @param bool|true $html
	 * @return string
	 */
	public function Apelido_Ou_Nome(Usuario $Usuario, $html = true) {
		$Amigo = $this->Amigo($Usuario);
		if($Amigo !== false)
			return $Amigo->getApelido($html);
		else
			return $Usuario->getNome($html);
	}

	/**
	 * Favorito
	 *
	 * Determina se o $Aluno esta na lista de favoritos deste usuario
	 *
	 * @param Aluno $Aluno
	 * @return bool
	 */
	public function Favorito(Aluno $Aluno) {
		return $this->getFavoritos()->contains($Aluno);
	}

	/**
	 * Cursando
	 *
	 * Retorna true se este Usuario esta cursando a Disciplina / Oferecimento passado
	 *
	 * @param $Disciplina_Oferecimento
	 * @return bool
	 */
	public function Cursando($Disciplina_Oferecimento) {
		if($Disciplina_Oferecimento instanceof Disciplina) {
			return $this->getAluno(true)->Cursou($Disciplina_Oferecimento);
		} elseif($Disciplina_Oferecimento instanceof Oferecimento) {
			return $this->getAluno(true)->getOferecimentos()->contains($Disciplina_Oferecimento);
		} else {
			// Erro!
			return false;
		}
	}

	/**
	 * Tem_Dimensao
	 *
	 * Determina se o aluno deste usuario possui a dimensao do periodo em questao
	 *
	 * @param $Dimensao_dimensoes
	 * @param Periodo $Periodo
	 * @return bool
	 */
	public function Tem_Dimensao($Dimensao_dimensoes, Periodo $Periodo) {
		$dim = $Dimensao_dimensoes instanceof Dimensao;
		if(!$dim && $Dimensao_dimensoes[0] == '????') {
			return false;
		}
		$Atuais = $this->getAluno(true)->getOferecimentos($Periodo->getID());
		foreach($Atuais as $Atual) {
			foreach($Atual->getDimensoes() as $Dimens) {
				if(($dim && $Dimens->getID() == $Dimensao_dimensoes->getID()) || (!$dim && (($Dimens->getSala()->getNome(false) == $Dimensao_dimensoes[0]) && ($Dimens->getDia() == $Dimensao_dimensoes[1]) && ($Dimens->getHorario() == $Dimensao_dimensoes[2])))) {
					return true;
				}
			}
		}
		return false;
	}

	/**
	 * Pode_Cursar
	 *
	 * Retorna true se este Usuario pode cursar a Disciplina
	 *
	 * @param Disciplina $Disciplina
	 * @param bool|string $obs
	 * @return bool
	 */
	public function Pode_Cursar(Disciplina $Disciplina, &$obs = false) {
		// ToDo: Na pos nao pode cursar quando ja cursou a mesma disciplina E turma!
		if(($this->Eliminada($Disciplina, false) !== false) && ($Disciplina->getNivel(false) != Disciplina::NIVEL_POS)) {
			if($obs !== false)
				$obs = 'ja_cursou';
			return false;
		}
		$Pre = $Disciplina->getPre_Requisitos($this);
		if(count($Pre) == 0)
			return true;
		$soh_aa200 = false;
		foreach($Pre as $conjunto) {
			$sobrou = false;
			foreach($conjunto as $pre) {
				$aa200 = false;
				if($this->Eliminou($pre[0], $pre[1]) === false) {
					$sobrou = true;
					break; // Vai pro proximo conjunto, este esta incompleto!
				} elseif($pre[0]->getSigla(false) == 'AA200')
					$aa200 = true;
			}
			if($sobrou === false) { // Nao sobrou pre requisito
				if($aa200 === false)
					return true;
				else
					$soh_aa200 = true;
			}
		}
		if($soh_aa200) { // Nao sobrou pre requisito, mas tinha AA200
			if($obs !== false)
				$obs = 'AA200';
			return true;
		}
		if($obs !== false)
			$obs = 'falta_pre';
		return false;
	}

	/**
	 * Conta_Eliminadas
	 *
	 * @return integer
	 */
	public function Conta_Eliminadas() {
		return $this->getEliminadas()->count();
	}

	/**
	 * Eliminada
	 *
	 * Determina se a Disciplina foi eliminada (sem contar equivalencia)
	 *
	 * @param Disciplina $Disciplina
	 * @param bool $parcial
	 * @param bool $novo_formato
	 * @return UsuarioEliminada|false
	 */
	public function Eliminada(Disciplina $Disciplina, $parcial = false, $novo_formato = false) {
		if($Disciplina->getID() == null)
			return false;

		$dql = 'SELECT E FROM GDE\\UsuarioEliminada E WHERE E.usuario = ?1 AND E.disciplina = ?2';
		$Eliminada = self::_EM()->createQuery($dql)
			->setParameter(1, $this->getID())
			->setParameter(2, $Disciplina->getID())
			->getOneOrNullResult();

		if(
			($Eliminada !== null) &&
			(($parcial === true) ||	($Eliminada->getParcial(false) === false))
		) {
			return ($novo_formato)
				? $Eliminada
				: $Eliminada->toOld();
		} else
			return false;
	}

	/**
	 * Eliminou
	 *
	 * Determina se a Disciplina foi eliminada, seja normalmente, por proficiencia ou por equivalencia
	 *
	 * @param Disciplina $Disciplina
	 * @param bool $parcial
	 * @return array|false
	 */
	public function Eliminou(Disciplina $Disciplina, $parcial = false) {
		if($Disciplina->getID() == null)
			return false;
		// array(array(array(Disc, proficiencia), array(Disc, proficiencia)), equivalencia)
		$eliminada = $this->Eliminada($Disciplina, $parcial, false);
		if($eliminada !== false)
			return array(array($eliminada), false);
		$Equivalentes = $Disciplina->getEquivalentes(false);
		foreach($Equivalentes as $conjunto) {
			$ret = array();
			foreach($conjunto as $Disc) {
				$eliminada = $this->Eliminada($Disc, $parcial, false);
				if($eliminada !== false)
					$ret[] = $eliminada;
			}
			if(count($ret) == count($conjunto))
				return array($ret, true);
		}
		return false;
	}

	/**
	 * Pode_Ver
	 *
	 * Determina se este usuario pode ver $campo do $Usuario
	 *
	 * @param Usuario $Usuario
	 * @param $campo
	 * @return array|bool
	 */
	public function Pode_Ver(Usuario $Usuario, $campo) {
		// Depois vou pegar a permissao de um conjunto, classe, sei la...
		if(($this->getID() == $Usuario->getID()) || ($this->getAdmin() === true))
			return true;
		$minha = $this->getCompartilha($campo);
		if($Usuario->getID() == null) // Aluno sem usuario
			return ($minha != 't') ? array(false, 1) : array(true, null);
		$alheia = $Usuario->getCompartilha($campo);
		if($minha == 'f')
			return array(false, 1);
		if($alheia == 'f')
			return array(false, 2);
		if($this->Amigo($Usuario) === false) {
			if($minha == 'a')
				return array(false, 1);
			if($alheia == 'a')
				return array(false, 2);
		}
		return array(true, null);
	}

	/**
	 * Pode_Mudar_Compartilha_Horairo
	 *
	 * Determina se este usuario pode mudar o compartilhamento de horario
	 *
	 * @param $valor
	 * @return bool
	 */
	public function Pode_Mudar_Compartilha_Horario($valor) {
		if(($valor == $this->compartilha_horario) || ($this->getAdmin()))
			return true;
		$mudanca = $this->getMudanca_Horario('U');
		if(($mudanca == null) || (time() - $mudanca >= 15811200))
			return true;
		elseif(($valor == 't') || ($this->compartilha_horario == 'f' && $valor == 'a'))
			return true;
		else
			return false;
	}

	/**
	 * Formata_Horario
	 *
	 * Retorna o horario deste usuario formatado (HTML)
	 *
	 * @param $Horario
	 * @param $dia
	 * @param $hora
	 * @param $meu
	 * @param Periodo|null $Periodo
	 * @param bool $links
	 * @return string
	 */
	public function Formata_Horario($Horario, $dia, $hora, $meu, Periodo $Periodo = null, $links = true) {
		if(!isset($Horario[$dia][$hora]))
			return "-";
		$formatado = array();
		foreach($Horario[$dia][$hora] as $Oferecimento) {
			$strong_oferecimento = ((!$meu) && ($Periodo !== null) && ($this->Cursando($Oferecimento[0])));
			$strong_sala = ((!$meu) && ($Periodo !== null) && ($this->Tem_Dimensao(array($Oferecimento[1], $dia, $hora), $Periodo)));
			$formatado[] = (($links) ? "<a href=\"".CONFIG_URL."oferecimento/".$Oferecimento[0]->getID()."\" title=\"".$Oferecimento[0]->getDisciplina()->getNome()."\">":null).(($strong_oferecimento)?"<strong>":null).$Oferecimento[0]->getSigla().$Oferecimento[0]->getTurma().(($strong_oferecimento)?"</strong>":null).(($links)?"</a>":null).((($links) && ($Oferecimento[1] != '????'))?"/<a href=\"".CONFIG_URL."sala/".$Oferecimento[1]."\">":"/").(($strong_sala)?"<strong>":null).$Oferecimento[1].(($strong_sala)?"</strong>":null).(($links)?"</a>":null);
		}
		return implode("<br />", $formatado);
	}

	/**
	 * Formata_Horario_Sala
	 *
	 * Retorna o horario de uma sala para este usuario formatado (HTML)
	 *
	 * @param $Horario
	 * @param $dia
	 * @param $hora
	 * @return string
	 */
	public function Formata_Horario_Sala($Horario, $dia, $hora) {
		$formatado = array();
		if(isset($Horario[$dia][$hora])) {
			foreach($Horario[$dia][$hora] as $Oferecimento) {
				$strong = $this->Cursando($Oferecimento);
				$formatado[] = "<a href=\"".CONFIG_URL."oferecimento/".$Oferecimento->getID()."\">".(($strong) ? "<strong>" : "").$Oferecimento->getSigla().$Oferecimento->getTurma().(($strong) ? "</strong>" : "")."</a>";
			}
			return implode("<br />", $formatado);
		} else
			return "-";
	}

	// Soh pra Planejador... Nao salva!
	public function Adicionar_Oferecimentos($Oferecimentos = array()) {
		foreach($Oferecimentos as $Oferecimento)
			$this->getAluno()->addOferecimentos($Oferecimento);
	}

	// Soh pra Planejador... Nao salva!
	public function Remover_Oferecimentos($Oferecimentos = array()) {
		foreach($Oferecimentos as $Oferecimento)
			$this->getAluno()->removeOferecimentos($Oferecimento);
	}

}
