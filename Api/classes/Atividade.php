<?php

class Atividade
{
    private PDO $db;
    public function __construct(PDO $dbConnection)
    {
        $this->db = $dbConnection;
    }

    public function salvarAtividade(array $atividadeData): int
    {
        $this->validadeAtividadeData($atividadeData);
        $stmt = $this->db->prepare(
            "INSERT INTO atividades (nome, descricao, dataInicial, dataFinal)
            VALUES (:nome, :descricao, :dataInicial, :dataInicial)"
        );
        $stmt->execute([
            ':nome' => $atividadeData['nome'],
            ':descricao' => $atividadeData['descricao'],
            ':dataInicial' => $atividadeData['dataInicial'],
            ':dataFinal' => $atividadeData['dataFinal'],
        ]);
        return $this->db->lastInsertId();
    }
}
