<?php
    class AlunoController{
        public static function cadastrarAluno($nome, $matricula, $cpf, $idade, $email)
        {
            include '../model/AlunoModel.php';
            $aluno = new AlunoModel(null,$nome, $matricula, $cpf, $idade, $email);
            $aluno->cadastrarAluno($aluno);
        }

        public static function listarAlunos()
        {
            include '../model/AlunoModel.php';
            $model = new AlunoModel(null,null,null,null,null,null);
            return $model->listarAlunos();
        }

        public static function resgataPorID($idAluno){
            include '../model/AlunoModel.php';
            $model = new AlunoModel(null,null,null,null,null,null);
            return $model->resgataPorID($idAluno);

        }

        public static function alterarAluno($id,$nome, $matricula, $cpf, $idade, $email)
        {
            include '../model/AlunoModel.php';
            $aluno = new AlunoModel($id,$nome,$matricula, $cpf, $idade, $email);
            $aluno->alterarAluno($aluno);
        }

        public static function excluirAluno($id)
        {
            include '../model/AlunoModel.php';
            $aluno = new AlunoModel(null,null,null,null,null,null);
            $aluno->excluirAluno($id);
        }
    }
?>