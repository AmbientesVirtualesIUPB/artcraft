<?php 
    // Obtener el usuario
    $usuario = $_SESSION['usuario'];

?>
   
            <link rel="stylesheet" href="Styles/docenteDashboard.css">
  
        <div class="dashboard-docente">
            <div class="Docente">
                <img src="public/images/dashboard/user.png" alt="iconoUser"> <p class="tipoPerfil"><?php echo htmlspecialchars($usuario['usuario']); ?></p>
            </div>
            <div class="messaje">
                <img src="public/images/dashboard/Icono.png" alt="iconoUser">
                <p>Selecciona una opción del menu para gestionar tu contenido:</p>
            </div>        
        <!-- Contenedor principal -->
            <div class="menu-opciones">         
            <!-- Columna 2 fila 1: Botones con grids anidados -->       
                <div class="btn1" role="button" onclick="window.location.href='?view=crear_grupo';" style="cursor: pointer;">
                    <div class="btn1-2 b1"></div>
                    <div class="btn1-2 b2"></div>
                    <div class="btn1-2 b3"></div>
                    <div class="btn1-2 b4"></div>
                    <div class="btn1-2 b5">Crear Grupo</div>
                    <div class="btn1-2 b6"></div>
                    <div class="btn1-2 b7"></div>
                    <div class="btn1-2 b8"></div>
                    <div class="btn1-2 b9"></div>                
                </div>      
            <!-- Columna 2 fila 2: Botones con grids anidados -->      
                <div class="btn2" role="button" onclick="window.location.href='?view=crear_cartas';" style="cursor: pointer;">
                    <div class="btn2-2 b1"></div>
                    <div class="btn2-2 b2"></div>
                    <div class="btn2-2 b3"></div>
                    <div class="btn2-2 b4"></div>
                    <div class="btn2-2 b5">Crear Cartas</div>
                    <div class="btn2-2 b6"></div>
                    <div class="btn2-2 b7"></div>
                    <div class="btn2-2 b8"></div>
                    <div class="btn2-2 b9"></div>
                </div>        
            <!-- Columna 2 fila 3: Botones con grids anidados -->
                <div class="btn3" role="button" onclick="window.location.href='?view=mis_grupos';" style="cursor: pointer;">
                    <div class="btn3-2 b1"></div>
                    <div class="btn3-2 b2"></div>
                    <div class="btn3-2 b3"></div>
                    <div class="btn3-2 b4"></div>
                    <div class="btn3-2 b5">Mis Grupos</div>
                    <div class="btn3-2 b6"></div>
                    <div class="btn3-2 b7"></div>
                    <div class="btn3-2 b8"></div>
                    <div class="btn3-2 b9"></div>
                </div>
            <!-- Columna 3 fila 1: Botones con grids anidados --> 
                <div class="btn4" role="button" onclick="window.location.href='?view=mis_cartas';" style="cursor: pointer;">
                    <div class="btn4-2 b1"></div>
                    <div class="btn4-2 b2"></div>
                    <div class="btn4-2 b3"></div>
                    <div class="btn4-2 b4"></div>
                    <div class="btn4-2 b5">Mis Cartas</div>
                    <div class="btn4-2 b6"></div>
                    <div class="btn4-2 b7"></div>
                    <div class="btn4-2 b8"></div>
                    <div class="btn4-2 b9"></div>
                </div>
            <!-- Columna 3 fila 2: Botones con grids anidados -->
                <div class="btn5" role="button" onclick="window.location.href='?view=reportes';" style="cursor: pointer;">
                    <div class="btn5-2 b1"></div>
                    <div class="btn5-2 b2"></div>
                    <div class="btn5-2 b3"></div>
                    <div class="btn5-2 b4"></div>
                    <div class="btn5-2 b5">Reportes</div>
                    <div class="btn5-2 b6"></div>
                    <div class="btn5-2 b7"></div>
                    <div class="btn5-2 b8"></div>
                    <div class="btn5-2 b9"></div>
                </div>  
            <!-- Columna 3 fila 3: Botones con grids anidados -->
                <div class="btn6" role="button" onclick="window.location.href='?view=notas';" style="cursor: pointer;">
                    <div class="btn6-2 b1"></div>
                    <div class="btn6-2 b2"></div>
                    <div class="btn6-2 b3"></div>
                    <div class="btn6-2 b4"></div>
                    <div class="btn6-2 b5">Notas</div>
                    <div class="btn6-2 b6"></div>
                    <div class="btn6-2 b7"></div>
                    <div class="btn6-2 b8"></div>
                    <div class="btn6-2 b9"></div>
                </div>
            </div>
            <div class="separador">
                <img src="public/images/dashboard/Separador.png" alt="Separador">
            </div>
        </div>

        <?php   
    // Determinar la vista seleccionada
    if(isset($_GET['view'])){
        $view = "docente/".$_GET['view'].".php";
        include $view;
    }
    
?>

