    
    <?php
        
        if ($_GET['email']){
            $adressEmail = $_GET['email'];
            
            $db = new PDO('mysql:host=exmachinefmci.mysql.db; dbname=exmachinefmci; charset=UTF8', 'exmachinefmci', 'carp310M');
            
            $sql_sel="SELECT * FROM `raouf` WHERE `mail`=\"".$adressEmail."\"";
            echo "$sql_sel";
            
            $selectall = $db->query($sql_sel);
            $result = $selectall->fetch();
            $counttable = (count($result));
            echo $counttable;
            
            if ($counttable>=1) {
                $sup = "DELETE FROM `raouf` WHERE `mail`=\"".$adressEmail."\"";
                $del = $db->prepare($sup);
                $del->execute(); 
            }
        }    
    ?>
    
    

