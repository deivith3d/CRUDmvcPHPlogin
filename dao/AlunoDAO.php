<?php

    class AlunoDAO {

        public function cadastraAluno(AlunoModel $aluno){
            include_once 'Conexao.php';
            $conex = new Conexao();
            $conex->fazConexao();
            $sql = "INSERT INTO aluno (nomeAlu, matriculaAlu, cpfAlu, idadeAlu, emailAlu) VALUES (:nome, :matricula, :cpf, :idade, :email)";
            $stmt = $conex->conn->prepare($sql);
            $stmt->bindValue(':nome',$aluno->getNome());
            $stmt->bindValue(':matricula',$aluno->getMatricula());
            $stmt->bindValue(':cpf',$aluno->getCpf());
            $stmt->bindValue(':idade',$aluno->getIdade());
            $stmt->bindValue(':email',$aluno->getEmail());
            $res = $stmt->execute();
            if($res)
            {
                echo "<script>alert('Cadastro Realizado com sucesso');</script>";
            }
            else{
                echo "<script>alert('Erro: Não foi possível realizar o cadastro');</script>";
            }
            echo "<script>location.href='../controller/processaAluno.php?op=Listar';</script>";
        }

        public function listarAlunos()
        {
            include_once 'Conexao.php';
            $conex = new Conexao();
            $conex->fazConexao();
            $sql= "SELECT * FROM aluno ORDER BY idAlu";
            return $conex->conn->query($sql);
        }

        public function resgataPorID($idAluno){
            include_once 'Conexao.php';
            $conex = new Conexao();
            $conex->fazConexao();
            $sql= "SELECT * FROM aluno WHERE idAlu='$idAluno'";
            return $conex->conn->query($sql);
        }

        public function alterarAluno(AlunoModel $aluno){
            include_once 'Conexao.php';
            $conex = new Conexao();
            $conex->fazConexao();
            $sql = "UPDATE aluno SET nomeAlu = :nome, matriculaAlu = :matricula, cpfAlu = :cpf, idadeAlu = :idade, emailAlu = :email WHERE idAlu = :id";
            $stmt = $conex->conn->prepare($sql);
            $stmt->bindValue(':id',$aluno->getID());
            $stmt->bindValue(':nome',$aluno->getNome());
            $stmt->bindValue(':matricula',$aluno->getMatricula());
            $stmt->bindValue(':cpf',$aluno->getCpf());
            $stmt->bindValue(':idade',$aluno->getIdade());
            $stmt->bindValue(':email',$aluno->getEmail());
            $res = $stmt->execute();
            if($res)
            {
                echo "<script>alert('Registro Alterado com sucesso');</script>";
            }
            else{
                echo "<script>alert('Erro: Não foi possível alterar o cadastro');</script>";

            }
            echo "<script>location.href='../controller/processaAluno.php?op=Listar';</script>";
        }

        public function excluirAluno($idAluno){
            include_once 'Conexao.php';
            $conex = new Conexao();
            $conex->fazConexao();
            $sql= "DELETE FROM aluno WHERE idAlu='$idAluno'";
            $res = $conex->conn->query($sql);
            if($res)
            {
                echo "<script>alert('Exclusão realizada com sucesso!');</script>";
            }
            else
            {
                echo "<script>alert('Não foi possível excluir o usuário!');</script>";
            }
            echo "<script>location.href='../controller/processaAluno.php?op=Listar';</script>";
        }
    }
?>