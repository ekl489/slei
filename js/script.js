//Variables
var p1, p2;
var Difficulty, Class;
var playerHealth = 'Loading...', enemyHealth = 'Loading...', oldPlayerHealth = 'Loading...', oldEnemyHealth = 'Loading...';
var playerDamage = 0, enemyDamage = 0;
var parry = 0, sharpensword = 0, enemybuff = 0, potions = 0;
var playerLunged = false, playerUsedPotion = false, displayScreen = false, RLDEBuff = false, RLDEBUFFValue = 0, SharpenSword_Then_Lunge_Combo = 0, enemyBlockBuff = false;
var firstRound = true;
var attackSelection, lastAttack;
var feedback = [];

//Setup
function resetGame(){
    playerHealth = 'Loading...';
    enemyHealth = 'Loading...';
    oldPlayerHealth = 'Loading...';
    oldEnemyHealth = 'Loading...';
    playerDamage = 0;
    enemyDamage = 0;
    parry = 0;
    sharpensword = 0;
    enemybuff = 0;
    potions = 0;
    playerLunged = false;
    playerUsedPotion = false;
    displayScreen = false;
    RLDEBuff = false;
    RLDEBUFFValue = 0;
    firstRound = true;
    attackSelection = 0;
    lastAttack = 0;
    feedback = [];
    SharpenSword_Then_Lunge_Combo = 0

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
    document.getElementById("a8").style.display = "inline";
    document.getElementById("potionList1").style.display = "none";
    document.getElementById("potionList2").style.display = "none";
    enemyHealth = 200;
    Class = p2;
    switch(Class){
        case 1: //Rogue
            playerHealth = 100;
            //Recieves more potions
            //Potions heal 5+
            Class = "Rogue";
            break;
        case 2: //Paladin
            playerHealth = 100;
            //No potions
            //can use healing orb
            Class = "Paladin";
            break;
        case 3: //Goblin
            playerHealth = 70;
            //Extra 8 damage
            Class = "Goblin";
            break;
        case 4: //Thief
            playerHealth = 50;
            //Can use steal
            Class = "Thief";
            break;
        case 5: //Alchemist
            playerHealth = 30;
            //poison knife
            //Finds more potions
            Class = "Alchemist";
            break;
        case 6: //Knight
            playerHealth = 120;
            //heals 3-4 each round
            Class = "Knight";
            break;
        case 7: //Orc
            playerHealth = 120;
            //randomly does extra 15 damage
            Class = "Orc";
            break;
        case 8: //Elf
            playerHealth = 120;
            //randomly dodges attack
            Class = "Elf";
            break;
        case 9: //Witch
            playerHealth = 140;
            //Curse
            Class = "Witch";
            break;
        case 10: //Troll
            playerHealth = 350;
            //damage 4/5ths
            Class = "Troll";
            break;
        case 11: //Samurai
            playerHealth = 600;
            //takes triple damage
            //parry will block in 2 moves instead of one
            Class = "Samurai";
            break;
        case 12: //Giant
            playerHealth = 500;
            //enemy gain 500 hp
            //will miss attack sometimes
            //does 4x damage, enemy does 3x
            Class = "Giant";
            break;
        case 13: //Ogre
            playerHealth = 1000;
            //bleeds 20-50 hp each round
            Class = "Ogre";
            break;
        case 14: //Vampire
            playerHealth = 1000;
            //enemy gets +100 health
            //When attacks will lose health by double their damage
            //Bleeds 5 to 10 each round
            Class = "Vampire";
            break;
        case 15: //Dragon
            playerHealth = 750;
            Class = "Dragon";
            //check
            break;
        case 16: //Dwarf
            playerHealth = 30;
            //takes double damage
            //can use mighty shield
            Class = "Dwarf";
            break;
        case 17: //Reaper
            playerHealth = 70;
            //buffs can stack
            //Soul tear
            Class = "Reaper";
            break;
    } //Class
    switch(p1){
        case 1:
            Difficulty = "Easy";
            playerHealth += 20;
            document.getElementById("potionList1").style.display = "inline";
            document.getElementById("potionList2").style.display = "inline";
            //recieves more potion drops
            //potions are displayed
            break;
        case 2:
            Difficulty = "Medium";
            //enemy +5 damage
            break;
        case 3:
            Difficulty = "Hard";
            //Enemy has +15 damage
            break;
        case 4:
            Difficulty = "Insane";
            //enemy +15-25 dm, enemy +40 hp, non special classes do less damage, cannot roll the dice
            enemyHealth += 40;
            document.getElementById("a8").style.display = "none";
            break;
        default:
            Difficulty = "Medium";
            //enemy +5 damage
            break;
    } //Difficulty

    oldEnemyHealth = enemyHealth;
    oldPlayerHealth = playerHealth;
    UpdateData();
}

//Attack
function Attack(){
    //Special
    feedback.fill(null);
    RLDEBUFFValue = 0;
    oldEnemyHealth = enemyHealth;
    oldPlayerHealth = playerHealth;
    playerUsedPotion = false;
    playerLunged = false;

    //Check for Win/Loss
    CheckForWinOrLoss();

    //Classes
    Class_Pre_All();

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
            break;
        case 3:
            playerDamage = 25;
            //+15 damage buff to enemy;
            enemybuff = 2;
            break;
        case 4:
            playerDamage = Math.floor((Math.random() * 15) + 5);
            playerLunged = true;
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
                if(Class == "Rogue"){
                    feedback.push(AlertSuccess("You drank a potion and healed <strong>35 health</strong>."));
                    playerHealth += 35;
                }
                else{
                    feedback.push(AlertSuccess("You drank a potion and healed <strong>30 health</strong>."));
                    playerHealth += 30;
                }
                potions--;
                playerUsedPotion = true;
            }
            else{
                feedback.push(AlertDanger("You search your pocket for a potion but you don't find one. Your stupidity has let you down."));
            }
            break;
        case 8:
            playerDamage = 0;
            //roll the dice
            var x = Math.floor(Math.random() * 6);
            if(x == 0){
                feedback.push(AlertWarning("Roll the dice gives you 20 damage!"));
                playerDamage = 20;
            }
            else if(x == 1){
                feedback.push(AlertWarning("You and your enemy's health are swapped!"));
                var a = playerHealth;
                playerHealth = enemyHealth;
                enemyHealth = a;
            }
            else if(x == 2){
                feedback.push(AlertWarning("The enemy gets 20 extra damage!"));
                RLDEBuff = true;
                RLDEBUFFValue = 20;
            }
            else if(x == 3){
                feedback.push(AlertWarning("Roll the dice gives you 30 damage!"));
                playerDamage = 30;
            }
            else if(x == 4){
                feedback.push(AlertWarning("The enemy gets 35 extra damage!"));
                RLDEBuff = true;
                RLDEBUFFValue = 35;
            }
            else if(x == 5){
                feedback.push(AlertWarning("You find 3 potions!"));
                potions += 3;
            }
            else{
                feedback.push(AlertWarning("Nothing happend..."));
            }
            break;
        default:
            break;
    } //Attack Selection
    
    //Sharpen Sword Then Lunge Combo
    if(attackSelection == 4 && lastAttack == 6){
        SharpenSword_Then_Lunge_Combo += 1;
        if(playerDamage > Math.floor(SharpenSword_Then_Lunge_Combo * 2.5) && SharpenSword_Then_Lunge_Combo > 2){
            enemyBlockBuff = true;
        }
    }

    //Calculate Enemy Damage
    enemyDamage = Math.floor((Math.random() * 20) + 2);
    if(Difficulty == "Medium"){
        enemyDamage += 5;
    }
    else if(Difficulty == "Hard"){
        enemyDamage += 15;
    }
    else if(Difficulty == "Insane"){
        enemyDamage += Math.floor((Math.random() * 10) + 15);
        if(Class != 5 && Class != 12 && Class != 14 && Class != 15 && Class != 16 && Class != 17){
            enemyDamage += 6;
        }
    }
    if(enemybuff == 1){
        RLDEBuff = true;
        RLDEBUFFValue += 15;
        feedback.push(AlertDanger("The enemy gets a 15 damage buff!"));
    }
    enemybuff--;
    if(RLDEBuff){
        RLDEBuff = false;
        enemyDamage += RLDEBUFFValue;
    }
    
    //More Damage for Losing Player
    if(enemyHealth > playerHealth && playerDamage > 10){
        playerDamage += Math.floor(Math.random() * 10) + 5);
        console.log("enemy has more health");
    }
    else if(enemyHealth < playerHealth){
        enemyDamage += 5;
        console.log("player has more health");
    }

    //Damage Buff?
    if(sharpensword == 1 && (attackSelection == 1 ||attackSelection == 2 || attackSelection == 3 ||attackSelection == 4)){
        playerDamage += 10;
        feedback.push(AlertWarning("You get a <strong>10 damage</strong> buff!"));
        sharpensword--;
    }
    else if(sharpensword == 1){

    }
    else if(lastAttack == 6 && attackSelection == 6){
        feedback.push(AlertWarning("You try to sharpen your sword but there is no effect!"));
        sharpensword--;
    }
    else if(sharpensword == 2){
        sharpensword--;
    }

    //Repeated Attack?
    if(lastAttack == attackSelection && (attackSelection == 1 || attackSelection == 2 || attackSelection == 3 || attackSelection == 4)){
        feedback.push(AlertWarning("You repeated the attack and this time isn't as strong."));
        playerDamage = Math.floor(playerDamage / 2);
    }

    //Enemy Parry + Damage
    if(enemyBlockBuff == true && Math.floor(Math.random() * 4.5) == 0){
        feedback.push(AlertDanger("<strong>But!</strong> The enemy blocked your attack!"));
        playerDamage = 0;
    }
    else if(Math.floor((Math.random() * 7) + 0) == 0){
        feedback.push(AlertDanger("<strong>But!</strong> The enemy blocked your attack!"));
        playerDamage = 0;
    }

    //Find a potion?
    if(Class == "Rogue" || Difficulty == "Easy"){
        if(Math.floor((Math.random() * 4.5)) == 0){
        feedback.push(AlertSuccess("You don't deserve to live you piece of shit!"));
        potions++;
        }
    }
    else if(Math.floor((Math.random() * 6)) == 0){
        feedback.push(AlertSuccess("You have found a potion!"));
        potions++;
    }

    //Class_Pre_Damage()
    Class_Pre_Damage();

    //Deal Damage
    if(playerDamage > 0){
        enemyHealth -= playerDamage;
        feedback.push(AlertSuccess("You dealt <strong>" + playerDamage + "</strong> damage!"));
    }
    if(parry == 2 && lastAttack == attackSelection){
        feedback.push(AlertInfo("You repeated parry but there was no effect!"));
    }
    else if(parry == 1){
        feedback.push(AlertSuccess("The enemy did <strong>" + enemyDamage + "</strong> damage but was blocked by your parry!"));
    }
    else{
        feedback.push(AlertDanger("The enemy did <strong>" + enemyDamage + "</strong> damage!"));
        playerHealth -= enemyDamage;
    }
    parry--;

    //Special heal - lunge
    if(attackSelection == 4 && playerDamage > 0){
        playerHealth += playerDamage;
        feedback.push(AlertSuccess("Your lunge healed you by <strong>" + playerDamage + "</strong> health."));
    }
    
    //Next Round
    enemyBlockBuff = false;
    lastAttack = attackSelection;
    CheckForWinOrLoss();
    firstRound = false;
    displayScreen = true;
    UpdateData();
    ShowAlerts();
}

//Class Events
function Class_Pre_All(){
    switch(Class){
        case "Rogue":
            break;
        case "Paladin":
            break;
        case "Goblin":
            break;
        case "Thief":
            break;
        case "Alchemist":
            break;
        case "Knight":
            var knightHeal = Math.floor((Math.random() * 2) + 3);
            feedback.push(AlertInfo("Your knightly strength healed you by " + knightHeal + "!"));
            playerHealth += knightHeal;
            break;
        case "Orc":
            if(Math.floor(Math.random() * 2) == 0){
                feedback.push(AlertInfo("Your Orc strength gave you an extra <strong>15</strong> damage!"));
                enemyHealth -= 15;
            }
            break;
        case "Elf":
            break;
        case "Witch":
            break;
        case "Troll":
            break;
        case "Samurai":
            break;
        case "Giant":
            break;
        case "Ogre":
            break;
        case "Vampire":
            break;
        case "Dragon":
            break;
        case "Dwarf":
            break;
        case "Reaper":
            break;
    }
}
function Class_Pre_Damage(){
    switch(Class){
        case "Rogue":
            break;
        case "Paladin":
            break;
        case "Goblin":
            playerDamage = playerDamage + 8;
            break;
        case "Thief":
            break;
        case "Alchemist":
            break;
        case "Knight":
            break;
        case "Orc":
            break;
        case "Elf":
            if(Math.floor((Math.random() * 6)) == 0){
                feedback.push(AlertInfo("Your Elvish speed allowed you to dodge the nemy attack."));
                enemyDamage = 0;
            }
            break;
        case "Witch":
            break;
        case "Troll":
            playerDamage = Math.floor(playerDamage * 0.6);
            break;
        case "Samurai":
            break;
        case "Giant":
            break;
        case "Ogre":
            var bleed = Math.floor(Math.random() * 250) + 50;
            feedback.push(AlertDanger("You bleed " + bleed + " health."));
            playerHealth -= bleed;
            break;
        case "Vampire":
            break;
        case "Dragon":
            break;
        case "Dwarf":
            break;
        case "Reaper":
            break;
    }
}

//Process Functions
function UpdateData(){
    if(displayScreen){ //Display Screen
        if(playerLunged){
            document.getElementById("player-health2").innerHTML = oldPlayerHealth + "<span class='text-danger'> - " + enemyDamage + "</span><span class='text-warning'> + " + playerDamage + "</span> = " + playerHealth;
        } //Lunge
        else if(playerUsedPotion){
            if(Class == "Rogue"){
                document.getElementById("player-health2").innerHTML = oldPlayerHealth + "<span class='text-danger'> - " + enemyDamage + "</span><span class='text-warning'> + 35</span> = " + playerHealth;
            }
            else{
                document.getElementById("player-health2").innerHTML = oldPlayerHealth + "<span class='text-danger'> - " + enemyDamage + "</span><span class='text-warning'> + 30</span> = " + playerHealth;
            }
        } //Potion
        else{
            document.getElementById("player-health2").innerHTML = oldPlayerHealth + "<span class='text-danger'> - " + enemyDamage + "</span> = " + playerHealth;
        }
        if(playerDamage > 0){
            document.getElementById("enemy-health2").innerHTML = oldEnemyHealth + "<span class='text-danger'> - " + playerDamage + "</span> = " + enemyHealth;
        }
        else{
            document.getElementById("enemy-health2").innerHTML = oldEnemyHealth + " <span class='text-danger'>- 0</span> = " + enemyHealth;
        }
    }
    document.getElementById("player-health").innerHTML = playerHealth;
    document.getElementById("enemy-health").innerHTML = enemyHealth;

    if(Difficulty == "Easy"){
        document.getElementById("potions").innerHTML = "<span style='color: #eee;'>Potions: </span><span class='health-display'>" + potions + "</span>";
        document.getElementById("potions2").innerHTML = "<span style='color: #eee;'>Potions: </span><span class='health-display'>" + potions + "</span>";
    }
    displayScreen = false;
}
function ShowAlerts(){
    document.getElementById("feedback").innerHTML = feedback.join("");
}
function CheckForWinOrLoss(){
    if(playerHealth < 1 && enemyHealth < 1){
        jQuery('#part3').hide(500);
        jQuery('#part4').hide(500);
        jQuery('#endGameScreen').show(500);
        document.getElementById("endGameText").innerHTML = AlertInfo("<h3>It is a draw!</h3><br>Your Health: " + playerHealth + "<br>Enemy Health: " + enemyHealth + "<br>Potions: " + potions);
    }
    else if(playerHealth < 1){
        jQuery('#part3').hide(500);
        jQuery('#part4').hide(500);
        jQuery('#endGameScreen').show(500);
        document.getElementById("endGameText").innerHTML = AlertDanger("<h3>You have lost!</h3><br>Your Health: " + playerHealth + "<br>Enemy Health: " + enemyHealth + "<br>Potions: " + potions);
    }
    else if(enemyHealth < 1){
        jQuery('#part3').hide(500);
        jQuery('#part4').hide(500);
        jQuery('#endGameScreen').show(500);
        document.getElementById("endGameText").innerHTML = AlertSuccess("<h3>You have won!</h3><br>Your Health: " + playerHealth + "<br>Enemy Health: " + enemyHealth + "<br>Potions: " + potions);
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
    //Difficulty Selection
    jQuery('#d1').on('click', function(event) {
        p1 = 1;
        jQuery('#part1').children().hide(500);
        jQuery('#part2').show(500);
    });
    jQuery('#d2').on('click', function(event) {
        p1 = 2;
        jQuery('#part1').hide(500);
        jQuery('#part2').show(500);
    });
    jQuery('#d3').on('click', function(event) {
        p1 = 3;
        jQuery('#part1').hide(500);
        jQuery('#part2').show(500);
    });
    jQuery('#d4').on('click', function(event) {
        p1 = 4;
        jQuery('#part1').hide(500);
        jQuery('#part2').show(500);
    });

    //Class Selection 1
    jQuery('#c1').on('click', function(event) {
        p2 = 1;
        jQuery('#part2').hide(500);
        jQuery('#part2Easy').hide(500);
        jQuery('#part3').show(500);
        startGame();
    });
    jQuery('#c2').on('click', function(event) {
        p2 = 2;
        jQuery('#part2').hide(500);
        jQuery('#part3').show(500);
        jQuery('#part2Easy').hide(500);
        startGame();
    });
    jQuery('#c3').on('click', function(event) {
        p2 = 3;
        jQuery('#part2').hide(500);
        jQuery('#part3').show(500);
        jQuery('#part2Easy').hide(500);
        startGame();
    });
    jQuery('#c4').on('click', function(event) {
        p2 = 4;
        jQuery('#part2').hide(500);
        jQuery('#part3').show(500);
        jQuery('#part2Easy').hide(500);
        startGame();
    });
    jQuery('#c5').on('click', function(event) {
        p2 = 5;
        jQuery('#part2').hide(500);
        jQuery('#part3').show(500);
        jQuery('#part2Easy').hide(500);
        startGame();
    });
    jQuery('#c6').on('click', function(event) {
        p2 = 6;
        jQuery('#part2').hide(500);
        jQuery('#part3').show(500);
        jQuery('#part2Easy').hide(500);
        startGame();
    });
    jQuery('#c7').on('click', function(event) {
        p2 = 7;
        jQuery('#part2').hide(500);
        jQuery('#part3').show(500);
        jQuery('#part2Easy').hide(500);
        startGame();
    });
    jQuery('#c8').on('click', function(event) {
        p2 = 8;
        jQuery('#part2').hide(500);
        jQuery('#part3').show(500);
        jQuery('#part2Easy').hide(500);
        startGame();
    });
    jQuery('#c9').on('click', function(event) {
        p2 = 9;
        jQuery('#part2').hide(500);
        jQuery('#part3').show(500);
        jQuery('#part2Easy').hide(500);
        startGame();
    });
    jQuery('#c10').on('click', function(event) {
        p2 = 10;
        jQuery('#part2').hide(500);
        jQuery('#part3').show(500);
        jQuery('#part2Easy').hide(500);
        startGame();
    });
    jQuery('#c11').on('click', function(event) {
        p2 = 11;
        jQuery('#part2').hide(500);
        jQuery('#part3').show(500);
        jQuery('#part2Easy').hide(500);
        startGame();
    });
    jQuery('#c12').on('click', function(event) {
        p2 = 12;
        jQuery('#part2').hide(500);
        jQuery('#part3').show(500);
        jQuery('#part2Easy').hide(500);
        startGame();
    });
    jQuery('#c13').on('click', function(event) {
        p2 = 13;
        jQuery('#part2').hide(500);
        jQuery('#part3').show(500);
        jQuery('#part2Easy').hide(500);
        startGame();
    });
    jQuery('#c14').on('click', function(event) {
        p2 = 14;
        jQuery('#part2').hide(500);
        jQuery('#part3').show(500);
        jQuery('#part2Easy').hide(500);
        startGame();
    });
    jQuery('#c15').on('click', function(event) {
        p2 = 15;
        jQuery('#part2').hide(500);
        jQuery('#part3').show(500);
        jQuery('#part2Easy').hide(500);
        startGame();
    });
    jQuery('#c16').on('click', function(event) {
        p2 = 16;
        jQuery('#part2').hide(500);
        jQuery('#part3').show(500);
        jQuery('#part2Easy').hide(500);
        startGame();
    });
    jQuery('#c17').on('click', function(event) {
        p2 = 17;
        jQuery('#part2').hide(500);
        jQuery('#part3').show(500);
        jQuery('#part2Easy').hide(500);
        startGame();
    });

    //Class Selection 2
    jQuery('#c1b').on('click', function(event) {
        p2 = 1;
        jQuery('#part2').hide(500);
        jQuery('#part2Easy').hide(500);
        jQuery('#part3').show(500);
        startGame();
    });
    jQuery('#c2b').on('click', function(event) {
        p2 = 2;
        jQuery('#part2').hide(500);
        jQuery('#part3').show(500);
        jQuery('#part2Easy').hide(500);
        startGame();
    });
    jQuery('#c3b').on('click', function(event) {
        p2 = 3;
        jQuery('#part2').hide(500);
        jQuery('#part3').show(500);
        jQuery('#part2Easy').hide(500);
        startGame();
    });
    jQuery('#c4b').on('click', function(event) {
        p2 = 4;
        jQuery('#part2').hide(500);
        jQuery('#part3').show(500);
        jQuery('#part2Easy').hide(500);
        startGame();
    });
    jQuery('#c5b').on('click', function(event) {
        p2 = 5;
        jQuery('#part2').hide(500);
        jQuery('#part3').show(500);
        jQuery('#part2Easy').hide(500);
        startGame();
    });
    jQuery('#c6b').on('click', function(event) {
        p2 = 6;
        jQuery('#part2').hide(500);
        jQuery('#part3').show(500);
        jQuery('#part2Easy').hide(500);
        startGame();
    });
    jQuery('#c7b').on('click', function(event) {
        p2 = 7;
        jQuery('#part2').hide(500);
        jQuery('#part3').show(500);
        jQuery('#part2Easy').hide(500);
        startGame();
    });
    jQuery('#c8b').on('click', function(event) {
        p2 = 8;
        jQuery('#part2').hide(500);
        jQuery('#part3').show(500);
        jQuery('#part2Easy').hide(500);
        startGame();
    });
    jQuery('#c9b').on('click', function(event) {
        p2 = 9;
        jQuery('#part2').hide(500);
        jQuery('#part3').show(500);
        jQuery('#part2Easy').hide(500);
        startGame();
    });
    jQuery('#c10b').on('click', function(event) {
        p2 = 10;
        jQuery('#part2').hide(500);
        jQuery('#part3').show(500);
        jQuery('#part2Easy').hide(500);
        startGame();
    });
    jQuery('#c11b').on('click', function(event) {
        p2 = 11;
        jQuery('#part2').hide(500);
        jQuery('#part3').show(500);
        jQuery('#part2Easy').hide(500);
        startGame();
    });
    jQuery('#c12b').on('click', function(event) {
        p2 = 12;
        jQuery('#part2').hide(500);
        jQuery('#part3').show(500);
        jQuery('#part2Easy').hide(500);
        startGame();
    });
    jQuery('#c13b').on('click', function(event) {
        p2 = 13;
        jQuery('#part2').hide(500);
        jQuery('#part3').show(500);
        jQuery('#part2Easy').hide(500);
        startGame();
    });
    jQuery('#c14b').on('click', function(event) {
        p2 = 14;
        jQuery('#part2').hide(500);
        jQuery('#part3').show(500);
        jQuery('#part2Easy').hide(500);
        startGame();
    });
    jQuery('#c15b').on('click', function(event) {
        p2 = 15;
        jQuery('#part2').hide(500);
        jQuery('#part3').show(500);
        jQuery('#part2Easy').hide(500);
        startGame();
    });
    jQuery('#c16b').on('click', function(event) {
        p2 = 16;
        jQuery('#part2').hide(500);
        jQuery('#part3').show(500);
        jQuery('#part2Easy').hide(500);
        startGame();
    });
    jQuery('#c17b').on('click', function(event) {
        p2 = 17;
        jQuery('#part2').hide(500);
        jQuery('#part3').show(500);
        jQuery('#part2Easy').hide(500);
        startGame();
    });

    //Attack Selection
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

