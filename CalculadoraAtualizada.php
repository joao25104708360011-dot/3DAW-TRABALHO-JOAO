
<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $a = $_POST["a"];
        $b = $_POST["b"];
        if (isset($_POST['op'])) {
            $selecionado = $_POST['op'];
        }
        if ($selecionado == 'soma') {
            $resul = $a + $b;
        }
        else{
            if($selecionado == 'subtração'){
                $resul = $a - $b;
            }
            else{
                if($selecionado == 'multiplicação'){
                    $resul = $a * $b;
                }
                else{
                    if($selecionado == 'divisão'){
                        $resul = $a / $b;
                    }    
                }
            }
        }
}
?>
<!DOCTYPE html>
<html>
<body>
<h1><?php echo 'Minha Calculadora!';?></h1>
<hr>
<form method='POST' action='CalculadoraAtualizada.php'>
    a:<input type=text name='a'><br>
    b:<input type=text name='b'><br>
    <hr>
    <label for="op">Selecione o tipo de operação:</label><br>
    <select name="op" id="op">
        <option value="soma" >Soma</option>
        <option value="subtração">Subtração</option>
        <option value="multiplicação">Multiplicação</option>
        <option value="divisão">Divisão</option>
    </select>
    <input type=submit value='Calcular'>
    <br><br>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        echo 'Resultado: ' . $resul; 
}
?>
    
</body>
</html>
