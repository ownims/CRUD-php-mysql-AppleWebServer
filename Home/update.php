<?php
require_once "config.php";
$nome = $disciplina = $horario = $curso = "";
$nome_err = $disciplina_err = $horario_err= $curso_err = "";
if(isset($_POST["id"]) && !empty($_POST["id"])){
    $id = $_POST["id"];
	//
    $input_nome = trim($_POST["nome"]);
    if(empty($input_nome)){
        $nome_err = "Por favor insira um nome.";
    } elseif(!filter_var($input_nome, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $nome_err = "Por favor, indique um nome válido.";
    } else{
        $nome = $input_nome;
    }
	//
	$input_disciplina = trim($_POST["disciplina"]);
    if(empty($input_disciplina)){
        $disciplina_err = "Por favor insira uma disciplina.";
    } elseif(!filter_var($input_disciplina, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $disciplina_err = "Por favor, indique uma disciplina válida.";
    } else{
        $disciplina = $input_disciplina;
    }
	//
	$input_horario = trim($_POST["horario"]);
    if(empty($input_horario)){
        $horario_err = "Por favor insira um horario.";
    } elseif(!filter_var($input_horario, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $horario_err = "Por favor, indique um horario válido.";
    } else{
        $horario = $input_horario;
    }
	//
	$input_curso = trim($_POST["curso"]);
    if(empty($input_curso)){
        $curso_err = "Por favor insira um curso.";
    } elseif(!filter_var($input_curso, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $curso_err = "Por favor, indique um curso válido.";
    } else{
        $curso = $input_curso;
    }
    //
    if(empty($nome_err) && empty($disciplina_err) && empty($horario_err)&& empty($curso_err)){
        $sql = "UPDATE professores SET nome=?, disciplina=?, horario=?, curso=? WHERE id=?";
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "ssssi", $param_nome, $param_disciplina, $param_horario, $param_curso, $param_id);
            $param_nome = $nome;
            $param_disciplina = $disciplina;
            $param_horario = $horario;
			$param_curso = $curso;
            $param_id = $id;
            if(mysqli_stmt_execute($stmt)){
                header("location: index.php");
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
        mysqli_stmt_close($stmt);
    }
    mysqli_close($link);
} else{
    if(isset($_GET["id"]) ){
        $id =  trim($_GET["id"]);
        $sql = "SELECT * FROM professores WHERE id = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            $param_id = $id;
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
				echo $stmt->error;
                echo "Opa! Algo deu errado. Por favor, tente novamente mais tarde.";
            }
        }
        mysqli_stmt_close($stmt);
        mysqli_close($link);
    }  else{
        header("location: error.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Editar Professor</title>
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
                        <h2>Editar Professor</h2>
                    </div>
                    <p>Edite os valores desejados e envie para atualizar o professor.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group <?php echo (!empty($nome_err)) ? 'has-error' : ''; ?>">
                            <label>Nome</label>
                            <input type="text" name="nome" class="form-control" value="<?php echo $nome; ?>">
                            <span class="help-block"><?php echo $nome_err;?></span>
                        </div>
						
						<div class="form-group <?php echo (!empty($disciplina_err)) ? 'has-error' : ''; ?>">
                            <label>Disciplina</label>
                            <input type="text" name="disciplina" class="form-control" value="<?php echo $disciplina; ?>">
                            <span class="help-block"><?php echo $disciplina_err;?></span>
                        </div>
						
						<div class="form-group <?php echo (!empty($horario_err)) ? 'has-error' : ''; ?>">
                            <label>Horario</label>
                            <input type="text" name="horario" class="form-control" value="<?php echo $horario; ?>">
                            <span class="help-block"><?php echo $horario_err;?></span>
                        </div>
						
						<div class="form-group <?php echo (!empty($curso_err)) ? 'has-error' : ''; ?>">
                            <label>Curso</label>
                            <input type="text" name="curso" class="form-control" value="<?php echo $curso; ?>">
                            <span class="help-block"><?php echo $curso_err;?></span>
                        </div>
						
						
                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Enviar">
                        <a href="index.php" class="btn btn-default">Cancelar</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>