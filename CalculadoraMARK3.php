

<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $a = $_POST["a"];
        $b = $_POST["b"];

        $operador = $_POST["operador"];
        $resultado = 0;
        $erro ='qw';

// Eu descobri que o metodo POST faz as variaves virarem Strings, 
// Isso aqui é para verificar se são String numericas para as transformar em inteiros.
        if(is_numeric($a) && is_numeric($b))
        {
            $a = (int)$a;
            $b = (int)$b;
        }

// Aqui se verifica se as duas variaveis foram transformadas em inteiros
        if(is_int($a) && is_int($b)) {
            if ($operador == "soma") {
                $resultado = $a + $b;
            } elseif ($operador == "sub") {
                $resultado = $a - $b;
            } elseif ($operador == "multi") {
                $resultado = $a * $b;
            } elseif ($operador == "divide") {
                // If para a verificação de divisão com zero.
                if($b != 0){
                    $resultado = $a / $b;
                }
                else{
                    $erro = "Uma divisão por zero não existe.";
                }    
            } elseif ($operador == "potencia") {
                $resultado = pow($a, $b);
            } elseif ($operador == "raiz"){
                // decidi usar a função pow na operação de raiz, 
                // porque só é preciso fazer o $b virar um divisão de 1.
                $resultado = pow($a, 1/$b);
            }
            else
                $erro = "Operador não definido";
            }
        } else {
            $erro = "As variáveis 'a' e 'b' precisam ser números inteiros.";
        }
?>

<!DOCTYPE html>
<html>
<body>
    <h1><?php echo 'Minha Calculadora!'; ?></h1>
    <hr>
    <form method='POST' action='CalculadoraMARK3.php'>
        a:<input type=text name='a'><br>
        b:<input type=text name='b'><br>
        <hr>
        <br>Operação: 
            <br><input type="radio" name="operador" value="soma"> Soma
            <br><input type="radio" name="operador" value="sub"> Subtrai
            <br><input type="radio" name="operador" value="multi">Multiplica
            <br><input type="radio" name="operador" value="divide">Divide
            <br><input type="radio" name="operador" value="potencia">Potencia
            <br><input type="radio" name="operador" value="raiz">Raiz
        <br>
        <input type=submit value='Calcular'>
        <br><br>
        <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if ($erro ==  'qw')
                {
                    echo 'Resultado: ' . $resultado; 
                } else {
                    echo 'Erro: ' . $erro;
                }
                
            } 
        ?> 
</body>
</html>

