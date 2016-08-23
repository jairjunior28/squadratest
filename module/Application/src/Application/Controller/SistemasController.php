<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Controller\DAOSistemas;
use Zend\Paginator\Paginator;
use DoctrineORMModule\Paginator\Adapter;

class SistemasController extends AbstractActionController
{
    public function indexAction()
    {
        $request = $this->getRequest();
        $sistema=new DAOSistemas();
        $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
        $sistema->pesquisarSistema($request,$em);


        



        

        


        

        
    }
        /*$result = array();
        try {

            $descricao = $request->getQuery('descricao');
            $sigla = $request->getQuery('sigla');
            $email =$request->getQuery('email');
            $page =$request->getQuery('page');
        }
        catch (Exception $e)
        {
            echo $e;
        }

        /****
         * verificação se houve alguma requisicao via metodo HTTP
         * GET
         *
         */



        /****
         * verificação das variaveis se estão vazias
         * recebidas por GET anterior
         *
         */

/*
        if (!empty($email) && (!preg_match("^[a-z0-9_\.\-]+@[a-z0-9_\.\-]*[a-z0-9_\-]+\.[a-z]{2,8}$^", strtolower($email)))){
            $result["resp"] = "E-mail inválido";
            $this->flashMessenger()->addErrorMessage($result["resp"]);

            return new ViewModel();
        }

        if (!empty($descricao) || !empty($sigla) || (!empty($email))) {
            /****
             *
             *Obtendo uma instancia do Entity Manager. do Orm
             */
/*
            $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
            /****
             * se page estiver vazio então direciona a pagina 1
             *
             */

  /*          if (empty($_GET['page']))
                $page = 1;

            /****
             * se page estiver vazio então direciona a pagina 1
             *
             */
/*
            $qb = $em->createQueryBuilder();
            /****
             * chamada de funcao para criacao de query de busca
             *
             */
  /*          $qb->select('s')
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

            /****
             *  criacao de query de busca
             *
             */
    /*        $query = $qb->getQuery()->getResult();
            /****
             * Obtendo resultados
             *
             */
      /*      if ($query)
            {
                /****
                 * caso possua resultados
                 *
                 */

        /*        $paginator = new Paginator(new \Zend\Paginator\Adapter\ArrayAdapter($query));
                /****
                 * Variavel recebe nova instancia do Paginator recebendo
                 * como parametro um novo objeto sendo passado como parametro o resultado da
                 * busca para adaptar os dados de forma que o paginator possa
                 * fazer o fetch na tabela
                 *
                 */
/*
                $paginator->setCurrentPageNumber($page)// Seta pagina atual
                ->setItemCountPerPage(50)// Seta quantidade de registros por pagina
                ->setPageRange(10);// Seta numero maximo de pagina a exibir na paginacao
                $this->flashMessenger()->clearCurrentMessagesFromContainer();
                return new ViewModel(array('lista' => $paginator, 'descricao' => $descricao, 'sigla' => $sigla, 'email' => $email));

            } else
            {
                /****
                 * caso contrário
                 *
                 */
  /*              $result["resp"] = "Nenhum Sistema foi encontrado. Favor revisar os critérios da sua pesquisa.";
                $this->flashMessenger()->addErrorMessage($result["resp"]);

                return new ViewModel();
            }


        }
        else {
            $result["resp"] = "Nenhum Sistema foi encontrado. Favor revisar os critérios da sua pesquisa.";
            $this->flashMessenger()->addErrorMessage($result["resp"]);

            return new ViewModel();
        }
*/
  
    public function limparAction()
    {
        /****
     * limpa as mensagens e direciona a rota sistemas
     *
     *
     */
        $this->flashMessenger()->clearCurrentMessagesFromContainer();
        
        $this->redirect()->toRoute('sistemas');

    }
    public function cadastrarAction()
    {
        /****
         * limpa todos os flashmessenger caso possua
         *
         */

        $this->flashMessenger()->clearCurrentMessagesFromContainer();

        /****
         * pega requisicao
         *
         */

        $request = $this->getRequest();
        $result = array();//declaracao de array para envio de resposta a view
        if($request->isPost())//detecta s o metodo de requisicao é post
        {
            ///tenta pegar os dados
            try
            {
                $descricao = $request->getPost("descricao");
                $sigla = $request->getPost("sigla");
                $email = $request->getPost("email");
                $url = $request->getPost("url");
            }  catch (Exception $e)
            {
            }
            //valida  email com expressão regular formato (x@x.xx)
            if (!empty($email) && (!preg_match("^[a-z0-9_\.\-]+@[a-z0-9_\.\-]*[a-z0-9_\-]+\.[a-z]{2,8}$^", strtolower($email))))
            {
              $  
                $result["resp"] = "<div class='alert alert-danger'><a href='#' class='close'>&times;</a>E-mail inválido </div>";
                //retorno caso email invalido à view
                return new ViewModel(array('resp'=>$result["resp"]));
            }

            $justificativa="criacao";
                $status="Ativo";

            //testanto se as variaveis obrigatoórias estão setadas  e se por um acaso não ultrapassa o tamanho
            //máximo definido para elas no banco apesar de estar setado maxlength nas views, pois o usuário pode
            //muito bem burlar e colocar mais caracteres, nesse caso não será salvo
            if(((!empty($descricao)) && (strlen($descricao)<=100)) &&( (!empty($sigla)) && (strlen($sigla)<=10) )&&
                (!empty($status))&&(strlen($email)<=100) &&(strlen($url)<=50) && (!empty($justificativa))
            )
            {
                //obtem uma instacia do EntityManager
                $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
                //obtem uma instacia da Classe Modelo Sistema
                $sistema = new Sistema();
                //setendo valores
                $sistema->setDescricao($descricao);
                $sistema->setSigla($sigla);

                $sistema->setEmail($email);
                $sistema->setUrl($url);
                $sistema->setData();//set seta não recebe parametros pois fiz a definicação na classe modelo
                // qual seta a hora atual. Útil apenas para criação, sabendo que a tabela em updates pega a
                // hora atual automaticamente após a execução da intrução update

                $sistema->setUsuario("Jair");
                $sistema->setJustificativa($justificativa);
                $sistema->setStatus("Ativo");
                //$em->persist($sistema);
                //$em->flush();
                //linha que grava o objeto no banco sendo passado o objeto como parâmetro
                $em->persist($sistema);
                //variavel que recebe o retorno a ser enviado para ser recuperado na view
                $result["resp"] =   "Operação realizada com sucesso.";

                $em->flush();//limpa

                $this->flashMessenger()->addSuccessMessage($result["resp"]);
                //voltar ao passo 2 do fluxo basico
                $this->redirect()->toRoute('sistemas',array('resp'=>$result["resp"]));


                //return new ViewModel(array('resp'=>$result["resp"]));para voltar a mesma tela


                }
                else {
                    //caso algum campo obrigatório esteja faltando ou contenham tamanho de palavra maior que o permitido
                    //é apresentado este erro.
                    $result["resp"] = "<div class='alert alert-dismissible alert-danger'><a href='#' class='close'>&times;</a>Dados obrigatórios não informados.</div>";

                    return new ViewModel(array('resp'=>$result["resp"]));
                }
        }
        return new ViewModel();
    }
    
    public function editarAction()
    {
        $id = $this->params()->fromRoute("id", 0);
        $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");

        $sistema = $em->find("Application\Model\Sistema", $id);
        $request = $this->getRequest();
        $result = array();
        if($request->isPost())
        {
            try{
                $descricao = $request->getPost("descricao");
                $sigla = $request->getPost("sigla");
                $email = $request->getPost("email");
                $url = $request->getPost("url");
                $justificativa=$request->getPost("justificativa");
                $status=$request->getPost("status");
                $sistema->setDescricao($descricao);
                $sistema->setSigla($sigla);
                $sistema->setEmail($email);
                $sistema->setUrl($url);
                $sistema->setUsuario("Jair");
                $sistema->setJustificativa($justificativa);
                $sistema->setData();
                $sistema->setStatus($status);
                //validacao de email
                if (!empty($email) && (!preg_match("^[a-z0-9_\.\-]+@[a-z0-9_\.\-]*[a-z0-9_\-]+\.[a-z]{2,8}$^", strtolower($email))))
                {
                    $result["resp"] = "<div class='alert alert-danger'><a href='#' class='close'>&times;</a>E-mail inválido </div>";

                    return new ViewModel(array('f' => $sistema,'resp'=>$result["resp"]));
                }


                $url = $request->getPost("url");
                if(((!empty($descricao)) && (strlen($descricao)<=100)) &&( (!empty($sigla)) && (strlen($sigla)<=10) )&&
                    (!empty($status))&&(strlen($email)<=100) && (strlen($url)<=50) && (!empty($justificativa) )&&
                    (strlen($justificativa)<=500))
                 {


                    $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
                    $em->merge($sistema);
                    $em->flush();
                     $result["resp"] =   "Operação realizada com sucesso.";
                     $this->flashMessenger()->addSuccessMessage($result["resp"]);
                     $this->redirect()->toRoute('sistemas',array('resp'=>$result["resp"]));

                     //return new ViewModel(array('f' => $sistema, 'resp' => $result['resp']));

                }
                else {
                    $result["resp"] = "<div class='alert alert-dismissible alert-danger'><a href='#' class='close'>&times;</a>Dados obrigatórios não informados.</div>";

                    return new ViewModel(array('f' => $sistema, 'resp' => $result['resp']));
                }

            }  catch (Exception $e){
                
            }


        }

        
        return new ViewModel(array('f' => $sistema));
    }

}
