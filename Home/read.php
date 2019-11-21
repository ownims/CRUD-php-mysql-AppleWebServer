<?php
if(isset($_GET["id"])){
    require_once "config.php";
    $sql = "SELECT * FROM professores WHERE id = ?";
    if($stmt = mysqli_prepare($link, $sql)){
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        $param_id = trim($_GET["id"]);
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
            if(mysqli_num_rows($result) == 1){
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                $nome = $row["nome"];
                $disciplina = $row["disciplina"];
                $horario = $row["horario"];
				$curso = $row["curso"];
            } else{
                header("location: error.php");
                exit();
            }
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($link);
} else{
    header("location: error.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Vizualizar Professor</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h1>Vizualizar Professor</h1>
                    </div>
                    <div class="form-group">
                        <label>Nome</label>
                        <p class="form-control-static"><?php echo $row["nome"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Disciplina</label>
                        <p class="form-control-static"><?php echo $row["disciplina"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Horario</label>
                        <p class="form-control-static"><?php echo $row["horario"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Curso</label>
                        <p class="form-control-static"><?php echo $row["curso"]; ?></p>
                    </div>
                    <p><a href="index.php" class="btn btn-primary">Voltar</a></p>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>