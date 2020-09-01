<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="../Fetching_records_DB/css/style.css">
</head>
<body>
    <?php 
      $dbhost 	= "localhost";
	    $dbname		= "supermercado";
	    $dbuser		= "root";
	    $dbpass		= "";
      $conn = new PDO("mysql:host=$dbhost;dbname=$dbname",$dbuser,$dbpass);
      $sql = "SELECT id, nombre  FROM categoria";
      $q = $conn->prepare($sql);
      $result = $q->execute();
      $categoria = $q->fetchAll();   
    ?>
    <div class="row mx-0">
      <div class="col-2 ">
      </div>
      <div class="col-8 ">
      <h4 class="mt-4 text-center">Buscador PHP</h4>
        <hr>
        <ul class="list-group-item">
        <form method="post">
          <div class="row">
            <div class="form-group col-4">
              <label>Nombre</label>
              <input name="nombre" type="text" class="form-control" placeholder="Ingrese palabra clave">
            </div>
            <div class="form-group col-4">
              <label>Precio</label>
              <input name="precio" type="number" class="form-control" placeholder="Ingrese palabra clave">
            </div>
            <div class="form-group col-4">
              <label>Categoria</label>
              <select class="form-control" name="id_categoria">
                    <option value="">Seleccione una categoria...</option>
                    <?php
                      for($i=0; $i < count($categoria); $i++){
                    ?>
                    <option class="text-capitalize" value="<?php echo $categoria[$i]["id"];?>"><?php echo $categoria[$i]["nombre"];?></option>
                    <?php
                      }
                    ?>
              </select> 
            </div>
          </div>
          <div class="text-center">
          <button type="submit" class="btn btn-primary">Buscar Ahora</button>
          </div>
          
        </form>
        </ul>
        <?php
        if($_POST){
          if ($_REQUEST["nombre"]!="" && $_REQUEST["precio"]!="" && $_REQUEST["id_categoria"]!="") {
            $aKeyword = explode(" ", $_POST['nombre']);
            $aKeyword2 = explode(" ", $_POST['precio']);
            $aKeyword3 = explode(" ", $_POST['id_categoria']);
            $sql ="SELECT * FROM productos WHERE  nombre like '%" . $aKeyword[0] . "%' AND precio like '%" . $aKeyword2[0] . "%' AND id_categoria like '%" . $aKeyword3[0] . "%'";
            $q = $conn->prepare($sql);
            $result = $q->execute();
            $npic = $q->fetchAll();
          ?>
          <h4 class="h4 text-center">Palabra Clave: Nombre: <?php echo $_POST['nombre'];?>, Precio: <?php echo $_POST['precio'];?> y Categoria:
          <?php 
            for($i=0; $i < count($categoria); $i++){
              if ($_POST['id_categoria']==$categoria[$i]["id"]) {
               echo $categoria[$i]["nombre"];
              }
            }
          ?>
            
          </h4>
          <hr>
          <?php
              if($npic) {
          ?>
            <table class="table col-6 form">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Categoria</th>
                  </tr>
                </thead>
                <tbody>    
        <?php
                  for($i=0; $i < count($npic); $i++)
                  {
        ?>
                    <tr>
                      <td class="text-capitalize"><?php echo $npic[$i]["id"]; ?></td>
                      <td class="text-capitalize"><?php echo $npic[$i]["nombre"]; ?></td>
                      <td class="text-capitalize"><?php echo $npic[$i]["precio"]; ?></td>
                      <td class="text-capitalize">
          <?php 
                        for($j=0; $j < count($categoria); $j++){
                          if ($npic[$i]['id_categoria']==$categoria[$j]["id"]) {
                          echo $categoria[$j]["nombre"];
                          }
                        }
          ?>
                      </td>
                    </tr>
        <?php
                  }
        ?> 
                </tbody>
              </table>
          <?php
            }
            else{
              ?> 
                <div class="alert alert-danger alert-dismissible fade show" role="alert">No se ha encontrado ningun registro
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
              <?php
            }
  
          }
          else if($_REQUEST["nombre"]!="" && $_REQUEST["precio"]!=""){
            
            $aKeyword = explode(" ", $_POST['nombre']);
            $aKeyword2 = explode(" ", $_POST['precio']);
            $sql ="SELECT * FROM productos WHERE  nombre like '%" . $aKeyword[0] . "%' AND precio like '%" . $aKeyword2[0] . "%'";
            $q = $conn->prepare($sql);
            $result = $q->execute();
            $nyp = $q->fetchAll();
          ?>
          <h4 class="h4 text-center">Palabra Clave: Nombre: <?php echo $_POST['nombre']?> y Precio: <?php echo $_POST['precio'];?></h4>
          <hr>
          <?php
              if($nyp) {
          ?>
            <table class="table col-6 form">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Categoria</th>
                  </tr>
                </thead>
                <tbody>    
        <?php
                  for($i=0; $i < count($nyp); $i++)
                  {
        ?>
                    <tr>
                      <td class="text-capitalize"><?php echo $nyp[$i]["id"]; ?></td>
                      <td class="text-capitalize"><?php echo $nyp[$i]["nombre"]; ?></td>
                      <td class="text-capitalize"><?php echo $nyp[$i]["precio"]; ?></td>
                      <td class="text-capitalize">
          <?php 
                        for($j=0; $j < count($categoria); $j++){
                          if ($nyp[$i]['id_categoria']==$categoria[$j]["id"]) {
                          echo $categoria[$j]["nombre"];
                          }
                        }
          ?>
                      </td>
                    </tr>
        <?php
                  }
        ?> 
                </tbody>
              </table>
          <?php
            }
            else{
              ?> 
                <div class="alert alert-danger alert-dismissible fade show" role="alert">No se ha encontrado ningun registro
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
              <?php
            }
          }
          else if($_REQUEST["precio"]!="" && $_REQUEST["id_categoria"]!=""){
            $aKeyword = explode(" ", $_POST['precio']);
            $aKeyword2 = explode(" ", $_POST['id_categoria']);
            $sql ="SELECT * FROM productos WHERE  precio like '%" . $aKeyword[0] . "%' AND id_categoria like '%" . $aKeyword2[0] . "%'";
            $q = $conn->prepare($sql);
            $result = $q->execute();
            $pyc = $q->fetchAll();
          ?>
          <h4 class="h4 text-center">Palabra Clave: Precio: <?php echo $_POST['precio']?> y Categoria:
          <?php 
            for($i=0; $i < count($categoria); $i++){
              if ($_POST['id_categoria']==$categoria[$i]["id"]) {
               echo $categoria[$i]["nombre"];
              }
            }
          ?>
          </h4>
          <hr>
          <?php
              if($pyc) {
          ?>
            <table class="table col-6 form">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Categoria</th>
                  </tr>
                </thead>
                <tbody>    
        <?php
                  for($i=0; $i < count($pyc); $i++)
                  {
        ?>
                    <tr>
                      <td class="text-capitalize"><?php echo $pyc[$i]["id"]; ?></td>
                      <td class="text-capitalize"><?php echo $pyc[$i]["nombre"]; ?></td>
                      <td class="text-capitalize"><?php echo $pyc[$i]["precio"]; ?></td>
                      <td class="text-capitalize">
          <?php 
                        for($j=0; $j < count($categoria); $j++){
                          if ($pyc[$i]['id_categoria']==$categoria[$j]["id"]) {
                          echo $categoria[$j]["nombre"];
                          }
                        }
          ?>
                      </td>
                    </tr>
        <?php
                  }
        ?> 
                </tbody>
              </table>
          <?php
            }
            else{
              ?> 
                <div class="alert alert-danger alert-dismissible fade show" role="alert">No se ha encontrado ningun registro
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
              <?php
            }
          }
          else if($_REQUEST["nombre"]!="" && $_REQUEST["id_categoria"]!=""){
            $aKeyword = explode(" ", $_POST['nombre']);
            $aKeyword2 = explode(" ", $_POST['id_categoria']);
            $sql ="SELECT * FROM productos WHERE  nombre like '%" . $aKeyword[0] . "%' AND id_categoria like '%" . $aKeyword2[0] . "%'";
            $q = $conn->prepare($sql);
            $result = $q->execute();
            $nyp = $q->fetchAll();
          ?>
          <h4 class="h4 text-center">Palabra Clave: Nombre: <?php echo $_POST['nombre']?> Y Categoria:
          <?php 
            for($i=0; $i < count($categoria); $i++){
              if ($_POST['id_categoria']==$categoria[$i]["id"]) {
               echo $categoria[$i]["nombre"];
              }
            }
          ?>
          </h4>
          <hr>
          <?php
              if($nyp) {
          ?>
            <table class="table col-6 form">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Categoria</th>
                  </tr>
                </thead>
                <tbody>    
        <?php
                  for($i=0; $i < count($nyp); $i++)
                  {
        ?>
                    <tr>
                      <td class="text-capitalize"><?php echo $nyp[$i]["id"]; ?></td>
                      <td class="text-capitalize"><?php echo $nyp[$i]["nombre"]; ?></td>
                      <td class="text-capitalize"><?php echo $nyp[$i]["precio"]; ?></td>
                      <td class="text-capitalize">
          <?php 
                        for($j=0; $j < count($categoria); $j++){
                          if ($nyp[$i]['id_categoria']==$categoria[$j]["id"]) {
                          echo $categoria[$j]["nombre"];
                          }
                        }
          ?>
                      </td>
                    </tr>
        <?php
                  }
        ?> 
                </tbody>
              </table>
          <?php
            }
            else{
              ?> 
                <div class="alert alert-danger alert-dismissible fade show" role="alert">No se ha encontrado ningun registro
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
              <?php
            }
          }
        
        else if ($_REQUEST["nombre"]!="" || $_REQUEST["precio"]!="" || $_REQUEST["id_categoria"]!="") 
        {
          if(isset ($_POST['nombre']))
          {
            if($_REQUEST["nombre"]!="")
            {
              $aKeyword = explode(" ", $_POST['nombre']);
              $sql ="SELECT * FROM productos WHERE nombre like '%" . $aKeyword[0] . "%'";
              $q = $conn->prepare($sql);
              $result = $q->execute();
              $nombre = $q->fetchAll();
          ?>
              <h4 class="h4 text-center">Palabra Clave: <?php echo $_POST['nombre']?></h4>
              <hr>
          <?php
              if($nombre) {
          ?>
              <table class="table col-6 form">
                  <thead class="thead-dark">
                    <tr>
                      <th scope="col">ID</th>
                      <th scope="col">Nombre</th>
                      <th scope="col">Precio</th>
                      <th scope="col">Categoria</th>
                    </tr>
                  </thead>
                  <tbody>    
          <?php
                    for($i=0; $i < count($nombre); $i++)
                    {
          ?>
                      <tr>
                        <td class="text-capitalize"><?php echo $nombre[$i]["id"]; ?></td>
                        <td class="text-capitalize"><?php echo $nombre[$i]["nombre"]; ?></td>
                        <td class="text-capitalize"><?php echo $nombre[$i]["precio"]; ?></td>
                        <td class="text-capitalize">
          <?php 
                        for($j=0; $j < count($categoria); $j++){
                          if ($nombre[$i]['id_categoria']==$categoria[$j]["id"]) {
                          echo $categoria[$j]["nombre"];
                          }
                        }
          ?>
                      </td>
                      </tr>
          <?php
                    }
          ?> 
                  </tbody>
                </table>
          <?php
              }
              else{
                ?> 
                  <div class="alert alert-danger alert-dismissible fade show" role="alert">No se ha encontrado ningun registro
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  </div>
                <?php
              }
            }       
          }
          ?>
          
          <?php
          if(isset ($_POST['precio']))
          {
            if($_REQUEST["precio"]!="")
            {
              $aKeyword = explode(" ", $_POST['precio']);
              $sql ="SELECT * FROM productos WHERE precio like '%" . $aKeyword[0] . "%'";
              $q = $conn->prepare($sql);
              $result = $q->execute();
              $precio = $q->fetchAll();
          ?> 
              <h4 class="h4 text-center">Palabra Clave: <?php echo $_POST['precio']?></h4>
              <hr>
          <?php
              if($precio) {
          ?>
                <table class="table col-6 form">
                  <thead class="thead-dark">
                    <tr>
                      <th scope="col">ID</th>
                      <th scope="col">Nombre</th>
                      <th scope="col">Precio</th>
                      <th scope="col">Categoria</th>
                    </tr>
                  </thead>
                  <tbody>    
          <?php
                  for($i=0; $i < count($precio); $i++)
                  {
          ?>
                    <tr>
                      <td class="text-capitalize"><?php echo $precio[$i]["id"]; ?></td>
                      <td class="text-capitalize"><?php echo $precio[$i]["nombre"]; ?></td>
                      <td class="text-capitalize"><?php echo $precio[$i]["precio"]; ?></td>
                      <td class="text-capitalize">
          <?php 
                        for($j=0; $j < count($categoria); $j++){
                          if ($precio[$i]['id_categoria']==$categoria[$j]["id"]) {
                          echo $categoria[$j]["nombre"];
                          }
                        }
          ?>
                      </td>
                    </tr>
          <?php
                  }
          ?> 
                  </tbody>
                </table>
          <?php
              }
              else{
                ?> 
                  <div class="alert alert-danger alert-dismissible fade show" role="alert">No se ha encontrado ningun registro
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  </div>
                <?php
              }
            }
          }
          ?>

          <?php
          if(isset ($_POST['id_categoria']))
          {
            if($_REQUEST["id_categoria"]!="")
            {
              $aKeyword = explode(" ", $_POST['id_categoria']);
              $sql ="SELECT * FROM productos WHERE id_categoria like '%" . $aKeyword[0] . "%'";
              $q = $conn->prepare($sql);
              $result = $q->execute();
              $id_categoria = $q->fetchAll();
          ?> 
              <h4 class="h4 text-center">Palabra Clave: 
            <?php 
              for($i=0; $i < count($categoria); $i++){
                if ($_POST['id_categoria']==$categoria[$i]["id"]) {
                echo $categoria[$i]["nombre"];
                }
              }
            ?>
              </h4>
              <hr>
                <table class="table col-6 form">
                  <thead class="thead-dark">
                    <tr>
                      <th scope="col">ID</th>
                      <th scope="col">Nombre</th>
                      <th scope="col">Precio</th>
                      <th scope="col">Categoria</th>
                    </tr>
                  </thead>
                  <tbody>    
          <?php
                  for($i=0; $i < count($id_categoria); $i++)
                  {
          ?>
                    <tr>
                      <td class="text-capitalize"><?php echo $id_categoria[$i]["id"]; ?></td>
                      <td class="text-capitalize"><?php echo $id_categoria[$i]["nombre"]; ?></td>
                      <td class="text-capitalize"><?php echo $id_categoria[$i]["precio"]; ?></td>
                      <td class="text-capitalize">
          <?php 
                        for($j=0; $j < count($categoria); $j++){
                          if ($id_categoria[$i]['id_categoria']==$categoria[$j]["id"]) {
                          echo $categoria[$j]["nombre"];
                          }
                        }
          ?>
                      </td>
                    </tr>
          <?php
                  }
          ?> 
                  </tbody>
                </table>
          <?php
              }
            }
          }
          else
          {
          ?> 
          <div class="alert alert-danger alert-dismissible fade show" role="alert">No ha digitado ningun parametro de busqueda
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
          <?php
            
          }
        }
        ?>
        
      </div>
      <div class="col-2 ">
      </div>
    </div>
     <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>
</html>