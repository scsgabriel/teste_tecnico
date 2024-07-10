<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de Contratos</title>
</head>
<body>
    <h1>Lista de Contratos</h1>
    <form action="" method="GET">
        <input name="busca" placeholder="Digite o número do contrato" type="text" value="<?php echo isset($_GET['busca']) ? htmlspecialchars($_GET['busca']) : ''; ?>">
        <button type="submit">Buscar</button>
        <button type="button" onclick="limpar()">Limpar</button>
    </form>
    <br>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['busca'])) {
        $servidor = "localhost";
        $banco = "averbacoes";
        $usuario = "root"; 
        $senha = ""; 

        $conexao = new mysqli($servidor, $usuario, $senha, $banco);

        if ($conexao->connect_error) {
            die("Conexão falhou: " . $conexao->connect_error);
        }

        $codigo_contrato = $_GET['busca'];

        if (empty($codigo_contrato)) {
            $sql = "SELECT 
                        tb_banco.nome AS banco,
                        tb_convenio.verba,
                        tb_contrato.codigo AS codigo_contrato,
                        DATE_FORMAT(tb_contrato.data_inclusao, '%d/%m/%Y') AS data_inclusao,
                        CONCAT('R$', FORMAT(tb_contrato.valor, 2)) AS valor_formatado,
                        CONCAT(tb_contrato.prazo, ' meses') AS prazo_formatado
                    FROM 
                        tb_contrato
                    JOIN 
                        tb_convenio_servico ON tb_contrato.convenio_servico = tb_convenio_servico.codigo
                    JOIN 
                        tb_convenio ON tb_convenio_servico.convenio = tb_convenio.codigo
                    JOIN 
                        tb_banco ON tb_convenio.banco = tb_banco.codigo";
            $statement = $conexao->prepare($sql);
        } else {
            $sql = "SELECT 
                        tb_banco.nome AS banco,
                        tb_convenio.verba,
                        tb_contrato.codigo AS codigo_contrato,
                        DATE_FORMAT(tb_contrato.data_inclusao, '%d/%m/%Y') AS data_inclusao,
                        CONCAT('R$', FORMAT(tb_contrato.valor, 2)) AS valor_formatado,
                        CONCAT(tb_contrato.prazo, ' meses') AS prazo_formatado
                    FROM 
                        tb_contrato
                    JOIN 
                        tb_convenio_servico ON tb_contrato.convenio_servico = tb_convenio_servico.codigo
                    JOIN 
                        tb_convenio ON tb_convenio_servico.convenio = tb_convenio.codigo
                    JOIN 
                        tb_banco ON tb_convenio.banco = tb_banco.codigo
                    WHERE 
                        tb_contrato.codigo = ?";
            $statement = $conexao->prepare($sql);
            $statement->bind_param("i", $codigo_contrato);
        }

        $statement->execute();
        $result = $statement->get_result();

        if ($result->num_rows > 0) {
            echo '<table width="800px" border="1">
                  <tr>
                    <th>Banco</th>
                    <th>Verba</th>
                    <th>Código do Contrato</th>
                    <th>Data de Inclusão</th>
                    <th>Valor</th>
                    <th>Prazo</th>
                  </tr>';

            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['banco']}</td>
                        <td>{$row['verba']}</td>
                        <td>{$row['codigo_contrato']}</td>
                        <td>{$row['data_inclusao']}</td>
                        <td>{$row['valor_formatado']}</td>
                        <td>{$row['prazo_formatado']}</td>
                      </tr>";
            }

            echo '</table>';
        } else {
            echo "<p>Nenhum contrato encontrado.</p>";
        }

        $statement->close();
        $conexao->close();
    }
    ?>

    <script>
        function limpar() {
            document.querySelector('input[name="busca"]').value = '';
            window.location.href = 'index.php'; 
        }
    </script>
</body>
</html>
