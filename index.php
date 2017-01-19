<?php header( 'Location: /index.html' ) ;  ?>
<!DOCTYPE html>
<html>
    <head>
        <!-- SEO Meta Tags -->
        <meta name="description" content="A fantasy themed strategic turn based battle game with a wide range of classes and difficulties to allow more enjoyment.">
        <link rel="author" href="https://plus.google.com/110549748317155171931"/>
        <meta name="keywords" content="game, slei, Nick Ramsay, play, ii-advisory.com, ii advisory, play slei, ekl">

        <!-- Bootstrap -->
        <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css"/>

        <!-- Theme -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/3.3.5/darkly/bootstrap.min.css" rel="stylesheet" />

        <!-- JQuery -->
        <script src="bower_components/jquery/dist/jquery.min.js"></script>

        <!-- Font -->
        <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">

        <!-- Slei -->
        <title>Play Slei</title>
        <link rel="stylesheet" type="text/css" href="css/styles.css"/>
        <link rel="icon" href="icon/favicon.ico">

        <!-- Media Device -->
        <link rel="stylesheet" type="text/css" media="only screen and (max-device-width: 480px)" href="css/mobile.css"/>
    </head>
    <body>

        <!-- Wrapper -->
        <div class="jumbotron game">
            <!-- Navigation Menu & Title -->
            <nav class="navbar navbar-default">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">Slei ALPHA V2.1</a>
                </div>
                <a href="#"><button class="btn" style="float: right; margin: 5px; color: #222222;" data-toggle="modal" data-target="#info-menu">Info <span class="glyphicon glyphicon-info-sign"></span></button></a>
                <a href="#"><button class="btn" style="float: right; margin: 5px; color: #222222;" data-toggle="modal" data-target="#help-menu">Help <span class="glyphicon glyphicon-question-sign"></span></button></a>
            </nav>

            <!-- Game Window -->
            <div class="container" id="game">
                <!-- Difficulty Selection -->
                <div id="part1" class="part">
                    <ul id="o-select">
                        <li><h2>Select Difficulty:</h2></li>
                        <li>
                            <button type="button" class="buttonDropDown btn btn-primary btn-lg btn-block" id="d1">Easy
                                <ul class="list-group dropDownMenu">
                                    <li><hr></li>
                                    <li>-<strong>+20</strong> Health</li>
                                    <li>-Receives more potion drops</li>
                                    <li>-Potions are displayed</li>
                                </ul>
                            </button>
                        </li> <!-- Easy -->
                        <li>
                            <button type="button" class="buttonDropDown btn btn-primary btn-lg btn-block" id="d2">Medium
                                <ul class="list-group dropDownMenu">
                                    <li><hr></li>
                                    <li>-Potions are <strong>not</strong> displayed</li>
                                    <li>-Enemy has <strong>+5</strong> damage</li>
                                </ul>
                            </button>
                        </li> <!-- Medium -->
                        <li>
                            <button type="button" class="buttonDropDown btn btn-primary btn-lg btn-block" id="d3">Hard
                                <ul class="list-group dropDownMenu">
                                    <li><hr></li>
                                    <li>-Potions are <strong>not</strong> displayed</li>
                                    <li>-Enemy has <strong>+15</strong> damage</li>
                                </ul>
                            </button>
                        </li> <!-- Hard -->
                        <li>
                            <button type="button" class="buttonDropDown btn btn-danger btn-lg btn-block" id="d4">Insane
                                <ul class="list-group dropDownMenu">
                                    <li><hr></li>
                                    <li>-Potions are <strong>not</strong> displayed</li>
                                    <li>-Enemy has <strong>+15 - 25</strong> damage</li>
                                    <li>-Enemy has <strong>+40</strong> health</li>
                                    <li>-Non special classes do less damage</li>
                                    <li>-Cannot roll the dice</li>
                                </ul>
                            </button>
                        </li> <!-- Insane -->
                    </ul>
                </div>

                <!-- Class Selection -->
                <div id="part2" class="part" style="display: none">
                    <h2>Select Class:</h2>

                    <!-- Pill Menu -->
                    <ul class="nav nav-pills" style="display: none;">
                        <li class="active"><a data-toggle="pill" href="#difficulty">Listed by Difficulty</a></li>
                        <li><a data-toggle="pill" href="#type">Listed by Type</a></li>
                    </ul>
                    <div class="tab-content">
                        <div id="difficulty" class="tab-pane fade in active">
                            <h3 class="row col-md-12">Main</h3>
                            <div class="class-button panel panel-default col-md-2" id="c6">
                                <div class="panel-heading">Knight</div>
                                <div class="panel-body">
                                    <ul>
                                        <li><strong>120</strong> Health</li>
                                        <li>Heals <strong>3</strong> to <strong>4</strong> health each round</li>
                                    </ul>
                                </div>
                            </div> <!-- Knight -->
                            <div class="class-button panel panel-default col-md-2" id="c7">
                                <div class="panel-heading">Orc</div>
                                <div class="panel-body">
                                    <ul>
                                        <li><strong>120</strong> Health</li>
                                        <li>Randomly does extra <strong>15</strong> damage</li>
                                    </ul>
                                </div>
                            </div> <!-- Orc -->
                            <div class="class-button panel panel-default col-md-2" id="c8">
                                <div class="panel-heading">Elf</div>
                                <div class="panel-body">
                                    <ul>
                                        <li><strong>120</strong> Health</li>
                                        <li>Randomly dodges enemy attack</li>
                                    </ul>
                                </div>
                            </div> <!-- Elf -->
                            <div class="class-button panel panel-default col-md-2" id="c9">
                                <div class="panel-heading">Witch</div>
                                <div class="panel-body">
                                    <ul>
                                        <li><strong>140</strong> Health</li>
                                        <li>Special <i>Curse</i> attack. Set enemy and your health to 70.</li>
                                    </ul>
                                </div>
                            </div> <!-- Witch -->
                            <h3 class="row col-md-12">Experienced</h3>
                            <div class="class-button panel panel-default col-md-2" id="c10">
                                <div class="panel-heading">Troll</div>
                                <div class="panel-body">
                                    <ul>
                                        <li><strong>350</strong> Health</li>
                                        <li>Only does <strong>3</strong>/<strong>5</strong>ths of normal damage</li>
                                    </ul>
                                </div>
                            </div> <!-- Troll -->
                            <div class="class-button panel panel-default col-md-2" id="c1">
                                <div class="panel-heading">Rogue</div>
                                <div class="panel-body">
                                    <ul>
                                        <li><strong>100</strong> Health</li>
                                        <li>Receives more potion drops</li>
                                        <li>Potions heal <strong>+5</strong> health</li>
                                    </ul>
                                </div>
                            </div> <!-- Rogue -->
                            <div class="class-button panel panel-default col-md-2" id="c2">
                                <div class="panel-heading">Paladin</div>
                                <div class="panel-body">
                                    <ul>
                                        <li><strong>100</strong> Health</li>
                                        <li>No Potions</li>
                                        <li>Can use <i>Healing Orb</i> to gain 10-20 health (or small chance of <strong>0</strong>) anytime</li>
                                    </ul>
                                </div>
                            </div> <!-- Paladin -->
                            <div class="class-button panel panel-default col-md-2" id="c3">
                                <div class="panel-heading">Goblin</div>
                                <div class="panel-body">
                                    <ul>
                                        <li><strong>60</strong> Health</li>
                                        <li>Extra <strong>8</strong> damage which can't be blocked</li>
                                    </ul>
                                </div>
                            </div> <!-- Goblin -->
                            <div class="class-button panel panel-default col-md-2" id="c4">
                                <div class="panel-heading">Thief</div>
                                <div class="panel-body">
                                    <ul>
                                        <li><strong>50</strong> Health</li>
                                        <li>Can use <i>Steal</i> to not take damage, and enemy will lose health by half their damage</li>
                                    </ul>
                                </div>
                            </div> <!-- Thief -->
                            <div class="class-button panel panel-default col-md-2" id="c13">
                                <div class="panel-heading">Ogre</div>
                                <div class="panel-body">
                                    <ul>
                                        <li><strong>1000</strong> Health</li>
                                        <li>Bleeds <strong>50</strong> to <strong>200</strong> health each round</li>
                                    </ul>
                                </div>
                            </div> <!-- Ogre -->

                            <h3 class="row col-md-12">Hard</h3>
                            <div class="class-button panel panel-default col-md-2" id="c5">
                                <div class="panel-heading">Alchemist</div>
                                <div class="panel-body">
                                    <ul>
                                        <li><strong>30</strong> Health</li>
                                        <li>Can use <i>Poison Knife</i> for <strong>+20</strong> damage buff</li>
                                        <li>Finds more potions</li>
                                    </ul>
                                </div>
                            </div> <!-- Alechemist -->
                            <div class="class-button panel panel-default col-md-2" id="c11">
                                <div class="panel-heading">Samurai</div>
                                <div class="panel-body">
                                    <ul>
                                        <li><strong>600</strong> Health</li>
                                        <li>Takes triple damage</li>
                                        <li>Parry will block in <strong>2</strong> moves instead of <strong>1</strong></li>
                                    </ul>
                                </div>
                            </div> <!-- Samurai -->
                            <div class="class-button panel panel-default col-md-2" id="c12">
                                <div class="panel-heading">Giant</div>
                                <div class="panel-body">
                                    <ul>
                                        <li><strong>500</strong> Health</li>
                                        <li>Enemy gains <strong>500</strong> health</li>
                                        <li>Will miss attacks sometimes</li>
                                        <li>Does <strong>4x</strong> more damage, enemy does <strong>3x</strong> more damage</li>
                                    </ul>
                                </div>
                            </div> <!-- Giant -->
                            <div class="class-button panel panel-default col-md-2" id="c14">
                                <div class="panel-heading">Vampire</div>
                                <div class="panel-body">
                                    <ul>
                                        <li><strong>1000</strong> Health</li>
                                        <li>Enemy gets <strong>+100</strong> health</li>
                                        <li>When attacks will lose health by double their damage</li>
                                        <li>Bleeds <strong>5</strong> to <strong>10</strong> health each round</li>
                                    </ul>
                                </div>
                            </div> <!-- Vampire -->

                            <h3 class="row col-md-12">Insane</h3>
                            <div class="class-button panel panel-default col-md-2" id="c15">
                                <div class="panel-heading">Dragon</div>
                                <div class="panel-body">
                                    <ul>
                                        <li><strong>750</strong> Health</li>
                                        <li>Enemy gets <strong>+850</strong> health</li>
                                        <li>Special attacks such as:
                                            <ul>
                                                <li><i>Breath Fire</i></li>
                                                <li><i>Bite</i></li>
                                                <li><i>Claw Slash</i></li>
                                                <li><i>Wind Dodge (rare)</i></li>
                                                <li><i>Rage (rare)</i></li>
                                            </ul>
                                        </li>
                                        <li>No potions</li>
                                    </ul>
                                </div>
                            </div> <!-- Dragon -->
                            <div class="class-button panel panel-default col-md-2" id="c16">
                                <div class="panel-heading">Dwarf</div>
                                <div class="panel-body">
                                    <ul>
                                        <li><strong>30</strong> Health</li>
                                        <li>Takes double damage</li>
                                        <li>Can use <i>Mighty Shield</i> to heal <strong>120</strong> to <strong>220</strong> health</li>
                                    </ul>
                                </div>
                            </div> <!-- Dwarf -->
                            <div class="class-button panel panel-default col-md-2" id="c17">
                                <div class="panel-heading">Reaper</div>
                                <div class="panel-body">
                                    <ul>
                                        <li><strong>70</strong> Health</li>
                                        <li>Buffs can stack</li>
                                        <li>Can use <i>Soul Tear</i>  to take no damage and make enemy bleed <strong>1</strong> to <strong>3</strong> damage for up to <strong>7</strong> turns</li>
                                    </ul>
                                </div>
                            </div> <!-- Reaper -->
                        </div>
                        <div id="type" class="tab-pane fade">
                            <h3 class="col-sm-12">Lightweight</h3>
                            <div class="class-button panel panel-default col-md-2" id="c1b">
                                <div class="panel-heading">Rogue</div>
                                <div class="panel-body">
                                    <ul>
                                        <li><strong>100</strong> Health</li>
                                        <li>Receives more potion drops</li>
                                        <li>Potions heal <strong>+5</strong> health</li>
                                    </ul>
                                </div>
                            </div> <!-- Rogue -->
                            <div class="class-button panel panel-default col-md-2" id="c2b">
                                <div class="panel-heading">Paladin</div>
                                <div class="panel-body">
                                    <ul>
                                        <li><strong>100</strong> Health</li>
                                        <li>No Potions</li>
                                        <li>Can use <i>Healing Orb</i> to gain 10-20 health (or small chance of <strong>0</strong>) anytime</li>
                                    </ul>
                                </div>
                            </div> <!-- Paladin -->
                            <div class="class-button panel panel-default col-md-2" id="c3b">
                                <div class="panel-heading">Goblin</div>
                                <div class="panel-body">
                                    <ul>
                                        <li><strong>70</strong> Health</li>
                                        <li>Extra <strong>8</strong> damage which can't be blocked</li>
                                    </ul>
                                </div>
                            </div> <!-- Goblin -->
                            <div class="class-button panel panel-default col-md-2" id="c4b">
                                <div class="panel-heading">Thief</div>
                                <div class="panel-body">
                                    <ul>
                                        <li><strong>50</strong> Health</li>
                                        <li>Can use <i>Steal</i> to not take damage, and enemy will lose health by half their damage</li>
                                    </ul>
                                </div>
                            </div> <!-- Thief -->
                            <div class="class-button panel panel-default col-md-2" id="c5b">
                                <div class="panel-heading">Alchemist</div>
                                <div class="panel-body">
                                    <ul>
                                        <li><strong>30</strong> Health</li>
                                        <li>Can use <i>Poison Knife</i> for <strong>+20</strong> damage buff</li>
                                        <li>Finds more potions</li>
                                    </ul>
                                </div>
                            </div> <!-- Alechemist -->

                            <h3 class="col-sm-12">Midrange</h3>
                            <div class="class-button panel panel-default col-md-2" id="c6b">
                                <div class="panel-heading">Knight</div>
                                <div class="panel-body">
                                    <ul>
                                        <li><strong>120</strong> Health</li>
                                        <li>Heals <strong>3</strong> to <strong>4</strong> health each round</li>
                                    </ul>
                                </div>
                            </div> <!-- Knight -->
                            <div class="class-button panel panel-default col-md-2" id="c7b">
                                <div class="panel-heading">Orc</div>
                                <div class="panel-body">
                                    <ul>
                                        <li><strong>120</strong> Health</li>
                                        <li>Randomly does extra <strong>15</strong> damage</li>
                                    </ul>
                                </div>
                            </div> <!-- Orc -->
                            <div class="class-button panel panel-default col-md-2" id="c8b">
                                <div class="panel-heading">Elf</div>
                                <div class="panel-body">
                                    <ul>
                                        <li><strong>120</strong> Health</li>
                                        <li>Randomly dodges enemy attack</li>
                                    </ul>
                                </div>
                            </div> <!-- Elf -->
                            <div class="class-button panel panel-default col-md-2" id="c9b">
                                <div class="panel-heading">Witch</div>
                                <div class="panel-body">
                                    <ul>
                                        <li><strong>140</strong> Health</li>
                                        <li>Special <i>Curse</i> attack. Set enemy and your health to 70.</li>
                                    </ul>
                                </div>
                            </div> <!-- Witch -->

                            <h3 class="col-sm-12">Tank</h3>
                            <div class="class-button panel panel-default col-md-2" id="c10b">
                                <div class="panel-heading">Troll</div>
                                <div class="panel-body">
                                    <ul>
                                        <li><strong>350</strong> Health</li>
                                        <li>Damage only does <strong>3</strong>/<strong>5</strong>ths of normal damage</li>
                                    </ul>
                                </div>
                            </div> <!-- Troll -->
                            <div class="class-button panel panel-default col-md-2" id="c11b">
                                <div class="panel-heading">Samurai</div>
                                <div class="panel-body">
                                    <ul>
                                        <li><strong>600</strong> Health</li>
                                        <li>Takes triple damage</li>
                                        <li>Parry will block in <strong>2</strong> moves instead of <strong>1</strong></li>
                                    </ul>
                                </div>
                            </div> <!-- Samurai -->
                            <div class="class-button panel panel-default col-md-2" id="c12b">
                                <div class="panel-heading">Giant</div>
                                <div class="panel-body">
                                    <ul>
                                        <li><strong>500</strong> Health</li>
                                        <li>Enemy gains <strong>500</strong> health</li>
                                        <li>Will miss attacks sometimes</li>
                                        <li>Does <strong>4x</strong> more damage, enemy does <strong>3x</strong> more damage</li>
                                    </ul>
                                </div>
                            </div> <!-- Giant -->
                            <div class="class-button panel panel-default col-md-2" id="c13b">
                                <div class="panel-heading">Ogre</div>
                                <div class="panel-body">
                                    <ul>
                                        <li><strong>1000</strong> Health</li>
                                        <li>Bleeds <strong>50</strong> to <strong>200</strong> health each round</li>
                                    </ul>
                                </div>
                            </div> <!-- Ogre -->
                            <div class="class-button panel panel-default col-md-2" id="c14b">
                                <div class="panel-heading">Vampire</div>
                                <div class="panel-body">
                                    <ul>
                                        <li><strong>1000</strong> Health</li>
                                        <li>Enemy gets <strong>+100</strong> health</li>
                                        <li>When attacks will lose health by double their damage</li>
                                        <li>Bleeds <strong>5</strong> to <strong>10</strong> health each round</li>
                                    </ul>
                                </div>
                            </div> <!-- Vampire -->

                            <h3 class="col-sm-12">Special</h3>
                            <div class="class-button panel panel-default col-md-2" id="c15">
                                <div class="panel-heading">Dragon</div>
                                <div class="panel-body">
                                    <ul>
                                        <li><strong>750</strong> Health</li>
                                        <li>Enemy gets <strong>+850</strong> health</li>
                                        <li>Special attacks such as:
                                            <ul>
                                                <li><i>Breath Fire</i></li>
                                                <li><i>Bite</i></li>
                                                <li><i>Claw Slash</i></li>
                                                <li><i>Wind Dodge (rare)</i></li>
                                                <li><i>Rage (rare)</i></li>
                                            </ul>
                                        </li>
                                        <li>No potions</li>
                                    </ul>
                                </div>
                            </div> <!-- Dragon -->
                            <div class="class-button panel panel-default col-md-2" id="c16">
                                <div class="panel-heading">Dwarf</div>
                                <div class="panel-body">
                                    <ul>
                                        <li><strong>30</strong> Health</li>
                                        <li>Takes double damage</li>
                                        <li>Can use <i>Mighty Shield</i> to heal <strong>120</strong> to <strong>220</strong> health</li>
                                    </ul>
                                </div>
                            </div> <!-- Dwarf -->
                            <div class="class-button panel panel-default col-md-2" id="c17">
                                <div class="panel-heading">Reaper</div>
                                <div class="panel-body">
                                    <ul>
                                        <li><strong>70</strong> Health</li>
                                        <li>Buffs can stack</li>
                                        <li>Can use <i>Soul Tear</i>  to take no damage and make enemy bleed <strong>1</strong> to <strong>3</strong> damage for up to <strong>7</strong> turns</li>
                                    </ul>
                                </div>
                            </div> <!-- Reaper -->
                        </div>
                    </div>
                </div>

                <!-- Attack Selection -->
                <div id="part3" class="part" style="display: none">
                    <ul id="o-select">
                        <li><h2>Your Health: <span class="health-display" id="player-health">100</span></h2></li>
                        <li><h2>Enemy Health: <span class="health-display" id="enemy-health">100</span></h2></li>
                        <li id="potionList1"><h2 id="potions"></h2></li>
                        <li><br></li>
                        <li><h2 style="color:#33f">Select Attack:</h2></li>
                        <li><a href="#"><button type="button" class="btn btn-primary btn-lg btn-block" id="a1">Stab - [5 - 25 Damage]</button></a></li>
                        <li><a href="#"><button type="button" class="btn btn-primary btn-lg btn-block" id="a2">Slice - [5 damage + a small chance of 30 damage]</button></a></li>
                        <li><a href="#"><button type="button" class="btn btn-primary btn-lg btn-block" id="a3">Swing - [25 damage + 15 damage for enemy]</button></a></li>
                        <li><a href="#"><button type="button" class="btn btn-primary btn-lg btn-block" id="a4">Lunge - [5 - 15 damage + heal damage done to enemy]</button></a></li>
                        <li><a href="#"><button type="button" class="btn btn-primary btn-lg btn-block" id="a5">Parry - [Block enemy's next attack]</button></a></li>
                        <li><a href="#"><button type="button" class="btn btn-primary btn-lg btn-block" id="a6">Sharpen Sword - [+10 damage on next attack]</button></a></li>
                        <li><a href="#"><button type="button" class="btn btn-primary btn-lg btn-block" id="a7">Drink Potion</button></a></li>
                        <li><a href="#"><button type="button" class="btn btn-primary btn-lg btn-block" id="a8">Roll the dice</button></a></li>
                    </ul>
                </div>

                <!-- Results Display -->
                <div id="part4" class="part" style="display: none">
                    <ul id="o-select">
                        <li><h2>Your Health: <span class="health-display" id="player-health2">100</span></h2></li>
                        <li ><h2>Enemy Health: <span class="health-display" id="enemy-health2">100</span></h2></li>
                        <li id="potionList2"><h2 id="potions2"></h2></li>
                        <li id="feedback"></li>
                        <li><a href="#"><button type="button" class="btn btn-primary btn-lg btn-block" id="next">Got it!</button></a></li>
                    </ul>
                </div>

                <!-- Win/Loss/Draw -->
                <div id="endGameScreen" class="part" style="display: none">
                    <ul id="o-select">
                        <li><br></li>
                        <div id="endGameText">You have won!</div>
                        <li><a href="#"><button type="button" class="btn btn-primary btn-lg btn-block" id="resetGame">Play again!</button></a></li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Help Screen Modal -->
        <div id="help-menu" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Slei Help</h4>
                    </div>
                    <div class="modal-body">
                        <span class="bg-warning"><span class="glyphicon glyphicon-info-sign"></span> <i>Setting up a Game</i></span><br>
                        <ol>
                            <li>First select your difficulty, you can select <span class="bg-success">Easy</span>, <span class="bg-success">Medium</span> or <span class="bg-success">Hard</span>. This will affect different aspects of the game greatly. Beginners are recommended to start with the <span class="bg-success">Easy</span> mode.</li>
                            <li>Once a difficulty has been selected you must now select a class, classes also affect the game but their changes mainly focus on your <span class="bg-success">Health</span>, <span class="bg-success">Damage</span> and <span class="bg-success">Special Attacks.</span>. If a class doesn't have any special attacks, they will have the ability to <span class="bg-success">Roll the Dice</span>.</li>
                            <li>Once the settings for the game have been chosen, you now are ready to fight. You now must select attacks to fight the enemy. You can also <span class="bg-success">Drink a Potion</span>, <span class="bg-success">Parry</span>, or give yourself buffs like <span class="bg-success">Sharpen Sword</span>.</li>
                        </ol>
                        <span class="bg-warning"><span class="glyphicon glyphicon-info-sign"></span> <i>Tips &amp; Tricks</i></span><br>
                        <ul>
                            <li>If you repeat an attack, it will be significantly less effective.</li>
                            <li>Rolling the dice can have good and bad consequences.</li>
                            <li>Unless in Easy mode, the amount of potions the player has is not displayed, so it is vital to be aware of this. It is also recommended that you drink a potion as soon as you can.</li>
                            <li>Try to use combinations to put you at an advantage. For example use Sharpen Sword before a Lunge to gain extra health.</li>
                        </ul>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Version Info Menu -->
        <div id="info-menu" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Slei Changelog and Credits</h4>
                    </div>
                    <div class="modal-body">
                        <span>This game was made by Nicholas Ramsay.</span>
                        <ul>
                            <li><i>Changelog</i></li>
                            <li><strong>Titan Blade ALPHA 1.6:</strong> First compilation of the game.</li>
                            <li><strong>Slei ALPHA 1.7:</strong>
                                <ul>
                                    <li>Game icon added.</li>
                                    <li>Name, 'Titan Blade' changed to 'Slei'</li>
                                    <li>Easy mode shows potions.</li>
                                    <li>Classes and difficulty affect player health.</li>
                                    <li>Many bug fixes.</li>
                                </ul>
                            </li>
                            <li><strong>Slei ALPHA 1.8:</strong>
                                <ul>
                                    <li>Color theme changed.</li>
                                    <li>Insane mode enabled.</li>
                                    <li>Difficulties change enemy damage buffs.</li>
                                    <li>Changed styling completely for media devices (Removed title).</li>
                                    <li>Player can hold <i>Sharpen Sword</i> until they attack.</li>
                                    <li>Roll the dice added.</li>
                                </ul>
                            </li>
                            <li><strong>Slei ALPHA 2.0:</strong>
                                <ul>
                                    <li>Classes completely implemented.</li>
                                    <li>Difficulties completely implemented.</li>
                                    <li>End of round alerts color coordinated.</li>
                                    <li>Game data added to end of game.</li>
                                </ul>
                            </li>
                            <li><strong>Slei ALPHA 2.1:</strong>
                                <ul>
                                    <li>Class selection UI tweaked</li>
                                    <li>Whoever has less health does more damage</li>
                                    <li>Sharpen Sword then Lunge combo is less effective.</li>
                                </ul>
                            </li>
                        </ul>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Resources -->
        <script src="js/script.js"></script>
        <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    </body>
</html>
