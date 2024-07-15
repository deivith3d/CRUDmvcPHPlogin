   <?php 
      switch($_REQUEST["op"])
      {
            case "Incluir": 
                  incluir();break;
            case "Alterar": 
                  alterar();break;
            case "Excluir": 
                  excluir();break;
            case "Listar": 
                  listar();break;
            default: 
                  echo "nao encontrou chave";
      }

      function incluir(){
         $nome = $_POST["nome"];
         $matricula = $_POST["matricula"];    
         $cpf = $_POST["cpf"];
         $idade = $_POST["idade"];
         $email = $_POST["email"];
         include 'AlunoController.php';
         $contr = new AlunoController();
         $contr->cadastrarAluno($nome, $matricula, $cpf, $idade, $email);
      }
      
      function alterar(){
         $nome = $_POST["nome"];
         $matricula = $_POST["matricula"];    
         $cpf = $_POST["cpf"];
         $idade = $_POST["idade"];
         $email = $_POST["email"];
         $id = $_POST["idAluno"];
         include 'AlunoController.php';
         $contr = new AlunoController();
         $contr->alterarAluno($id,$nome, $matricula, $cpf, $idade, $email);
      }

      function excluir(){
         $id = $_REQUEST["idAluno"];
         include 'AlunoController.php';
         $contr = new AlunoController();
         $contr->excluirAluno($id);
      }

      function listar()
      {
         include '../view/formListarAluno.php';
      }
?>