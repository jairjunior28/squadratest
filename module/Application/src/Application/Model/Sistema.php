<?php

namespace Application\Model;

use Doctrine\ORM\Mapping as ORM;
use Zend\Paginator\Paginator;
use DoctrineORMModule\Paginator\Adapter;

/**
 * Sistema
 *
 *
 *
 *
 * annotations do ORM Doctrine ORM MODULE usado para mapear o banco de dados relacional.
 *
 * @ORM\Table(name="sistema")
 * @ORM\Entity
 */
class Sistema
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="descricao", type="string", length=100, nullable=false)
     */
    private $descricao;

    /**
     * @var string
     *
     * @ORM\Column(name="sigla", type="string", length=10, nullable=false)
     */
    private $sigla;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=100, nullable=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=50, nullable=true)
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(name="usuario", type="string", length=100, nullable=true)
     */
    private $usuario;

    /**
     * @var string
     *
     * @ORM\Column(name="justificativa", type="string", length=500, nullable=false)
     */
    private $justificativa;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data", type="datetime", nullable=false)
     */
    private $data;



    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=10, nullable=false)
     */
    private $status;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * @param string $descricao
     */
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }

    /**
     * @return string
     */
    public function getSigla()
    {
        return $this->sigla;
    }

    /**
     * @param string $sigla
     */
    public function setSigla($sigla)
    {
        $this->sigla = $sigla;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * @param string $usuario
     */
    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;
    }

    /**
     * @return string
     */
    public function getJustificativa()
    {
        return $this->justificativa;
    }

    /**
     * @param string $justificativa
     */
    public function setJustificativa($justificativa)
    {
        $this->justificativa = $justificativa;
    }



    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return \DateTime
     */
    public function getData()
    {

        return $this->data->format('d-m-Y H:i:s');
    }

    //modifica o banco pegando a hora atual
    public function setData()
    {
        $this->data=new \DateTime('now');

    }

    /**
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    
    public function pesquisaSistema($descricao=null,$sigla=null,$email=null,$page,$em)
    {


        $qb = $em->createQueryBuilder();
        /****
         * chamada de funcao para criacao de query de busca
         *
         */
        $qb->select('s')
            ->from('\Application\Model\Sistema', 's')
            ->orderBy('s.descricao')
            ->where('s.descricao LIKE :descricao')
            ->andWhere('s.sigla LIKE :sigla')
            ->setParameter('descricao', '%' . $descricao . '%')
            ->setParameter('sigla', '%' . $sigla . '%');
        if (!empty($email)) {
            $qb->andWhere('s.email = :email')
                ->setParameter('email', $email);
        }
        $query = $qb->getQuery()->getResult();
        $paginator = new Paginator(new \Zend\Paginator\Adapter\ArrayAdapter($query));
        /****
         * Variavel recebe nova instancia do Paginator recebendo
         * como parametro um novo objeto sendo passado como parametro o resultado da
         * busca para adaptar os dados de forma que o paginator possa
         * fazer o fetch na tabela
         *
         */

        $paginator->setCurrentPageNumber($page)// Seta pagina atual
        ->setItemCountPerPage(50)// Seta quantidade de registros por pagina
        ->setPageRange(10);// Seta numero maximo de pagina a exibir na paginacao
        return $paginator;
        
    }


}
