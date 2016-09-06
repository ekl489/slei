//Variables
var p1, p2;
var Difficulty, Class;
var playerHealth = 200, enemyHealth = 200, oldPlayerHealth = 200, oldEnemyHealth = 200;
var playerDamage = 0, enemyDamage = 0;
var parry = 0, sharpensword = 0, enemybuff = 0, potions = 0;
var firstRound = true;
var attackSelection, lastAttack;
var feedback = [];

//Setup
function resetGame(){
    playerHealth = 200;
    enemyHealth = 200;
    oldPlayerHealth = 200;
    oldEnemyHealth = 200;
    playerDamage = 0;
    enemyDamage = 0;
    firstRound = true;
    parry = 0;
    sharpensword = 0;
    feedback = [];
    enemybuff = 0;
    potions = 0;
    lastAttack = 0;
    
    jQuery('#part3').hide(500);
    jQuery('#part4').hide(500);
    jQuery('#endGameScreen').hide(500);
    jQuery('#part1').show(500);
    jQuery('#part1').children().show(500);
}
function getDifficulty(){
    switch(p1){
        case 1:
            Difficulty = "Easy";
            break;
        case 2:
            Difficulty = "Medium";
            break;
        case 3:
            Difficulty = "Hard";
            break;
        case 4:
            Difficulty = "Insane";
            break;
        default:
            Difficulty = "Medium";
            break;
    } //Difficulty
    return Difficulty;
}
function startGame(){
    switch(p2){
        case 1:
            Class = "Class 1";
            break;
        case 2:
            Class = "Class 2";
            break;
        case 3:
            Class = "Class 3";
            break;
        default:
            Class = "Class 1";
            break;
    } //Class
    switch(p1){
        case 1:
            Difficulty = "Easy";
            break;
        case 2:
            Difficulty = "Medium";
            break;
        case 3:
            Difficulty = "Hard";
            break;
        case 4:
            Difficulty = "Insane";
            break;
        default:
            Difficulty = "Medium";
            break;
    } //Difficulty
    
}

//Attack
function Attack(){    
    //Special
    feedback.fill(null);
    oldEnemyHealth = enemyHealth;
    oldPlayerHealth = playerHealth;
        
    //Check for Win/Loss
    CheckForWinOrLoss();
    
    //Select Attack
    //Calculate & Display Damage + Attack
    switch(attackSelection){
        case 1:
            playerDamage = Math.floor((Math.random() * 25) + 5);
            break;
        case 2:
            if(Math.floor(Math.random() * 6) == 0){
                playerDamage = 30;
                feedback.push(AlertSuccess("You hit a critical!"));
            }
            else{
                playerDamage = 5;
            }
            feedback.push(AlertSuccess("Test for slice."));
            break;
        case 3:
            playerDamage = 25;
            //+15 damage buff to enemy;
            enemybuff = 2;
            break;
        case 4:
            playerDamage = Math.floor((Math.random() * 15) + 5);            
            //heal damage done            
            break;
        case 5:
            playerDamage = 0;
            //parry
            parry = 2;
            break;
        case 6:
            playerDamage = 0;
            //+10 damage buff
            sharpensword = 2;
            break;  
        case 7:
            playerDamage = 0;
            //drink potion
            if(potions > 0){
                potions--;
                feedback.push(AlertInfo("You drank a potion and healed <strong>30 health</strong>."));
                playerHealth += 30;
            }
            else{
                feedback.push(AlertDanger("You search your pocket for a potion but you don't find one. Your stupidity has let you down."));
            }
            break;
        case 8:
            playerDamage = 0;
            //roll the dice
            break;
        default:
            break;
    } //Attack Selection
    
    //Calculate Enemy Damage
    enemyDamage = Math.floor((Math.random() * 25) + 5);
    
    //Damage Buff?
    if(sharpensword == 1){
        playerDamage += 10;
        feedback.push(AlertInfo("You get a <strong>10 damage</strong> buff!"));
    }
    else if(lastAttack == 6 && sharpensword == 2){
        feedback.push(AlertInfo("You try to sharpen your sword but there is no effect!"));    
    }    
    sharpensword--;
    
    //Repeated Attack?
    if(lastAttack == attackSelection && (attackSelection == 1 || attackSelection == 2 || attackSelection == 3 || attackSelection == 4)){
        feedback.push(AlertInfo("You repeated the attack and this time isn't as strong."));
        playerDamage = Math.floor(playerDamage / 2);    
    }

    //Enemy Parry + Damage
    if(Math.floor((Math.random() * 7) + 0) == 0){
        feedback.push(AlertInfo("<strong>But!</strong> The enemy blocked your attack!"));
        playerDamage = 0;
    }

    //Find a potion?
    if(Math.floor((Math.random() * 6) + 0) == 0){
        feedback.push(AlertInfo("You have found a potion!"));
        potions++;
    }

    //Deal Damage
    if(playerDamage > 0){
        enemyHealth -= playerDamage;
        feedback.push(AlertInfo("You dealt <strong>" + playerDamage + "</strong> damage!"));
    }
    if(parry == 2 && lastAttack == attackSelection){
        feedback.push(AlertInfo("You repeated parry but there was no effect!"));
    }
    else if(parry == 1){
        feedback.push(AlertInfo("The enemy did <strong>" + enemyDamage + "</strong> damage but was blocked by your parry!"));        
    }
    else{
        feedback.push(AlertInfo("The enemy did <strong>" + enemyDamage + "</strong> damage!"));
        playerHealth -= enemyDamage;
    }
    parry--;

    //Special heal - lunge
    if(attackSelection == 4){
        playerHealth += playerDamage;
        feedback.push(AlertInfo("Your lunge healed you by <strong>" + playerDamage + "</strong> health."));
    }
    //Next Round
    lastAttack = attackSelection;
    CheckForWinOrLoss();
    firstRound = false;
    UpdateData();
    ShowAlerts();
}

function UpdateData(){
    document.getElementById("player-health").innerHTML = oldPlayerHealth + " - " + enemyDamage + " = " + playerHealth;
    document.getElementById("enemy-health").innerHTML = oldEnemyHealth + " - " + playerDamage + " = " + enemyHealth;
    document.getElementById("player-health2").innerHTML = oldPlayerHealth + " - " + enemyDamage + " = " + playerHealth;
    document.getElementById("enemy-health2").innerHTML = oldEnemyHealth + " - " + playerDamage + " = " + enemyHealth;
}
function ShowAlerts(){
    document.getElementById("feedback").innerHTML = feedback.join("");
}
function CheckForWinOrLoss(){
    if(playerHealth < 1 && enemyHealth < 1){
        jQuery('#part3').hide(500);
        jQuery('#part4').hide(500);
        jQuery('#endGameScreen').show(500);
        document.getElementById("endGameText").innerHTML = AlertInfo("It is a draw!");
    }
    else if(playerHealth < 1){
        jQuery('#part3').hide(500);
        jQuery('#part4').hide(500);
        jQuery('#endGameScreen').show(500);
        document.getElementById("endGameText").innerHTML = AlertInfo("You have lost!");
    }
    else if(enemyHealth < 1){
        jQuery('#part3').hide(500);
        jQuery('#part4').hide(500);
        jQuery('#endGameScreen').show(500);
        document.getElementById("endGameText").innerHTML = AlertSuccess("You have won!");
    }
}

//Alerts
function AlertSuccess(a){
    return '<div class="alert alert-success">' + a + '</div>';
}
function AlertInfo(a){
    return '<div class="alert alert-info">' + a + '</div>';
}
function AlertWarning(a){
    return '<div class="alert alert-warning">' + a + '</div>';
}
function AlertDanger(a){
    return '<div class="alert alert-danger">' + a + '</div>';
}

//JQuery
jQuery(document).ready(function(){                
    //Part 1
    jQuery('#p1a').on('click', function(event) { 
        p1 = 1;
        jQuery('#part1').children().hide(500);
        jQuery('#part2Easy').show(500);
    });
    jQuery('#p1b').on('click', function(event) { 
        p1 = 2;
        jQuery('#part1').hide(500);
        jQuery('#part2').show(500);
    });
    jQuery('#p1c').on('click', function(event) { 
        p1 = 3;
        jQuery('#part1').hide(500);
        jQuery('#part2').show(500);
    });

    //Part 2
    jQuery('#c1').on('click', function(event) { 
        p2 = 1;
        jQuery('#part2').hide(500);
        jQuery('#part2Easy').hide(500);
        jQuery('#part3').show(500);
    });
    jQuery('#c2').on('click', function(event) { 
        p2 = 2;
        jQuery('#part2').hide(500);
        jQuery('#part3').show(500);
        jQuery('#part2Easy').hide(500);
    });
    jQuery('#c3').on('click', function(event) { 
        p2 = 3;
        jQuery('#part2').hide(500);
        jQuery('#part3').show(500);
        jQuery('#part2Easy').hide(500);
    });
    jQuery('#c4').on('click', function(event) { 
        p2 = 4;
        jQuery('#part2').hide(500);
        jQuery('#part3').show(500);
        jQuery('#part2Easy').hide(500);
    });
    jQuery('#c5').on('click', function(event) { 
        p2 = 5;
        jQuery('#part2').hide(500);
        jQuery('#part3').show(500);
        jQuery('#part2Easy').hide(500);
    });
    jQuery('#c6').on('click', function(event) { 
        p2 = 6;
        jQuery('#part2').hide(500);
        jQuery('#part3').show(500);
        jQuery('#part2Easy').hide(500);
    });
    jQuery('#c7').on('click', function(event) { 
        p2 = 7;
        jQuery('#part2').hide(500);
        jQuery('#part3').show(500);
        jQuery('#part2Easy').hide(500);
    });
    jQuery('#c8').on('click', function(event) { 
        p2 = 8;
        jQuery('#part2').hide(500);
        jQuery('#part3').show(500);
        jQuery('#part2Easy').hide(500);
    });
    jQuery('#c9').on('click', function(event) { 
        p2 = 9;
        jQuery('#part2').hide(500);
        jQuery('#part3').show(500);
        jQuery('#part2Easy').hide(500);
    });
    jQuery('#c10').on('click', function(event) { 
        p2 = 10;
        jQuery('#part2').hide(500);
        jQuery('#part3').show(500);
        jQuery('#part2Easy').hide(500);
    });
    jQuery('#c11').on('click', function(event) { 
        p2 = 11;
        jQuery('#part2').hide(500);
        jQuery('#part3').show(500);
        jQuery('#part2Easy').hide(500);
    });
    jQuery('#c12').on('click', function(event) { 
        p2 = 12;
        jQuery('#part2').hide(500);
        jQuery('#part3').show(500);
        jQuery('#part2Easy').hide(500);
    });
    jQuery('#c13').on('click', function(event) { 
        p2 = 13;
        jQuery('#part2').hide(500);
        jQuery('#part3').show(500);
        jQuery('#part2Easy').hide(500);
    });
    jQuery('#c14').on('click', function(event) { 
        p2 = 14;
        jQuery('#part2').hide(500);
        jQuery('#part3').show(500);
        jQuery('#part2Easy').hide(500);
    });
    jQuery('#c15').on('click', function(event) { 
        p2 = 15;
        jQuery('#part2').hide(500);
        jQuery('#part3').show(500);
        jQuery('#part2Easy').hide(500);
    });
    jQuery('#c16').on('click', function(event) { 
        p2 = 16;
        jQuery('#part2').hide(500);
        jQuery('#part3').show(500);
        jQuery('#part2Easy').hide(500);
    });
    jQuery('#c17').on('click', function(event) { 
        p2 = 17;
        jQuery('#part2').hide(500);
        jQuery('#part3').show(500);
        jQuery('#part2Easy').hide(500);
    });
    
    //Part 3
    jQuery('#a1').on('click', function(event) { 
        jQuery('#part3').hide(500);
        jQuery('#part4').show(500);
        attackSelection = 1;
        Attack();
    });
    jQuery('#a2').on('click', function(event) { 
        jQuery('#part3').hide(500);
        jQuery('#part4').show(500);
        attackSelection = 2;
        Attack();

    });
    jQuery('#a3').on('click', function(event) { 
        jQuery('#part3').hide(500);
        jQuery('#part4').show(500);
        attackSelection = 3;
        Attack();
    });
    jQuery('#a4').on('click', function(event) { 
        jQuery('#part3').hide(500);
        jQuery('#part4').show(500);
        attackSelection = 4;
        Attack();
    });
    jQuery('#a5').on('click', function(event) { 
        jQuery('#part3').hide(500);
        jQuery('#part4').show(500);
        attackSelection = 5;
        Attack();
    });
    jQuery('#a6').on('click', function(event) { 
        jQuery('#part3').hide(500);
        jQuery('#part4').show(500);
        attackSelection = 6;
        Attack();
    });
    jQuery('#a7').on('click', function(event) { 
        jQuery('#part3').hide(500);
        jQuery('#part4').show(500);
        attackSelection = 7;
        Attack();
    });
    jQuery('#a8').on('click', function(event) { 
        jQuery('#part3').hide(500);
        jQuery('#part4').show(500);
        attackSelection = 8;
        Attack();
    });
    
    //Part 4
    jQuery('#next').on('click', function(event) {         
        jQuery('#part4').hide(500);
        jQuery('#part3').show(500);
        CheckForWinOrLoss();
    });    
    
    //Others
    jQuery('#resetGame').on('click', function(event) {         
        resetGame();
    });  
});

