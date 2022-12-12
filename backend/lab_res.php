<?php
require 'db.php';

if(isset($_POST['submiturine'])){ //urinalysis
    $color = $_POST['color'];
    $Appearance = $_POST['app'];
    $ph= $_POST['ph'];
    $sp_g = $_POST['sp_g'];
    $protine = $_POST['protine'];
    $glucose = $_POST['glucose'];
    $ketone = $_POST['ketone'];
    $bilir = $_POST['bilir'];
    $urob = $_POST['urob'];
    $blood = $_POST['blood'];
    $l_e = $_POST['l_e'];
    $nitrite = $_POST['nitrite'];

    $epithelial = $_POST['Epithelial'];
    $WBC_HPF = $_POST['WBC_HPF'];
    $RBC_HPF = $_POST['RBC_HPF'];
    $Casts = $_POST['Casts'];
    $Bacteria = $_POST['Bacteria'];


    $pat_id = $_POST['pat_id'];
    

    $sql="INSERT INTO `urine`(`patient_id`, `color`, `apprearance`, `ph`, `s_g`, `protein`, `glucose`, `ketone`, `bilirubin`, `urobilinogen`, `blood`, `l_e`, `nitrite`, `epithe`, `wbc`, `rbc`, `casts`, `bacteria`) 
    VALUES (
        '$pat_id','$color','$Appearance',
        '$ph','$sp_g','$protine','$glucose',
        '$ketone','$bilir','$urob','$blood',
        '$l_e','$nitrite', '$epithelial', '$WBC_HPF',
        '$RBC_HPF', '$Casts', '$Bacteria')";
    $rs = $conn->query($sql);

    if($rs){
        
        $sqld="DELETE FROM `lab_cart2` WHERE `name`='Urinalysis'";
        $rsd=$conn->query($sqld);
        if($rsd){
        
        header("Location: ../Users/Laboratory/index.php?search=$pat_id&searching=Search&msg=Sent");
        }

    }else{  
        //header("Location: ../Users/Laboratory/index.php?search=$pat_id&searching=Search?msg=Error");
        echo $conn->error;
    }
}elseif(isset($_POST['submitafb'])){ //afb_sputum
    $Spot = $_POST['spot'];
    $Morning = $_POST['morning'];
    
    $pat_id = $_POST['pat_id'];
    

    $sql="INSERT INTO `afb_sputum`( `patient_id`, `SPOT`, `MORNING`) VALUES ('$pat_id','$Spot','$Morning')";
    $rs = $conn->query($sql);
    if($rs){
        $sqld="DELETE FROM `lab_cart2` WHERE `name`='AFB_Sputum'";
        $rsd=$conn->query($sqld);
        if($rsd){
        header("Location: ../Users/Laboratory/index.php?search=$pat_id&searching=Search&msg=Sent");
        }

    }else{  
        header("Location: ../Users/Laboratory/index.php?search=$pat_id&searching=Search?msg=Error");
        
    }
}elseif(isset($_POST['submitst'])){ //stool
    $Appearance = $_POST['Appearance'];
    $Consistency = $_POST['Consistency'];
    $ph= $_POST['Ova_Parasite'];
    $PUS_cells = $_POST['PUS_cells'];
    $Mucus = $_POST['Mucus'];
    $pat_id = $_POST['pat_id'];
    

    $sql="INSERT INTO `stool`( `Appearance`, `Consistency`, `o/p`, `pus`, `mucus`, `petn_id`) VALUES ('$Appearance','$Consistency','$Ova_Parasite','$PUS_cells','$Mucus','$pat_id')";
    $rs = $conn->query($sql);
    if($rs){
        $sqld="DELETE FROM `lab_cart2` WHERE `name`='STOOL'";
        $rsd=$conn->query($sqld);
        if($rsd){
        header("Location: ../Users/Laboratory/index.php?search=$pat_id&searching=Search&msg=Sent");
        }

    }else{  
        header("Location: ../Users/Laboratory/index.php?search=$pat_id&searching=Search?msg=Error");
        
    }
}elseif(isset($_POST['submitse'])){ //serum
    $Sodium = $_POST['Sodium'];
    $Potassium = $_POST['Potassium'];
    $Calsium= $_POST['Calsium'];
    $Others = $_POST['Others'];
    $pat_id = $_POST['pat_id'];
    

    $sql="INSERT INTO `s/e`(`patient_id`, `Sodium`, `Potassium`, `Calsium`, `Others`) VALUES ('$pat_id','$Sodium','$Potassium','$Calsium','$Others')";
    $rs = $conn->query($sql);
 
    if($rs){
        $sqld="DELETE FROM `lab_cart2` WHERE `name`='Serum'";
        $rsd=$conn->query($sqld);
        if($rsd){
        header("Location: ../Users/Laboratory/index.php?search=$pat_id&searching=Search&msg=Sent");
        }

    }else{  
        header("Location: ../Users/Laboratory/index.php?search=$pat_id&searching=Search?msg=Error");
        
    }
}elseif(isset($_POST['submitbf'])){ //blood_film
    $bf = $_POST['Blood_film'];
    $pat_id = $_POST['pat_id'];

    $sql="INSERT INTO `bf`( `patient_id`, `bf`) VALUES('$pat_id','$bf')";
    $rs = $conn->query($sql);
    
    if($rs){
        $sqld="DELETE FROM `lab_cart2` WHERE `name`='blood_f'";
        $rsd=$conn->query($sqld);
        if($rsd){
        header("Location: ../Users/Laboratory/index.php?search=$pat_id&searching=Search&msg=Sent");
        }

    }else{  
        header("Location: ../Users/Laboratory/index.php?search=$pat_id&searching=Search?msg=Error");
        
    }
}elseif(isset($_POST['submitbg'])){  //blood_group
    $bg = $_POST['bg'];
    $pat_id = $_POST['pat_id'];
    
    $sql="INSERT INTO `bg`( `patient_id`, `bg`) VALUES('$pat_id','$bg')";
    $rs = $conn->query($sql);
    
    if($rs){
        $sqld="DELETE FROM `lab_cart2` WHERE `name`='Blood_Group'";
        $rsd=$conn->query($sqld);
        if($rsd){
        header("Location: ../Users/Laboratory/index.php?search=$pat_id&searching=Search&msg=Sent");
        }

    }else{  
        header("Location: ../Users/Laboratory/index.php?search=$pat_id&searching=Search?msg=Error");
    }

}elseif(isset($_POST['submitco'])){ //coagulation
    $PT = $_POST['PT'];
    $PTT = $_POST['PTT'];
    $INR = $_POST['INR'];
    $pat_id = $_POST['pat_id'];
    
    $sql="INSERT INTO `coagulation`(`patient_id`, `PT`, `PTT`, `INR`) VALUES ('$pat_id','$PT','$PTT','$INR')";
    $rs = $conn->query($sql);
    
    if($rs){
        $sqld="DELETE FROM `lab_cart2` WHERE `name`='Coagulation_Profile'";
        $rsd=$conn->query($sqld);
        if($rsd){
        header("Location: ../Users/Laboratory/index.php?search=$pat_id&searching=Search&msg=Sent");
        }

    }else{  
       // header("Location: ../Users/Laboratory/index.php?search=$pat_id&searching=Search?msg=Error");
        echo $conn->error;        
 }
}elseif(isset($_POST['submitesr'])){ //esr
    $esr=$_POST['ESR'];
    $pat_id = $_POST['pat_id'];

        $sql="INSERT INTO `esr`(`patient_id`, `ESR`) VALUES ('$pat_id','$esr')";
        $rs = mysqli_query($conn, $sql);
        if($rs){
            $sqld="DELETE FROM `lab_cart2` WHERE `name`='ESR'";
            $rsd=$conn->query($sqld);
            if($rsd){
            header("Location: ../Users/Laboratory/index.php?search=$pat_id&searching=Search&msg=Sent");
            }
    
        }else{  
            echo $conn->error;
           // header("Location: ../Users/Laboratory/index.php?search=$pat_id&searching=Search?msg=Error");
            
    }
}elseif(isset($_POST['submitcrp'])){ //crp
    $crp=$_POST['crp'];
    $pat_id = $_POST['pat_id'];

        $sql="INSERT INTO `crp`(`patient_id`, `crp`) VALUES ('$pat_id','$crp')";
        $rs = mysqli_query($conn, $sql);
        if($rs){
            $sqld="DELETE FROM `lab_cart2` WHERE `name`='CRP'";
            $rsd=$conn->query($sqld);
            if($rsd){
            header("Location: ../Users/Laboratory/index.php?search=$pat_id&searching=Search&msg=Sent");
            }
    
        }else{  
            echo $conn->error;
           // header("Location: ../Users/Laboratory/index.php?search=$pat_id&searching=Search?msg=Error");
            
    }
}elseif(isset($_POST['submitfbs'])){ //fbs
    $fbs=$_POST['fbs'];
    $pat_id = $_POST['pat_id'];

        $sql="INSERT INTO `fbs`(`patient_id`, `fbs`) VALUES ('$pat_id','$fbs')";
        $rs = mysqli_query($conn, $sql);
        if($rs){
            $sqld="DELETE FROM `lab_cart2` WHERE `name`='FBS_RBS'";
            $rsd=$conn->query($sqld);
            if($rsd){
            header("Location: ../Users/Laboratory/index.php?search=$pat_id&searching=Search&msg=Sent");
            }
    
        }else{  
            echo $conn->error;
           // header("Location: ../Users/Laboratory/index.php?search=$pat_id&searching=Search?msg=Error");
            
    }
}elseif(isset($_POST['submitgram'])){ //gram_stain
    $gram_stain=$_POST['gram_stain'];
    $pat_id = $_POST['pat_id'];

        $sql="INSERT INTO `gram_stain`(`patient_id`, `gram_stain`) VALUES ('$pat_id','$gram_stain')";
        $rs = mysqli_query($conn, $sql);
        if($rs){
            $sqld="DELETE FROM `lab_cart2` WHERE `name`='Gram_Stain'";
            $rsd=$conn->query($sqld);
            if($rsd){
            header("Location: ../Users/Laboratory/index.php?search=$pat_id&searching=Search&msg=Sent");
            }
    
        }else{  
            echo $conn->error;
           // header("Location: ../Users/Laboratory/index.php?search=$pat_id&searching=Search?msg=Error");
            
    }
}elseif(isset($_POST['submithpylori'])){ //hpylori
    $hpylori_ag=$_POST['hpylori_ag'];
    $hpylori_ab=$_POST['hpylori_ab'];
    $pat_id = $_POST['pat_id'];

        $sql="INSERT INTO `hpylori`(`patient_id`, `hpylori_ag`, `hpylori_ab`) VALUES ('$pat_id','$hpylori_ag', '$hpylori_ab')";
        $rs = mysqli_query($conn, $sql);
        if($rs){
            $sqld="DELETE FROM `lab_cart2` WHERE `name`='h_pylori'";
            $rsd=$conn->query($sqld);
            if($rsd){
            header("Location: ../Users/Laboratory/index.php?search=$pat_id&searching=Search&msg=Sent");
            }
    
        }else{  
            echo $conn->error;
           // header("Location: ../Users/Laboratory/index.php?search=$pat_id&searching=Search?msg=Error");
            
    }
}elseif(isset($_POST['submitlet'])){ //LET
    $sgot=$_POST['sgot'];
    $sgpt=$_POST['sgpt'];
    $alk_phos=$_POST['alk_phos'];
    $pat_id = $_POST['pat_id'];

        $sql="INSERT INTO `let`(`patient_id`, `sgot`, `sgpt`, `alk_phos`) VALUES ('$pat_id','$sgot', '$sgpt', '$alk_phos')";
        $rs = mysqli_query($conn, $sql);
        if($rs){
            $sqld="DELETE FROM `lab_cart2` WHERE `name`='LET'";
            $rsd=$conn->query($sqld);
            if($rsd){
            header("Location: ../Users/Laboratory/index.php?search=$pat_id&searching=Search&msg=Sent");
            }
    
        }else{  
            echo $conn->error;
           // header("Location: ../Users/Laboratory/index.php?search=$pat_id&searching=Search?msg=Error");
            
    }
}elseif(isset($_POST['submitlft'])){ //LFT
    $bt=$_POST['bt'];
    $bd=$_POST['bd'];
    $albumin=$_POST['albumin'];
    $pat_id = $_POST['pat_id'];

        $sql="INSERT INTO `lft`(`patient_id`, `bt`, `bd`, `albumin`) VALUES ('$pat_id','$bt', '$bd', '$albumin')";
        $rs = mysqli_query($conn, $sql);
        if($rs){
            $sqld="DELETE FROM `lab_cart2` WHERE `name`='LFT'";
            $rsd=$conn->query($sqld);
            if($rsd){
            header("Location: ../Users/Laboratory/index.php?search=$pat_id&searching=Search&msg=Sent");
            }
    
        }else{  
            echo $conn->error;
           // header("Location: ../Users/Laboratory/index.php?search=$pat_id&searching=Search?msg=Error");
            
    }
}elseif(isset($_POST['submitliver'])){ //Liver_viral
    $hbs=$_POST['hbs'];
    $hcv=$_POST['hcv'];
    $pat_id = $_POST['pat_id'];

        $sql="INSERT INTO `liver_viral`(`patient_id`, `hbs`, `hcv`) VALUES ('$pat_id','$hbs', '$hcv')";
        $rs = mysqli_query($conn, $sql);
        if($rs){
            $sqld="DELETE FROM `lab_cart2` WHERE `name`='liver_viral'";
            $rsd=$conn->query($sqld);
            if($rsd){
            header("Location: ../Users/Laboratory/index.php?search=$pat_id&searching=Search&msg=Sent");
            }
    
        }else{  
            echo $conn->error;
           // header("Location: ../Users/Laboratory/index.php?search=$pat_id&searching=Search?msg=Error");
            
    }
}elseif(isset($_POST['submitpict'])){ //pict
    $pict=$_POST['pict'];
    $pat_id = $_POST['pat_id'];

        $sql="INSERT INTO `pict`(`patient_id`, `pict`) VALUES ('$pat_id','$pict')";
        $rs = mysqli_query($conn, $sql);
        if($rs){
            $sqld="DELETE FROM `lab_cart2` WHERE `name`='PICT'";
            $rsd=$conn->query($sqld);
            if($rsd){
            header("Location: ../Users/Laboratory/index.php?search=$pat_id&searching=Search&msg=Sent");
            }
    
        }else{  
            echo $conn->error;
           // header("Location: ../Users/Laboratory/index.php?search=$pat_id&searching=Search?msg=Error");
            
    }
}elseif(isset($_POST['submitrft'])){ //rft
    $bun=$_POST['bun'];
    $creatinine=$_POST['creatinine'];
    $pat_id = $_POST['pat_id'];

        $sql="INSERT INTO `rft`(`patient_id`, `bun`, `creatinine`) VALUES ('$pat_id','$bun', '$creatinine')";
        $rs = mysqli_query($conn, $sql);
        if($rs){
            $sqld="DELETE FROM `lab_cart2` WHERE `name`='RFT'";
            $rsd=$conn->query($sqld);
            if($rsd){
            header("Location: ../Users/Laboratory/index.php?search=$pat_id&searching=Search&msg=Sent");
            }
    
        }else{  
            echo $conn->error;
           // header("Location: ../Users/Laboratory/index.php?search=$pat_id&searching=Search?msg=Error");
            
    }
}elseif(isset($_POST['submitrpr'])){ //rpr
    $rpr=$_POST['rpr'];
    $pat_id = $_POST['pat_id'];

        $sql="INSERT INTO `rpr`(`patient_id`, `rpr`) VALUES ('$pat_id','$rpr')";
        $rs = mysqli_query($conn, $sql);
        if($rs){
            $sqld="DELETE FROM `lab_cart2` WHERE `name`='RPR'";
            $rsd=$conn->query($sqld);
            if($rsd){
            header("Location: ../Users/Laboratory/index.php?search=$pat_id&searching=Search&msg=Sent");
            }
    
        }else{  
            echo $conn->error;
           // header("Location: ../Users/Laboratory/index.php?search=$pat_id&searching=Search?msg=Error");
            
    }
}elseif(isset($_POST['submittft'])){ //tft
    $t3=$_POST['t3'];
    $t4=$_POST['t4'];
    $tsh=$_POST['tsh'];
    $pat_id = $_POST['pat_id'];

        $sql="INSERT INTO `tft`(`patient_id`, `t3`, `t4`, `tsh`) VALUES ('$pat_id','$t3', '$t4', '$tsh')";
        $rs = mysqli_query($conn, $sql);
        if($rs){
            $sqld="DELETE FROM `lab_cart2` WHERE `name`='TFT'";
            $rsd=$conn->query($sqld);
            if($rsd){
            header("Location: ../Users/Laboratory/index.php?search=$pat_id&searching=Search&msg=Sent");
            }
    
        }else{  
            echo $conn->error;
           // header("Location: ../Users/Laboratory/index.php?search=$pat_id&searching=Search?msg=Error");
            
    }
}elseif(isset($_POST['submituric'])){ //uric acid
    $uric=$_POST['uric'];
    $pat_id = $_POST['pat_id'];

        $sql="INSERT INTO `uric_acid`(`patient_id`, `uric`) VALUES ('$pat_id','$uric')";
        $rs = mysqli_query($conn, $sql);
        if($rs){
            $sqld="DELETE FROM `lab_cart2` WHERE `name`='Uric_Acid'";
            $rsd=$conn->query($sqld);
            if($rsd){
            header("Location: ../Users/Laboratory/index.php?search=$pat_id&searching=Search&msg=Sent");
            }
    
        }else{  
            echo $conn->error;
           // header("Location: ../Users/Laboratory/index.php?search=$pat_id&searching=Search?msg=Error");
            
    }
}elseif(isset($_POST['submitvdrl'])){ //vdrl
    $vdrl=$_POST['vdrl'];
    $pat_id = $_POST['pat_id'];

        $sql="INSERT INTO `vdrl`(`patient_id`, `vdrl`) VALUES ('$pat_id','$vdrl')";
        $rs = mysqli_query($conn, $sql);
        if($rs){
            $sqld="DELETE FROM `lab_cart2` WHERE `name`='VDRL'";
            $rsd=$conn->query($sqld);
            if($rsd){
            header("Location: ../Users/Laboratory/index.php?search=$pat_id&searching=Search&msg=Sent");
            }
    
        }else{  
            echo $conn->error;
           // header("Location: ../Users/Laboratory/index.php?search=$pat_id&searching=Search?msg=Error");
            
    }
}elseif(isset($_POST['submitweilf'])){ //weil
    $weil=$_POST['weil'];
    $pat_id = $_POST['pat_id'];

        $sql="INSERT INTO `weil`(`patient_id`, `weil`) VALUES ('$pat_id','$weil')";
        $rs = mysqli_query($conn, $sql);
        if($rs){
            $sqld="DELETE FROM `lab_cart2` WHERE `name`='Weil_Felix'";
            $rsd=$conn->query($sqld);
            if($rsd){
            header("Location: ../Users/Laboratory/index.php?search=$pat_id&searching=Search&msg=Sent");
            }
    
        }else{  
            echo $conn->error;
           // header("Location: ../Users/Laboratory/index.php?search=$pat_id&searching=Search?msg=Error");
            
    }
}elseif(isset($_POST['submitwidalh'])){ //widalh
    $widalh=$_POST['widalh'];
    $pat_id = $_POST['pat_id'];

        $sql="INSERT INTO `widalh`(`patient_id`, `widalh`) VALUES ('$pat_id','$widalh')";
        $rs = mysqli_query($conn, $sql);
        if($rs){
            $sqld="DELETE FROM `lab_cart2` WHERE `name`='Widal_H'";
            $rsd=$conn->query($sqld);
            if($rsd){
            header("Location: ../Users/Laboratory/index.php?search=$pat_id&searching=Search&msg=Sent");
            }
    
        }else{  
            echo $conn->error;
           // header("Location: ../Users/Laboratory/index.php?search=$pat_id&searching=Search?msg=Error");
            
    }
}elseif(isset($_POST['submitwidalo'])){ //widalo
    $widalo=$_POST['widalo'];
    $pat_id = $_POST['pat_id'];

        $sql="INSERT INTO `widalo`(`patient_id`, `widalo`) VALUES ('$pat_id','$widalo')";
        $rs = mysqli_query($conn, $sql);
        if($rs){
            $sqld="DELETE FROM `lab_cart2` WHERE `name`='Widal_O'";
            $rsd=$conn->query($sqld);
            if($rsd){
            header("Location: ../Users/Laboratory/index.php?search=$pat_id&searching=Search&msg=Sent");
            }
    
        }else{  
            echo $conn->error;
           // header("Location: ../Users/Laboratory/index.php?search=$pat_id&searching=Search?msg=Error");
            
    }
}elseif(isset($_POST['submitcsf'])){ //widalo
    $csf=$_POST['csf'];
    $pat_id = $_POST['pat_id'];

        $sql="INSERT INTO `csf`(`patient_id`, `csf`) VALUES ('$pat_id','$csf')";
        $rs = mysqli_query($conn, $sql);
        if($rs){
            $sqld="DELETE FROM `lab_cart2` WHERE `name`='csf_Felix'";
            $rsd=$conn->query($sqld);
            if($rsd){
            header("Location: ../Users/Laboratory/index.php?search=$pat_id&searching=Search&msg=Sent");
            }
    
        }else{  
            echo $conn->error;
           // header("Location: ../Users/Laboratory/index.php?search=$pat_id&searching=Search?msg=Error");
            
    }
}

?>  