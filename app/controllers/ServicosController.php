<?php

class ServicosController extends Controller
{

    private $servicoModel;

    public function __construct()
    {

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Instaciar o modelo Servico
        $this->servicoModel = new Servico();
        
    }

    // FRONT-END: Carregar a lista de serviços
    public function index()
    {

        $dados = array();
        $dados['titulo'] = 'Serviços - Ki Oficina';

        // Obter todos os servicos
        $todosServico = $this->servicoModel->getTodosServicos();

        // Passa os serviços para a página
        $dados['servicos'] = $todosServico;
        $this->carregarViews('servicos', $dados);


    }

    // FRONT-END: Carregar o detalhe do serviços
    public function detalhe($link){
        //var_dump("Link: ".$link);

        $dados = array();

        $detalheServico = $this->servicoModel->getServicoPorLink($link);

        //var_dump($detalheServico);

        if($detalheServico){
            
            $dados['titulo'] = $detalheServico['nome_servico'];
            $dados['detalhe'] = $detalheServico;
            $this->carregarViews('detalhe-servicos', $dados);
            
        }else{
            $dados['titulo'] = 'Serviços Ki Oficina';
            $this->carregarViews('servicos', $dados);
        }


    }




    // ###############################################
    // BACK-END - DASHBOARD
    #################################################//

    // 1- Método para listar todos os serviços
    public function listar(){        

        if(!isset($_SESSION['userTipo']) || $_SESSION['userTipo'] !== 'funcionario'){

            header('Location:' . BASE_URL);
            exit;
        }

        $dados = array();
        $func = new Funcionario();
        $dadosFunc = $func->buscarFunc($_SESSION['userEmail']);

        $dados['listaServico'] = $this->servicoModel->getListarServicos();
        $dados['conteudo'] = 'dash/servico/listar';
        $dados['func'] = $dadosFunc;
        $this->carregarViews('dash/dashboard', $dados);


    }

    // 2- Método para adicionar servoços
    public function adicionar(){

        $dados = array();
        $dados['conteudo'] = 'dash/servico/adicionar';

        $this->carregarViews('dash/dashboard', $dados);


    }

    // 3- Método para editar
    public function editar(){

        $dados = array();
        $dados['conteudo'] = 'dash/servico/editar';

        $this->carregarViews('dash/dashboard', $dados);


    }

    // 4- Método para desativar o serviço
    public function desativar(){

        $dados = array();
        $dados['conteudo'] = 'dash/servico/desativar';

        $this->carregarViews('dash/dashboard', $dados);


    }



    
}
