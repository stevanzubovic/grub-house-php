<nav class="col-md-6 col-12 tm-nav" id="header-menu">
    <ul class="tm-nav-ul">
    
<?php 

    $query = "SELECT * FROM menu";
    
    $nav = $conn->query($query);
    
    foreach($nav as $n):
?>
    <?php
        if(isset($_SESSION['user'])){
            if($n->text == 'Login' || $n->text == 'Register') continue;
        }
        if(!isset($_SESSION['user'])){
            if($n->text == 'Logout' || $n->text == 'Admin') continue;
        }
        if(isset($_SESSION['user'])){
            if($_SESSION['user']->roleId != '1') {
                if($n->text == 'Admin') continue;
            }  
        }  
        
    ?> 
    <li class="tm-nav-li">
        <a href="<?= $n->link ?>" class="tm-nav-link"><?= $n->text ?></a>
    </li>

<?php
    endforeach
?>
   
</ul>
</nav>


