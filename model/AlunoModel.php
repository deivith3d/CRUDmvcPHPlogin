<?php
    class AlunoModel {
        // Atributos
        protected $nome;
        protected $matricula;
        protected $cpf;
        protected $idade;
        protected $email;
        protected $id;

        // Construtor
        public function __construct($id,$nome, $matricula, $cpf, $idade, $email) {
            $this->id = $id;
            $this->nome = $nome;
            $this->matricula = $matricula;
            $this->cpf = $cpf;
            $this->idade = $idade;
            $this->email = $email;
        }

        public function getID()
        {
            return $this->id;
        }

        public function getNome()
        {
            return $this->nome;
        }

        public function setNome($nome)
        {
            $this->nome = $nome;
            return $this;
        }

        public function getMatricula()
        {
            return $this->matricula;
        }

        public function setMatricula($matricula)
        {
            $this->matricula = $matricula;
            return $this;
        }

        public function getCpf()
        {
                return $this->cpf;
        }

        public function setCpf($cpf)
        {
                $this->cpf = $cpf;
                return $this;
        }
            
        public function getIdade()
        {
            return $this->idade;
        }

        public function setIdade($idade)
        {
            $this->idade = $idade;

            return $this;
        }
    
        public function getEmail()
        {
            return $this->email;
        }

        public function setEmail($email)
        {
            $this->email = $email;

            return $this;
        }

        public function cadastrarAluno(AlunoModel $aluno)
        {
            include_once '../dao/AlunoDAO.php';
            $aluno = new AlunoDAO();
            $aluno->cadastraAluno($this);
        }

        public function listarAlunos()
        {
            include '../dao/AlunoDAO.php';
            $dao = new AlunoDAO(null);
            return $dao->listarAlunos();
        }

        public function resgataPorID($idAluno){
            include '../dao/AlunoDAO.php';
            $model = new AlunoDAO(null);
            return $model->resgataPorID($idAluno);

        }

        public function alterarAluno(AlunoModel $aluno)
        {
            include_once '../dao/AlunoDAO.php';
            $aluno = new AlunoDAO();
            $aluno->alterarAluno($this);
        }

        public function excluirAluno($idAluno)
        {
            include_once '../dao/AlunoDAO.php';
            $aluno = new AlunoDAO();
            $aluno->excluirAluno($idAluno);
        }
    }
?>